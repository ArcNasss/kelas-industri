<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Material;
use Barryvdh\DomPDF\PDF;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\EventPartisipant;
use App\Services\AssignmentService;
use App\Services\CertifyService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Geometry\Factories\LineFactory;
use Intervention\Image\Geometry\Factories\RectangleFactory;

class CertifyController extends Controller
{
    private AssignmentService $assignmentService;
    private CertifyService $certifyService;

    public function __construct(AssignmentService $assignmentService, CertifyService $certifyService)
    {
        $this->assignmentService = $assignmentService;
        $this->certifyService = $certifyService;
    }
    /**
     * certity
     *
     * @return void
     */
    public function certify(Request $request, Material $material, Classroom $classroom)
    {
        $countAssignmentByMaterial = $this->assignmentService->handleAssignmentByMaterialCertify($material->id);

        $countAssignment = $this->assignmentService->countAssignmentsByMaterial($material->id, auth()->user());

        if ($countAssignmentByMaterial == $countAssignment) {

            $class = $this->convertRomanToNumber(substr($classroom->name, 0, 1));

            $img = ImageManager::gd()->read('certificate/templateSertifikat/materi.png');

            $text = 'sertifikat';
            $text = strtoupper($text);
            $spacedText = implode(' ', str_split($text));
            $img->text($spacedText, 1010, 230, function ($font) {
                $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
                $font->size(100);
                $font->align('center');
                $font->valign('top');
            });
            $img->text('No .', 680, 340, function ($font) {
                $font->file('fonts/merriweather/Merriweather-Regular.ttf');
                $font->size(42);
                $font->align('center');
                $font->valign('top');
            });
            $text = $class . substr($classroom->generation->generation, 9) . Carbon::now()->locale('id')->format('ymd') . substr(auth()->user()->national_student_id, 6);
            $spacedText = implode('  ', str_split($text));
            $img->text($spacedText, 1045, 340, function ($font) {
                $font->file('fonts/poppins/Poppins-Regular.ttf');
                $font->size(42);
                $font->align('center');
                $font->valign('top');
            });
            $img->text('diberikan kepada :', 995, 420, function ($font) {
                $font->file('fonts/open-sans/OpenSans-Italic.ttf');
                $font->size(40);
                $font->color('77838D');
                $font->align('center');
                $font->valign('top');
            });
            $img->text(auth()->user()->name, 1000, 500, function ($font) {
                $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
                $font->size(140);
                $font->align('center');
                $font->valign('top');
            });
            $img->text('Dari ' . auth()->user()->studentSchool->school->name, 1000, 700, function ($font) {
                $font->file('fonts/open-sans/OpenSans-Bold.ttf');
                $font->size(34);
                $font->align('center');
                $font->valign('top');
            });
            $img->text('Telah menyelesaikan materi', 1000, 775, function ($font) {
                $font->file('fonts/open-sans/OpenSans-Regular.ttf');
                $font->size(30);
                $font->align('center');
                $font->valign('top');
            });
            $img->text($material->title, 1000, 830, function ($font) {
                $font->file('fonts/open-sans/OpenSans-Bold.ttf');
                $font->size(30);
                $font->align('center');
                $font->valign('top');
            });
            $img->text(Carbon::parse(now())->locale('id')->isoFormat('D MMMM YYYY'), 1000, 885, function ($font) {
                $font->file('fonts/open-sans/OpenSans-Regular.ttf');
                $font->size(30);
                $font->align('center');
                $font->valign('top');
            });
            $img->text('Verifikasi Sertifikat', 1505, 1185, function ($font) {
                $font->file('fonts/open-sans/OpenSans-Bold.ttf');
                $font->size(30);
                $font->align('center');
            });
            $img->text('class.hummatech.com/sertifikat/example', 1360, 1240, function ($font) {
                $font->file('fonts/open-sans/OpenSans-Regular.ttf');
                $font->size(30);
                $font->align('center');
            });

            // Generate QR code and store it in output buffer
            ob_start();
            QrCode::size(100)->format('png')->generate(route('material.cerify-certification', ['material' => $material->id, 'classroom' => $classroom->id, 'user' => auth()->user()->id]), 'php://output');
            // QrCode::size(100)->format('png')->generate('https//class.hummatech.com', 'php://output');
            $qrImage = ob_get_clean();

            // Create image from the QR code string and place it at the bottom-right of the certificate
            $qrcode = ImageManager::gd()->read($qrImage);
            $img->place($qrcode, 'bottom-right', 200, 170);

            // Membuat direktori jika belum ada
            $directory = storage_path('app/public/storage/sertifikat');
            File::makeDirectory($directory, $mode = 0777, true, true);

            // Simpan gambar
            $imgPath = $directory . '/sertifikat.png';
            $img->save($imgPath);

            // Return response download
            return response()->download($imgPath, 'sertifikat.png');
        } else {
            return redirect()->back()->with('error', trans('Tidak bisa mengunduh sertifikat karena anda belum menyelesaikan semua tugas pada materi ' . $material->title));
        }
    }


