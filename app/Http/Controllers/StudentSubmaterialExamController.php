<?php

namespace App\Http\Controllers;

use App\Enums\SubMaterialExamTypeEnum;
use App\Exports\StudentRegristationExamExport;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\SubMaterialExam;
use App\Services\StudentExamService;
use App\Services\SubMaterialService;
use App\Models\StudentSubmaterialExam;
use App\Repositories\StudentExamRepository;
use App\Repositories\QuestionBankRepository;
use App\Http\Requests\AnswerSubmaterialExamRequest;
use App\Repositories\SubMaterialExamQuestionRepository;
use App\Http\Requests\StudentSubMaterialExamScoreRequest;
use App\Models\User;
use App\Repositories\StudentSubMaterialExamAnswerRepository;
use App\Services\StudentSubmaterialExamAnswerService;
use App\Services\UserServices;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\returnSelf;

class StudentSubmaterialExamController extends Controller
{
    private SubMaterialExamQuestionRepository $examQuestion;
    private StudentExamRepository $studentExam;
    private StudentExamService $service;
    private SubMaterialService $subMaterialService;
    private QuestionBankRepository $questionBank;
    private StudentSubMaterialExamAnswerRepository $studentSubMaterialExamAnswer;
    private StudentSubmaterialExamAnswerService $studentSubMaterialExamAnswerService;
    private UserServices $userService;

    public function __construct(SubMaterialExamQuestionRepository $examQuestion, StudentExamRepository $studentExam, StudentExamService $service, QuestionBankRepository $questionBank, SubMaterialService $subMaterialService, StudentSubMaterialExamAnswerRepository $studentSubMaterialExamAnswer, StudentSubmaterialExamAnswerService $studentSubMaterialExamAnswerService, UserServices $userService)
    {
        $this->examQuestion = $examQuestion;
        $this->studentExam = $studentExam;
        $this->service = $service;
        $this->questionBank = $questionBank;
        $this->subMaterialService = $subMaterialService;
        $this->studentSubMaterialExamAnswer = $studentSubMaterialExamAnswer;
        $this->studentSubMaterialExamAnswerService = $studentSubMaterialExamAnswerService;
        $this->userService = $userService;
    }

    public function regristationExamRegulation(SubMaterialExam $subMaterialExam): View
    {
        return view('dashboard.user.pages.testerExam.regulation', compact('subMaterialExam'));
    }
    public function regristationExamSetName(SubMaterialExam $subMaterialExam): View
    {
        return view('dashboard.user.pages.testerExam.setName', compact('subMaterialExam'));
    }
    public function regristationExamUpdateName(Request $request, SubMaterialExam $subMaterialExam)
    {
        $request->validate(['name' => 'required'], ['name.required' => 'Nama harus diisi']);
        $update = $this->userService->handleUpdateName($request, auth()->user()->id);
        return redirect()->route('tester.exam', $subMaterialExam->id);
    }

    /**
     * index
     *
     * @param  mixed $subMaterialExam
     * @return mixed
     */
    public function index(SubMaterialExam $subMaterialExam): mixed
    {
        // dd(auth()->user()->roles->pluck('name')[0] == 'tester' && auth()->user()->name == 'akun test');
        if (count($subMaterialExam->subMaterialExamQuestions) == 0) return back()->with('error', "Belum Ada Soal Untuk Ujian");
        if (auth()->user()->roles->pluck('name')[0] == 'tester' && auth()->user()->name == 'akun test') {
            return redirect()->route('tester.exam-setname', $subMaterialExam->id);
        }

        $studentExam = $this->studentExam->whereIn(['sub_material_exam_id' => $subMaterialExam->id]);

        if ($subMaterialExam->type = SubMaterialExamTypeEnum::REGISTER) {
            if ($subMaterialExam->start_at > now()) return back()->with('error', 'Ujian Belum Dimulai');
        }
        if ($subMaterialExam->end_at < now()) return back()->with('error', 'Ujian Sudah Ditutup');

        $examQuestionsMultipleChoice = $this->examQuestion->getRandomOrderByExamMultipleChoice($subMaterialExam->id);
        $examQuestionsEssay = $this->examQuestion->getRandomOrderByExamEssay($subMaterialExam->id);
        if ($studentExam == null) {
            $this->service->store($subMaterialExam, $examQuestionsMultipleChoice, $examQuestionsEssay);
            $studentExam = $this->studentExam->whereIn(['sub_material_exam_id' => $subMaterialExam->id]);
            $data['student_exam'] = $studentExam;
            $data['question_multiple_choice'] = $examQuestionsMultipleChoice;
            $data['question_essay'] = $examQuestionsEssay;
            if (auth()->user()->roles->pluck('name')[0] == 'tester') return view('dashboard.user.pages.testerExam.exam', $data);
            return view('dashboard.user.pages.studentExam.exam', $data);
        } else {
            if ($studentExam->finished_exam) {
                return redirect()->route('tester.exam.show-finish', ['studentSubmaterialExam' => $studentExam->id, 'subMaterialExam' => $subMaterialExam->id]);
            }
            if ($subMaterialExam->type == SubMaterialExamTypeEnum::QUIZ->value) {
                $studentExam->update([
                    'score' => null,
                    'deadline' => now()->addMinutes($subMaterialExam->time),
                    'finished_exam' => null,
                    'true_answer' => null,
                    'answer' => null
                ]);
            }
            $studentExam->studentSubMaterialExamAnswers()->delete();
            if (now() < Carbon::parse($subMaterialExam->start_at)) {
                return redirect()->back()->with('error', 'Ujian Belum Dimulai..');
            }

            $orderQuestionMultipleChoice = $studentExam->order_of_question_multiple_choice;
            $orderQuestionEssay = $studentExam->order_of_question_essay;

            $examQuestionsMultipleChoice = $subMaterialExam->total_multiple_choice > 0 ? $this->examQuestion->getWhereMultiple(['orderQuestionMultipleChoice' => $orderQuestionMultipleChoice, 'sub_material_exam_id' => $subMaterialExam->id]) : [];
            $examQuestionsEssay = $subMaterialExam->total_essay > 0 ? $this->examQuestion->getWhereEssay(['orderQuestionEssay' => $orderQuestionEssay, 'sub_material_exam_id' => $subMaterialExam->id]) : [];
            $data['student_exam'] = $studentExam;
            $data['question_multiple_choice'] = $examQuestionsMultipleChoice;
            $data['question_essay'] = $examQuestionsEssay;
            if (auth()->user()->roles->pluck('name')[0] == 'tester') return view('dashboard.user.pages.testerExam.exam', $data);
            return view('dashboard.user.pages.studentExam.exam', $data);
        }
    }

