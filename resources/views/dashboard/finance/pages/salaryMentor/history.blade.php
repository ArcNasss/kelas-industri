@extends('dashboard.finance.layout.app')
@section('content')
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">


        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bold my-1 fs-3">
                Riwayat Gaji Mentor
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <p class="text-muted">
                List riwayat gaji mentor pada kelas industri.
            </p>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <div class="content flex-column-fluid" id="kt_content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="d-flex justify-content-end me-4">
                        <form class="d-flex mt-5" style="width: 300px;" role="search" method="GET">
                            <input class="form-control me-2" type="text" name="search" placeholder="Cari Mentor"
                                aria-label="Search" value="{{ request('search') }}">
                            <button class="btn btn-dark fw-bold" type="submit" id="search">Cari</button>
                        </form>
                    </div>
                    <!--begin::Card body-->
                    <div class="card-body pt-4">

                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Gaji</th>
                                    <th>Bukti</th>
                                    <th>Tanggal Penggajian</th>
                                    <th>Bulan</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->

                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600">
                                @forelse ($mentors as $mentor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mentor->user->name }}</td>
                                        <td>{{ 'Rp ' . number_format($mentor->salary_amount, 2, ',', '.') }}</td>
                                        <td> <svg type="button" class="btn-photo"
                                                data-photo="{{ asset('storage/' . $mentor->photo) }}"
                                                xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8.5 13.498l2.5 3.006l3.5-4.506l4.5 6H5m16 1v-14a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2z"
                                                    fill="#474761" />
                                            </svg> </td>
                                        <td>{{ \Carbon\Carbon::parse($mentor->payday)->locale('id')->isoFormat('D MMMM YYYY') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($mentor->payday)->locale('id')->isoFormat('MMMM') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="col-12 text-center">
                                                <!--begin::Illustration-->
                                                <img src="{{ asset('user-assets/media/misc/watch.svg') }}" class="h-150px"
                                                    alt="" />
                                                <!--end::Illustration-->

                                                <!--begin::Title-->
                                                <h4 class="fw-bold text-gray-900 my-4">Ups ! Masih Kosong</h4>
                                                <!--end::Title-->

                                                <!--begin::Desctiption-->
                                                <span class="fw-semibold text-gray-700 mb-4 d-block">
                                                    Tidak ada history untuk saat ini.
                                                </span>
                                                <!--end::Desctiption-->
                                            </div>

                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        {{-- {{$mentors->links('pagination::bootstrap-5')}} --}}
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.btn-photo').click(function() {
            var photo = $(this).data('photo')
            $('#photo').attr('src', photo);
            $('#modal_photo').modal('show')
        });
    </script>
@endsection
