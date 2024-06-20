@php use Carbon\Carbon; @endphp
@extends('dashboard.user.layouts.app')

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">


            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_toolbar" class="app-toolbar py-4 py-lg-8 ">

                    <!--begin::Toolbar container-->
                    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack flex-wrap ">
                        <!--begin::Toolbar wrapper-->
                        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">


                            <!--begin::Page title-->
                            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                                <!--begin::Title-->
                                <h1
                                    class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                                    Niali Ujian
                                </h1>
                                <!--end::Title-->

                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->

                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">

                                    </li>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        daftar nilai ujian
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->

                                    <!--end::Item-->

                                    <!--begin::Item-->

                                    <!--end::Item-->

                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <div class="d-flex align-items-center gap-2 gap-lg-3">
                                @if (auth()->user()->roles->pluck('name')[0] == 'mentor')
                                    <a href="{{ route('mentor.exam.index') }}"
                                        class="btn btn-flex btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold">
                                        <i class="bi bi-arrow-left me-2"></i> Kembali
                                    </a>
                                @else
                                    <a href="{{ route('teacher.exam.index') }}"
                                        class="btn btn-flex btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold">
                                        <i class="bi bi-arrow-left me-2"></i> Kembali
                                    </a>
                                @endif

                            </div>
                            <!--end::Page title-->
                            <!--begin::Actions-->
                            <!--end::Actions-->
                        </div>
                        <!--end::Toolbar wrapper-->
                    </div>
                    <!--end::Toolbar container-->
                </div>
                <!--begin::Content container-->
                <div id="kt_content" class="app-container  container-fluid ">
                    <div class="row">
                        <div class="card ">
                            <div class="card-header card-header-stretch">
                                <h3 class="card-title">Ujian UAS Dan UTS</h3>
                                <div class="card-toolbar">
                                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab"
                                                href="#kt_tab_pane_uts_ganjil">UTS Semester Ganjil</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_uts_genap">UTS
                                                Semester Genap</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_uas_ganjil">UAS
                                                Semester Ganjil</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_uas_genap">UAS
                                                Semester Genap</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="kt_tab_pane_uts_ganjil" role="tabpanel">
                                        @if ($exams->where('exam_type', 'uts')->where('semester', 'ganjil')->count() > 0)
                                            <table id="kt_datatable_responsive"
                                                class="table table-striped border rounded gy-5 gs-7">
                                                <thead>
                                                    <!--begin::Table row-->
                                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                        <th data-priority="1">No</th>
                                                        <th data-priority="2">Nama</th>
                                                        <th data-priority="3">Tingkat Kesulitan</th>
                                                        @foreach ($classroom->devision->criterias()->where('is_default', 0)->get() as $criteria)
                                                            <th data-priority="{{ $loop->iteration + 3 }}">
                                                                {{ $criteria->name }}</th>
                                                        @endforeach
                                                        @if (auth()->user()->roles->pluck('name')[0] == 'admin')
                                                            <th>Aksi</th>
                                                        @endif
                                                    </tr>
                                                    <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-semibold text-gray-600">
                                                    @foreach ($exams->where('exam_type', 'uts')->where('semester', 'ganjil') as $exam)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $exam->studentClassroom->studentSchool->student->name }}
                                                            </td>
                                                            <td>{{ $exam->task_level }}</td>
                                                            @foreach ($exam->examCriterias as $criteria)
                                                                <td>{{ $criteria->score }}</td>
                                                            @endforeach
                                                            @if (auth()->user()->roles->pluck('name')[0] == 'admin')
                                                                <td>
                                                                    <a href="{{ route('admin.exam.show', [$exam->id]) }}">
                                                                        <button class="btn btn-default btn-sm p-1">
                                                                            <i
                                                                                class="fonticon-setting fs-3 text-warning"></i>
                                                                        </button>
                                                                    </a>
                                                                    <button class="btn btn-default btn-sm p-1 btn-delete"
                                                                        data-id="{{ $exam->id }}">
                                                                        <i
                                                                            class="fonticon-trash-bin fs-2 text-danger"></i></button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        @else
                                            <x-empty-component title="report" />
                                        @endif
                                    </div>
                                    <div class="tab-pane fade show" id="kt_tab_pane_uts_genap" role="tabpanel">
                                        @if ($exams->where('exam_type', 'uts')->where('semester', 'genap')->count() > 0)
                                            <table id="kt_datatable_responsive"
                                                class="table table-striped border rounded gy-5 gs-7">
                                                <thead>
                                                    <!--begin::Table row-->
                                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                        <th data-priority="1">No</th>
                                                        <th data-priority="2">Nama</th>
                                                        <th data-priority="3">Tingkat Kesulitan</th>
                                                        @foreach ($classroom->devision->criterias()->where('is_default', 0)->get() as $criteria)
                                                            <th data-priority="{{ $loop->iteration + 3 }}">
                                                                {{ $criteria->name }}</th>
                                                        @endforeach
                                                        @if (auth()->user()->roles->pluck('name')[0] == 'admin')
                                                            <th>Aksi</th>
                                                        @endif
                                                    </tr>
                                                    <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-semibold text-gray-600">
                                                    @foreach ($exams->where('exam_type', 'uts')->where('semester', 'genap') as $exam)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $exam->studentClassroom->studentSchool->student->name }}
                                                            </td>
                                                            <td>{{ $exam->task_level }}</td>
                                                            @foreach ($exam->examCriterias as $criteria)
                                                                <td>{{ $criteria->score }}</td>
                                                            @endforeach
                                                            @if (auth()->user()->roles->pluck('name')[0] == 'admin')
                                                                <td>
                                                                    <a href="{{ route('admin.exam.show', [$exam->id]) }}">
                                                                        <button class="btn btn-default btn-sm p-1">
                                                                            <i
                                                                                class="fonticon-setting fs-3 text-warning"></i>
                                                                        </button>
                                                                    </a>
                                                                    <button class="btn btn-default btn-sm p-1 btn-delete"
                                                                        data-id="{{ $exam->id }}">
                                                                        <i
                                                                            class="fonticon-trash-bin fs-2 text-danger"></i></button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        @else
                                            <x-empty-component title="report" />
                                        @endif
                                    </div>
                                    <div class="tab-pane fade show" id="kt_tab_pane_uas_ganjil" role="tabpanel">
                                        @if ($exams->where('exam_type', 'uas')->where('semester', 'ganjil')->count() > 0)
                                            <table id="kt_datatable_responsive"
                                                class="table table-striped border rounded gy-5 gs-7">
                                                <thead>
                                                    <!--begin::Table row-->
                                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                        <th data-priority="1">No</th>
                                                        <th data-priority="2">Nama</th>
                                                        <th data-priority="3">Tingkat Kesulitan</th>
                                                        @foreach ($classroom->devision->criterias()->where('is_default', 0)->get() as $criteria)
                                                            <th data-priority="{{ $loop->iteration + 3 }}">
                                                                {{ $criteria->name }}</th>
                                                        @endforeach
                                                        @if (auth()->user()->roles->pluck('name')[0] == 'admin')
                                                            <th>Aksi</th>
                                                        @endif
                                                    </tr>
                                                    <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-semibold text-gray-600">
                                                    @foreach ($exams->where('exam_type', 'uas')->where('semester', 'ganjil')->get() as $exam)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $exam->studentClassroom->studentSchool->student->name }}
                                                            </td>
                                                            <td>{{ $exam->task_level }}</td>
                                                            @foreach ($exam->examCriterias as $criteria)
                                                                <td>{{ $criteria->score }}</td>
                                                            @endforeach
                                                            @if (auth()->user()->roles->pluck('name')[0] == 'admin')
                                                                <td>
                                                                    <a href="{{ route('admin.exam.show', [$exam->id]) }}">
                                                                        <button class="btn btn-default btn-sm p-1">
                                                                            <i
                                                                                class="fonticon-setting fs-3 text-warning"></i>
                                                                        </button>
                                                                    </a>
                                                                    <button class="btn btn-default btn-sm p-1 btn-delete"
                                                                        data-id="{{ $exam->id }}">
                                                                        <i
                                                                            class="fonticon-trash-bin fs-2 text-danger"></i></button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        @else
                                            <x-empty-component title="report" />
                                        @endif
                                    </div>
                                    <div class="tab-pane fade show" id="kt_tab_pane_uas_genap" role="tabpanel">
                                        @if ($exams->where('exam_type', 'uas')->where('semester', 'genap')->count() > 0)
                                            <table id="kt_datatable_responsive"
                                                class="table table-striped border rounded gy-5 gs-7">
                                                <thead>
                                                    <!--begin::Table row-->
                                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                        <th data-priority="1">No</th>
                                                        <th data-priority="2">Nama</th>
                                                        <th data-priority="3">Tingkat Kesulitan</th>
                                                        @foreach ($classroom->devision->criterias()->where('is_default', 0)->get() as $criteria)
                                                            <th data-priority="{{ $loop->iteration + 3 }}">
                                                                {{ $criteria->name }}</th>
                                                        @endforeach
                                                        @if (auth()->user()->roles->pluck('name')[0] == 'admin')
                                                            <th>Aksi</th>
                                                        @endif
                                                    </tr>
                                                    <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-semibold text-gray-600">
                                                    @foreach ($exams->where('exam_type', 'uas')->where('semester', 'genap') as $exam)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $exam->studentClassroom->studentSchool->student->name }}
                                                            </td>
                                                            <td>{{ $exam->task_level }}</td>
                                                            @foreach ($exam->examCriterias as $criteria)
                                                                <td>{{ $criteria->score }}</td>
                                                            @endforeach
                                                            @if (auth()->user()->roles->pluck('name')[0] == 'admin')
                                                                <td>
                                                                    <a href="{{ route('admin.exam.show', [$exam->id]) }}">
                                                                        <button class="btn btn-default btn-sm p-1">
                                                                            <i
                                                                                class="fonticon-setting fs-3 text-warning"></i>
                                                                        </button>
                                                                    </a>
                                                                    <button class="btn btn-default btn-sm p-1 btn-delete"
                                                                        data-id="{{ $exam->id }}">
                                                                        <i
                                                                            class="fonticon-trash-bin fs-2 text-danger"></i></button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        @else
                                            <x-empty-component title="report" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-delete-modal-component />
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->


        <!--begin::Footer-->
        <div id="kt_app_footer" class="app-footer ">
            <!--begin::Footer container-->
            <div class="app-container  container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3 ">
                <!--begin::Copyright-->
                <div class="text-dark order-2 order-md-1">
                    <span class="text-muted fw-semibold me-1">{{ Carbon::now()->format('Y') }}©</span>
                    <a href="https://keenthemes.com/" target="_blank" class="text-gray-800 text-hover-primary">Kelas
                        Industri</a>
                </div>
                <!--end::Copyright-->

                <!--begin::Menu-->
                <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                    <li class="menu-item"><a href="https://keenthemes.com/" target="_blank"
                            class="menu-link px-2">Tentang
                            Kami</a></li>

                    <li class="menu-item"><a href="https://devs.keenthemes.com/" target="_blank"
                            class="menu-link px-2">Syarat & Ketentuan</a></li>

                    <li class="menu-item"><a href="https://1.envato.market/EA4JP" target="_blank"
                            class="menu-link px-2">Kebijakan Privasi</a></li>
                </ul>
                <!--end::Menu-->
            </div>
            <!--end::Footer container-->
        </div>
        <!--end::Footer-->
    </div>
    {{--    Update Status --}}
    {{--    end Update Statusl --}}
@endsection
@section('script')
    <script>
        $("#kt_datatable_responsive").DataTable({
            responsive: true
        });

        $("#kt_datatable").DataTable({
            responsive: true
        });
    </script>
@endsection