    public function certifyCompetenceTest(Classroom $classroom)
    {
        $groupedScores = $this->certifyService->studentScore($classroom);

        // halaman awal
        $class = $this->convertRomanToNumber(substr($classroom->name, 0, 1));
        $img = ImageManager::gd()->read('certificate/templateSertifikat/uas.png');

        $text = 'uji kompetensi';
        $text = strtoupper($text);
        $spacedText = implode(' ', str_split($text));
        $img->text($spacedText, 1010, 230, function ($font) {
            $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
            $font->size(80);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('No .', 680, 340, function ($font) {
            $font->file('fonts/merriweather/Merriweather-Regular.ttf');
            $font->size(42);
            $font->align('center');
            $font->valign('top');
        });
        $text = $class . substr($classroom->generation->generation, 9) . Carbon::now()->locale('id')->format('ymd') . substr(auth()->user()->national_student_id, 6);
        $spacedText = implode('  ', str_split($text));
        $img->text($spacedText, 1045, 340, function ($font) {
            $font->file('fonts/poppins/Poppins-Regular.ttf');
            $font->size(42);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('diberikan kepada :', 995, 420, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Italic.ttf');
            $font->size(40);
            $font->color('77838D');
            $font->align('center');
            $font->valign('top');
        });
        $img->text(auth()->user()->name, 1000, 500, function ($font) {
            $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
            $font->size(140);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Dari ' . auth()->user()->studentSchool->school->name, 1000, 700, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(34);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Telah Menyelesaikan Semua Materi di Kelas ' . $class, 1000, 775, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Regular.ttf');
            $font->size(30);
            $font->align('center');
            $font->valign('top');
        });

        $img->text(Carbon::parse(now())->locale('id')->isoFormat('D MMMM YYYY'), 1000, 885, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Regular.ttf');
            $font->size(30);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Verifikasi Sertifikat', 1505, 1185, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(30);
            $font->align('center');
        });
        $img->text('class.hummatech.com/sertifikat/example', 1360, 1240, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Regular.ttf');
            $font->size(30);
            $font->align('center');
        });

        ob_start();
        QrCode::size(100)->format('png')->generate('https//class.hummatech.com', 'php://output');
        $qrImage = ob_get_clean();

        $qrcode = ImageManager::gd()->read($qrImage);
        $img->place($qrcode, 'bottom-right', 200, 170);

        // halaman kedua
        $scoreImg = ImageManager::gd()->read('certificate/templateSertifikat/nilaiUas.png');
        $text = 'struktur program';
        $text = strtoupper($text);
        $spacedText = implode('', str_split($text));
        $scoreImg->text($spacedText, 1010, 330, function ($font) {
            $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
            $font->size(90);
            $font->align('center');
            $font->valign('top');
        });
        // Draw the table
        $scoreImg->drawRectangle(240, 450, function (RectangleFactory $rectangle) {
            $rectangle->size(1500, 100); // width & height of rectangle
            $rectangle->background('#00b1f0'); // background color of rectangle
            $rectangle->border('black', 2); // border color & size of rectangle
        });

        $scoreImg->drawLine(function (LineFactory $line) {
            $line->from(350, 450); // starting point of line
            $line->to(350, 550); // ending point
            $line->color('black'); // color of line
            $line->width(5); // line width in pixels
        });

        $scoreImg->drawLine(function (LineFactory $line) {
            $line->from(1580, 450); // starting point of line
            $line->to(1580, 550); // ending point
            $line->color('black'); // color of line
            $line->width(5); // line width in pixels
        });

        // // Add table headers
        $scoreImg->text('No', 270, 485, function ($font) {
            $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
            $font->size(40);
            $font->color('white');
            $font->align('left');
            $font->valign('top');
        });
        $scoreImg->text('Materi', 950, 485, function ($font) {
            $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
            $font->size(40);
            $font->color('white');
            $font->align('center');
            $font->valign('top');
        });
        $scoreImg->text('Nilai', 1700, 485, function ($font) {
            $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
            $font->size(40);
            $font->color('white');
            $font->align('right');
            $font->valign('top');
        });
        $vertical = 550;

        foreach ($groupedScores as $index => $score) {

            $scoreImg->drawRectangle(240, $vertical, function (RectangleFactory $rectangle) {
                $rectangle->size(1500, 100); // width & height of rectangle
                $rectangle->background('#FFF8EF'); // background color of rectangle
                $rectangle->border('black', 2); // border color & size of rectangle
            });

            // Add table headers
            $scoreImg->text($index + 1 . '.', 290, $vertical + 35, function ($font) {
                $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
                $font->size(40);
                $font->color('black');
                $font->align('center');
                $font->valign('top');
            });
            $scoreImg->text($score['material'], 950, $vertical + 35, function ($font) {
                $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
                $font->size(40);
                $font->color('black');
                $font->align('center');
                $font->valign('top');
            });
            $scoreImg->text($score['total_score'], 1650, $vertical + 35, function ($font) {
                $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
                $font->size(40);
                $font->color('black');
                $font->align('center');
                $font->valign('top');
            });

            $scoreImg->drawLine(function (LineFactory $line) use ($vertical) {
                $line->from(350, $vertical); // starting point of line
                $line->to(350, $vertical + 100); // ending point
                $line->color('black'); // color of line
                $line->width(5); // line width in pixels
            });

            $scoreImg->drawLine(function (LineFactory $line) use ($vertical) {
                $line->from(1580, $vertical); // starting point of line
                $line->to(1580, $vertical + 100); // ending point
                $line->color('black'); // color of line
                $line->width(5); // line width in pixels
            });

            $vertical += 100;
        }

        $pdf = app('dompdf.wrapper'); // Get an instance of the PDF wrapper
        $pdf->setPaper('a4', 'landscape'); // Set the paper size and orientation
        $pdf->setPaper([0, 0, 841.89, 595.28]);
        $pdf->loadHTML('<html><body style="margin: 0; padding: 0;"><img src="data:image/png;base64,' . base64_encode($img->toPng()) . '" style="width:100%;"><br><img src="data:image/png;base64,' . base64_encode($scoreImg->toPng()) . '" style="width:100%;"></body></html>');
        return $pdf->download('certifyCompetenceTest.pdf');
    }

    public function eventCertify(Request $request, Event $event, EventPartisipant $participant)
    {

        // dd($event);
        // if ($countAssignmentByMaterial == $countAssignment) {

        $classroom = $participant->user->studentSchool->studentClassroom->classroom;
        $class = $this->convertRomanToNumber(substr($classroom->name, 0, 1));

        $img = ImageManager::gd()->read('certificate/templateSertifikat/event.png');

        $text = 'sertifikat';
        $text = strtoupper($text);
        $spacedText = implode(' ', str_split($text));
        $img->text($spacedText, 1010, 230, function ($font) {
            $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
            $font->size(100);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('No .', 680, 340, function ($font) {
            $font->file('fonts/merriweather/Merriweather-Regular.ttf');
            $font->size(42);
            $font->align('center');
            $font->valign('top');
        });
        $code = '23' . Carbon::now()->locale('id')->isoFormat('YYYYMMDD') . mt_rand(0, 9999);
        $spacedText = implode('  ', str_split($code));
        $img->text($spacedText, 1045, 340, function ($font) {
            $font->file('fonts/poppins/Poppins-Regular.ttf');
            $font->size(42);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('diberikan kepada :', 995, 420, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Italic.ttf');
            $font->size(40);
            $font->color('77838D');
            $font->align('center');
            $font->valign('top');
        });
        $img->text(auth()->user()->name, 1000, 500, function ($font) {
            $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
            $font->size(140);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Sebagai', 1000, 660, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(30);
            // $font->color('77838D');
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Peserta', 1000, 710, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(40);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Dalam ' . $event->title, 1000, 775, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Regular.ttf');
            $font->size(30);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('yang diselenggarakan oleh PT Humma Teknologi Indonesia', 1050, 830, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(30);
            $font->align('center');
            $font->valign('top');
        });
        $img->text(Carbon::parse($participant->updated_at)->locale('id')->isoFormat('D MMMM YYYY'), 1000, 885, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Regular.ttf');
            $font->size(30);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Verifikasi Sertifikat', 1505, 1185, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(30);
            $font->align('center');
        });
        $img->text('class.hummatech.com/sertifikat/example', 1360, 1240, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Regular.ttf');
            $font->size(30);
            $font->align('center');
        });

        $code = $class . substr($classroom->generation->generation, 9) . Carbon::now()->locale('id')->format('ymd') . substr(auth()->user()->national_student_id, 6);
        // Generate QR code and store it in output buffer
        ob_start();
        // QrCode::size(100)->format('png')->generate('https://class.hummatech.com/', 'php://output');
        QrCode::size(100)->format('png')->generate(route('events.verify-certification', ['participant' => EventPartisipant::where('user_id', auth()->user()->id)->first()->id, 'event' => $event->id]), 'php://output');
        $qrImage = ob_get_clean();

        // Create image from the QR code string and place it at the bottom-right of the certificate
        $qrcode = ImageManager::gd()->read($qrImage);
        $img->place($qrcode, 'bottom-right', 200, 170);

        // Membuat direktori jika belum ada
        $directory = storage_path('app/public/storage/sertifikat');
        File::makeDirectory($directory, $mode = 0777, true, true);

        // Simpan gambar
        $imgPath = $directory . '/sertifikat.png';
        $img->save($imgPath);

        // Return response download
        return response()->download($imgPath, 'sertifikat.png');
        // return response()->file($imgPath, ['Content-Type' => 'image/png']);
        // }

        // return redirect()->back()->with('error', trans('Tidak bisa mengunduh sertifikat karena anda belum menyelesaikan semua tugas pada materi ' . $material->title));
    }

    public function convertRomanToNumber($roman)
    {
        $romans = [
            'X' => 10,
            'XI' => 11,
            'XII' => 12,
        ];

        return $romans[$roman];
    }


    public function eventVerification(
        EventPartisipant $participant,
        Event $event
    ): View {
        $classroom = $participant->user->studentSchool->studentClassroom->classroom;
        $class = $this->convertRomanToNumber(substr($classroom->name, 0, 1));

        $img = ImageManager::gd()->read('certificate/templateSertifikat/event.png');

        $text = 'sertifikat';
        $text = strtoupper($text);
        $spacedText = implode(' ', str_split($text));
        $img->text($spacedText, 1010, 230, function ($font) {
            $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
            $font->size(100);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('No .', 680, 340, function ($font) {
            $font->file('fonts/merriweather/Merriweather-Regular.ttf');
            $font->size(42);
            $font->align('center');
            $font->valign('top');
        });
        $code = '23' . Carbon::now()->locale('id')->isoFormat('YYYYMMDD') . mt_rand(0, 9999);
        $spacedText = implode('  ', str_split($code));
        $img->text($spacedText, 1045, 340, function ($font) {
            $font->file('fonts/poppins/Poppins-Regular.ttf');
            $font->size(42);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('diberikan kepada :', 995, 420, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Italic.ttf');
            $font->size(40);
            $font->color('77838D');
            $font->align('center');
            $font->valign('top');
        });
        $img->text($participant->user->name, 1000, 500, function ($font) {
            $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
            $font->size(140);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Sebagai', 1000, 660, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(30);
            // $font->color('77838D');
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Peserta', 1000, 710, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(40);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Dalam ' . $event->title, 1000, 775, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Regular.ttf');
            $font->size(30);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('yang diselenggarakan oleh PT Humma Teknologi Indonesia', 1050, 830, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(30);
            $font->align('center');
            $font->valign('top');
        });
        $img->text(Carbon::parse($participant->updated_at)->locale('id')->isoFormat('D MMMM YYYY'), 1000, 885, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Regular.ttf');
            $font->size(30);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Verifikasi Sertifikat', 1505, 1185, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(30);
            $font->align('center');
        });
        $img->text('class.hummatech.com/sertifikat/example', 1360, 1240, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Regular.ttf');
            $font->size(30);
            $font->align('center');
        });
        // Generate QR code and store it in output buffer
        ob_start();
        // QrCode::size(100)->format('png')->generate('https://class.hummatech.com/', 'php://output');
        QrCode::size(100)->format('png')->generate(route('events.verify-certification', ['participant' => $participant->user->id, 'event' => $event->id]), 'php://output');
        $qrImage = ob_get_clean();

        // Create image from the QR code string and place it at the bottom-right of the certificate
        $qrcode = ImageManager::gd()->read($qrImage);
        $img->place($qrcode, 'bottom-right', 200, 170);

        // Membuat direktori jika belum ada
        $directory = storage_path('app/public/storage/sertifikat');
        File::makeDirectory($directory, $mode = 0777, true, true);

        // Simpan gambar
        $imgPath = $directory . '/sertifikat.png';
        $img->save($imgPath);

        // Convert the image to base64
        $imageData = base64_encode(file_get_contents($imgPath));
        $src = 'data:image/png;base64,' . $imageData;

        $data['participant'] = $participant;
        $data['event'] = $event;
        $data['classroom'] = $participant->user->studentSchool->studentClassroom->classroom;
        $data['class'] = $this->convertRomanToNumber(substr($data['classroom']->name, 0, 1));
        $data['number'] = $code;
        $data['image'] = $src;
        return view('dashboard.user.pages.certify.event-certify', $data);
    }

    public function materialVerify(Request $request, Material $material, Classroom $classroom, User $user)
    {
        $class = $this->convertRomanToNumber(substr($classroom->name, 0, 1));

        $img = ImageManager::gd()->read('certificate/templateSertifikat/materi.png');

        $text = 'sertifikat';
        $text = strtoupper($text);
        $spacedText = implode(' ', str_split($text));
        $img->text($spacedText, 1010, 230, function ($font) {
            $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
            $font->size(100);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('No .', 680, 340, function ($font) {
            $font->file('fonts/merriweather/Merriweather-Regular.ttf');
            $font->size(42);
            $font->align('center');
            $font->valign('top');
        });
        $text = $class . substr($classroom->generation->generation, 9) . Carbon::now()->locale('id')->format('ymd') . substr($user->national_student_id, 6);
        $spacedText = implode('  ', str_split($text));
        $img->text($spacedText, 1045, 340, function ($font) {
            $font->file('fonts/poppins/Poppins-Regular.ttf');
            $font->size(42);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('diberikan kepada :', 995, 420, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Italic.ttf');
            $font->size(40);
            $font->color('77838D');
            $font->align('center');
            $font->valign('top');
        });
        $img->text($user->name, 1000, 500, function ($font) {
            $font->file('fonts/tex-gyre-termes/texgyretermes-regular.otf');
            $font->size(140);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Dari ' . $user->studentSchool->school->name, 1000, 700, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(34);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Telah menyelesaikan materi', 1000, 775, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Regular.ttf');
            $font->size(30);
            $font->align('center');
            $font->valign('top');
        });
        $img->text($material->title, 1000, 830, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(30);
            $font->align('center');
            $font->valign('top');
        });
        $img->text(Carbon::parse(now())->locale('id')->isoFormat('D MMMM YYYY'), 1000, 885, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Regular.ttf');
            $font->size(30);
            $font->align('center');
            $font->valign('top');
        });
        $img->text('Verifikasi Sertifikat', 1505, 1185, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Bold.ttf');
            $font->size(30);
            $font->align('center');
        });
        $img->text('class.hummatech.com/sertifikat/example', 1360, 1240, function ($font) {
            $font->file('fonts/open-sans/OpenSans-Regular.ttf');
            $font->size(30);
            $font->align('center');
        });

        $code = $class . substr($classroom->generation->generation, 9) . Carbon::now()->locale('id')->format('ymd') . substr($user->national_student_id, 6);

        // Generate QR code and store it in output buffer
        ob_start();
        QrCode::size(100)->format('png')->generate('https://class.hummatech.com/', 'php://output');
        $qrImage = ob_get_clean();

        // Create image from the QR code string and place it at the bottom-right of the certificate
        $qrcode = ImageManager::gd()->read($qrImage);
        $img->place($qrcode, 'bottom-right', 200, 170);

        // Membuat direktori jika belum ada
        $directory = storage_path('app/public/storage/sertifikat');
        File::makeDirectory($directory, $mode = 0777, true, true);

        // Simpan gambar
        $imgPath = $directory . '/sertifikat.png';
        $img->save($imgPath);

        // Convert the image to base64
        $imageData = base64_encode(file_get_contents($imgPath));
        $src = 'data:image/png;base64,' . $imageData;

        $data['image'] = $src;
        $data['material'] = $material;
        $data['classroom'] = $classroom;
        $data['user'] = $user;
        $data['number'] = $code;
        return view('dashboard.user.pages.certify.material-certify', $data);
        // return redirect()->back()->with('error', trans('Tidak bisa mengunduh sertifikat karena anda belum menyelesaikan semua tugas pada materi ' . $material->title));
    }

    public function competenceTestVerify($classroom){
        
    }
}