    /**
     * answer
     *
     * @param  mixed $request
     * @param  mixed $subMaterialExam
     * @return mixed
     */
    public function answer(AnswerSubmaterialExamRequest $request, SubMaterialExam $subMaterialExam, StudentSubmaterialExam $studentSubmaterialExam): mixed
    {
        $questions = $this->questionBank->getBySubmaterialExam($subMaterialExam->id);
        $sortedQuestionsMultipleChoice = $this->subMaterialService->sortDailyExamQuestion($questions);

        // dd($sortedQuestionsMultipleChoice);
        $answerKey = $this->questionBank->getAnswerByQuestion(collect($sortedQuestionsMultipleChoice)->pluck('id')->toArray());

        $data = $this->service->calculate($request, $answerKey, $subMaterialExam);

        $data['finished_count'] = $studentSubmaterialExam->finished_count + 1;

        $this->studentExam->update($studentSubmaterialExam->id, $data);

        return response()->json($data, 200);
    }


    public function showFinish(SubMaterialExam $subMaterialExam, StudentSubmaterialExam $studentSubmaterialExam): View
    {
        $data['subMaterialExam'] = $subMaterialExam;
        $data['studentSubmaterialExam'] = $studentSubmaterialExam;
        $data['essayGraded'] = $this->studentSubMaterialExamAnswerService->essay_graded($data['studentSubmaterialExam']);
        if ($subMaterialExam->type == SubMaterialExamTypeEnum::REGISTER->value) return view('dashboard.user.pages.testerExam.finish', $data);
        return view('dashboard.user.pages.studentExam.finish', $data);
    }

    /**
     * studentExamScore
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function studentSubMaterialExamEssayScore(Request $request, SubMaterialExam $subMaterialExam): mixed
    {
        // dd($request);
        $essayValue = $subMaterialExam->essay_value;
        $score = 0;
        $data = $request;

        $scoreByAnswerId = [];

        foreach ($data['student_submaterial_exam_answer_id'] as $index => $answerId) {
            $scoreByAnswerId[$answerId] = isset($scoreByAnswerId[$answerId]) ? $scoreByAnswerId[$answerId] + $data['answer_value'][$index] : $data['answer_value'][$index];
        }

        foreach ($scoreByAnswerId as $answerId => $totalScore) {
            if ($totalScore > $essayValue) {
                return redirect()->back()->with('error', "Total nilai yang anda tambahkan untuk essay maksimal " . $essayValue . " sedangkan total nilai yang anda inputkan " . $totalScore);
            }
        }

        for ($i = 0; $i < count($data['student_submaterial_exam_answer_id']); $i++) {
            $score += $data['answer_value'][$i];
            $this->service->handleUpdate($data['student_submaterial_exam_answer_id'][$i], ['question_number' => $data['student_question_number'][$i]], ['score' => $data['answer_value'][$i]]);
            $this->studentSubMaterialExamAnswer->updateValue($data['student_submaterial_exam_answer_id'][$i], ['question_number' => $data['student_question_number'][$i]], ['answer_value' => $data['answer_value'][$i]]);
        }

        return redirect()->back()->with('success', "Berhasil melakukan penilaian");
    }

    public function openTab(StudentSubmaterialExam $subMaterialExam)
    {
        $studentExam = $this->service->handleOpenTab($subMaterialExam);
        return response()->json(['openTab' => $studentExam->open_tab], 200);
    }

    public function reset($subMaterialExam)
    {
        $delete = $this->service->reset($subMaterialExam);
        return response()->json([], 200);
    }


    public function exportRegristationExam(User $school)
    {
        return Excel::download(new StudentRegristationExamExport($school->id), "$school->name.xlsx");
    }
}
