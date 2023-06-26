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
                                    Peringkat
                                </h1>
                                <!--end::Title-->

                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        <a href="../../index-2.html" class="text-muted text-hover-primary">
                                            daftar siswa dengan nilai
                                            terbaik. </a>
                                    </li>
                                    <!--end::Item-->
                                    <!--end::Item-->

                                </ul>
                                <!--end::Breadcrumb-->
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
                <div id="kt_app_content_container" class="app-container  container-fluid ">
                    <div class="row">
                        @if (auth()->user()->roles->pluck('name')[0] == 'mentor')
                            <form id="form-search" action="{{ route('mentor.rankings') }}">
                            @elseif (auth()->user()->roles->pluck('name')[0] == 'teacher')
                                <form id="form-search" action="{{ route('teacher.rankings') }}">
                                @else
                                <form id="form-search" action="{{ route('student.rankings') }}">
                        @endif
                        <!--begin::Card-->
                        <div class="card mb-7">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::Compact form-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Input group-->
                                    <div class="position-relative col-lg-6 col-md-12 me-3">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <!--end::Svg Icon-->
                                            <select name="filter" class="form-select form-select-solid" placeholder="Select an option"
                                                data-control="select2">
                                                <option value="">Semua Sekolah</option>
                                                @foreach ($schools as $school)
                                                    <option {{ $filter == $school->id ? 'selected' : '' }} value="{{ $school->id }}">
                                                        {{ $school->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <select name="school_year" class="form-select form-select-solid"
                                                    data-control="select2" data-placeholder="Tahun Ajaran">
                                                    @foreach ($schoolYear as $year)
                                                        <option {{ $schoolYearFilter == $year->id ? 'selected' : '' }}
                                                            value="{{ $year->id }}">
                                                            {{ $year->school_year }}</option>
                                                    @endforeach
                                                </select>
                                    </div>
                                    <div class="col-lg-2 col-md-12 ms-3">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                        @if (auth()->user()->roles->pluck('name')[0] == 'mentor')
                                            <a href="{{ route('mentor.rankings') }}" type="button"
                                                class="btn btn-light text-light ms-2"><i class="fonticon-repeat"></i></a>
                                        @elseif (auth()->user()->roles->pluck('name')[0] == 'teacher')
                                            <a href="{{ route('teacher.rankings') }}" type="button"
                                                class="btn btn-light text-light ms-2"><i class="fonticon-repeat"></i></a>
                                        @else
                                        <a href="{{ route('student.rankings') }}" type="button"
                                        class="btn btn-light text-light ms-2"><i class="fonticon-repeat"></i></a>
                                        @endif
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Compact form-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                @if (auth()->user()->roles->pluck('name')[0] == 'student')
                                <div class="card-header">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        @php
                                                $ranking = $rankings->search(function ($rank) {
                                                    return $rank->student_id === auth()->id();
                                                });
                                            @endphp

                                            <span class="card-label fw-bold text-gray-800">
                                                <span class="svg-icon svg-icon-muted svg-icon-2hx">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14 18V16H10V18L9 20H15L14 18Z" fill="currentColor" />
                                                        <path opacity="0.3"
                                                            d="M20 4H17V3C17 2.4 16.6 2 16 2H8C7.4 2 7 2.4 7 3V4H4C3.4 4 3 4.4 3 5V9C3 11.2 4.8 13 7 13C8.2 14.2 8.8 14.8 10 16H14C15.2 14.8 15.8 14.2 17 13C19.2 13 21 11.2 21 9V5C21 4.4 20.6 4 20 4ZM5 9V6H7V11C5.9 11 5 10.1 5 9ZM19 9C19 10.1 18.1 11 17 11V6H19V9ZM17 21V22H7V21C7 20.4 7.4 20 8 20H16C16.6 20 17 20.4 17 21ZM10 9C9.4 9 9 8.6 9 8V5C9 4.4 9.4 4 10 4C10.6 4 11 4.4 11 5V8C11 8.6 10.6 9 10 9ZM10 13C9.4 13 9 12.6 9 12V11C9 10.4 9.4 10 10 10C10.6 10 11 10.4 11 11V12C11 12.6 10.6 13 10 13Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                {{ auth()->user()->name }}
                                                @if ($ranking !== false)
                                                Anda Berada Pada Ranking {{ $ranking + 1 }}
                                                @else
                                                Anda Belum Memiliki Point
                                                @endif
                                            </span>
                                        </h3>
                                        <!--end::Title-->
                                    </div>
                                    @endif
                                    <div class="card-body">
                                @if($rankings->count() > 0)
                                <table id="kt_datatable_responsive"
                                class="table table-striped border rounded gy-5 gs-7">
                                <thead>
                                    <tr class="fw-semibold fs-6 text-gray-800">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Sekolah</th>
                                        <th>Point</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rankings as $key => $ranking)
                                        <tr>
                                            @if ($key == 0)
                                                <td><img width="50px"
                                                        src="{{ asset('storage/medal_file/gold-medal.png') }}"
                                                        alt=""></td>
                                            @elseif ($key == 1)
                                                <td><img width="50px"
                                                        src="{{ asset('storage/medal_file/silver-medal.png') }}"
                                                        alt=""></td>
                                            @elseif ($key == 2)
                                                <td><img width="50px"
                                                        src="{{ asset('storage/medal_file/bronze-medal.png') }}"
                                                        alt=""></td>
                                            @else
                                                <td>
                                                    <div class="d-flex justify-content-center items-center"
                                                        style="width:50px; height:50px; ">
                                                        <p>{{ $loop->iteration }}</p>
                                                    </div>
                                                </td>
                                            @endif
                                            <td>{{ $ranking->student->name }}</td>
                                            <td>{{ $ranking->student->studentSchool->school->name }}</td>
                                            <td>{{ $ranking->point }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                @else
                                <x-empty-component title="ranking" />
                                @endif

                                </div>
                            </div>
                        </div>
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
                        <span class="text-muted fw-semibold me-1">{{ \Carbon\Carbon::now()->format('Y') }}©</span>
                        <a href="https://keenthemes.com/" target="_blank" class="text-gray-800 text-hover-primary">Kelas
                            Industri</a>
                    </div>
                    <!--end::Copyright-->

                    <!--begin::Menu-->
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                        <li class="menu-item"><a href="https://keenthemes.com/" target="_blank"
                                class="menu-link px-2">Tentang Kami</a></li>

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
    @endsection
    @section('script')
        <script>
            $("#kt_datatable_responsive").DataTable({
                responsive: true
            });
        </script>
    @endsection
