@extends('dashboard.admin.layouts.app')
@section('content')
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">


        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bold my-1 fs-3">
                Guru
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <p class="text-muted">
                List guru pada {{ auth()->user()->name }}.
            </p>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <div class="content flex-column-fluid" id="kt_content">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!--begin::Card body-->
                    <div class="card-body pt-0">

                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatables-responsive">
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
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>

        </div>
        <x-delete-modal-component/>
    </div>
@endsection
@section('script')
    {{--    <script src="{{ asset('app-assets/js/custom/apps/customers/list/export.js') }}"></script>--}}
    <script src="{{ asset('app-assets/js/custom/apps/customers/list/list.js') }}"></script>
    {{--    <script src="{{ asset('app-assets/js/custom/apps/customers/add.js') }}"></script>--}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            $(document).on('click', '.delete', function () {
                const url = "{{ route('school.teachers.destroy', ':id') }}".replace(':id', $(this).data('id'))
                $('#form-delete').attr('action', url)
                $('#kt_modal_delete').modal('show')
            })

            // Datatables Responsive
            $("#datatables-responsive").DataTable({
                // scrollX: false,
                // sScrollX: false,
                // scrollY: false,
                // scrollCollapse: false,
                paging: true,
                pageLength: 10,
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('school.teachers.index') }}",
                oLanguage: {sProcessing: 'loading...'},
                columns: [
                    {
                        data: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'teacher.name',
                        name: 'teacher.name'
                    },
                    {
                        data: 'teacher.email',
                        name: 'teacher.email'
                    },
                    {
                        data: 'teacher.phone_number',
                        name: 'teacher.phone_number'
                    },
                    {
                        data: 'teacher.account_number',
                        name: 'teacher.account_number'
                    },
                    {
                        data: 'teacher.bank',
                        name: 'teacher.bank'
                    },
                ]
            });
        });
    </script>
@endsection
