@extends('dashboard.finance.layout.app')
@section('content')
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">


        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bold my-1 fs-3">
                Mentor
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <p class="text-muted">
                List mentor pada kelas industri.
            </p>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->

        <!--begin::Actions-->
        <div class="d-flex align-items-center py-2 py-md-1">

            <!--begin::Button-->
            <a href="{{ route('administration.mentor.create') }}" class="btn btn-dark fw-bold">
                Tambah </a>
            <!--end::Button-->
        </div>
        <!--end::Actions-->
    </div>
    <div class="content flex-column-fluid" id="kt_content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="" method="GET">
                        <input type="text" name="search" placeholder="cari mentor" value="{{request('search')}}" />
                        <button type="submit" id="search">cari</button>
                    </form>
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
                                    <th>Email</th>
                                    <th>No Telepon</th>
                                    <th>No Rekening</th>
                                    <th>Bank</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->

                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($mentors as $mentor)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$mentor->name}}</td>
                                        <td>{{$mentor->email}}</td>
                                        <td>{{$mentor->phone_number}}</td>
                                        <td>{{$mentor->account_number}}</td>
                                        <td>{{$mentor->bank}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        {{$mentors->links('pagination::bootstrap-5')}}
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>

        </div>
        <x-delete-modal-component />
    </div>
@endsection
