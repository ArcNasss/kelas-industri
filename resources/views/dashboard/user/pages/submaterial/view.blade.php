@extends('dashboard.user.layouts.wide')
@section('style')
    <style>
        .buttonHover:hover {
            background-color: #009ef7;
            color: white !important
        }
    </style>
@endsection
@section('content')
    <div style="width: 99%;">
        <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">

            <div id="kt_app_toolbar" class="app-toolbar py-4 py-lg-8 ">

                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack flex-wrap ">
                    <!--begin::Toolbar wrapper-->
                    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">


                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                            <!--begin::Title-->
                            <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                                {{ $submaterial->title }}
                            </h1>
                            <!--end::Title-->

                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    {{ count($submaterial->assignments) }} Tugas
                                </li>
                                <!--end::Item-->

                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                        <!--begin::Actions-->
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <a href="{{ url()->previous() }}"
                                class="btn btn-flex btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold">
                                <i class="bi bi-arrow-left me-2"></i> Kembali
                            </a>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Toolbar wrapper-->
                </div>
                <!--end::Toolbar container-->
            </div>
        </div>
        <div class="content flex-column-fluid" id="kt_content">
            <div class="row">
                <div class=" text-center">
                    <div class="mx-auto flex flex-col">
                        {{--                    <div class="flex justify-between my-4"> --}}
                        {{--                        <nav class="nav justify-content-end"><a class="border rounded py-2 px-4 bg-blue-500" id="prev" --}}
                        {{--                                                                href="#">prev</a><a --}}
                        {{--                                class="border rounded py-2 px-4 bg-blue-500" id="next" href="#">next</a></nav> --}}
                        {{--                    </div> --}}
                        <div class="flex-grow">
                            <canvas id="pdfviewer">
                                <p>Loading... </p>
                            </canvas>
                        </div>
                        <div class="pages text-center my-4"><span class="mr-2">Halaman </span><span
                                id="currentPage">0</span><span class="mx-1">/</span><span id="totalPages">0</span></div>
                    </div>
                </div>
                @empty($listSubMaterials->count())
                    <!-- Tidak ada konten -->
                    <div class="d-flex justify-content-between align-items-center container-fluid app-container mb-5">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="prev-sub-materials">
                                @foreach ($prevSubMaterials as $prevSubMaterial)
                                    <a @if (auth()->user()->roles->pluck('name')[0] == 'student') href="{{ route('common.showDocument', [$prevSubMaterial->id, 'student']) }}"
                                        @elseif (auth()->user()->roles->pluck('name')[0] == 'teacher')
                                        href="{{ route('common.showDocument', [$prevSubMaterial->id, 'teacher']) }}"
                                        @else
                                        href="{{ route('common.showDocument', [$prevSubMaterial->id, 'mentor']) }}" @endif
                                        class="text-end align-items-center" style="width: 210px">
                                        <div class="d-flex justify-content-between align-items-center px-3 py-2 rounded buttonHover"
                                            style="border: 1px solid #6e6e6e">
                                            <svg class="buttonHover" xmlns="http://www.w3.org/2000/svg" width="32"
                                                height="32" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="m7.85 13l2.85 2.85q.3.3.288.7t-.288.7q-.3.3-.712.313t-.713-.288L4.7 12.7q-.3-.3-.3-.7t.3-.7l4.575-4.575q.3-.3.713-.287t.712.312q.275.3.288.7t-.288.7L7.85 11H19q.425 0 .713.288T20 12q0 .425-.288.713T19 13z" />
                                            </svg>
                                            <div class="d-flex flex-column text-dark  ms-2 buttonHover">
                                                <span class="fs-9 text-gray-800">{{ $prevSubMaterial->title }} -
                                                    Sebelumnya</span>
                                                <span class="fs-7">{{ Str::limit($prevSubMaterial->material->title, 25, '...') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row row-cols-2 align-items-center container-fluid app-container mb-5">
                        <div class="d-flex justify-content-start align-items-center color-gray-700 next-sub-materials">
                            @foreach ($prevSubMaterials as $prevSubMaterial)
                                <a @if (auth()->user()->roles->pluck('name')[0] == 'student') href="{{ route('common.showDocument', [$prevSubMaterial->id, 'student']) }}"
                                        @elseif (auth()->user()->roles->pluck('name')[0] == 'teacher')
                                        href="{{ route('common.showDocument', [$prevSubMaterial->id, 'teacher']) }}"
                                        @else
                                        href="{{ route('common.showDocument', [$prevSubMaterial->id, 'mentor']) }}" @endif
                                    class="text-end align-items-center" style="width: 210px">
                                    <div class="d-flex justify-content-between align-items-center px-3 py-2 rounded buttonHover"
                                        style="border: 1px solid #6e6e6e">
                                        <svg class="buttonHover" xmlns="http://www.w3.org/2000/svg" width="32"
                                            height="32" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="m7.85 13l2.85 2.85q.3.3.288.7t-.288.7q-.3.3-.712.313t-.713-.288L4.7 12.7q-.3-.3-.3-.7t.3-.7l4.575-4.575q.3-.3.713-.287t.712.312q.275.3.288.7t-.288.7L7.85 11H19q.425 0 .713.288T20 12q0 .425-.288.713T19 13z" />
                                        </svg>
                                        <div class="d-flex flex-column text-dark  ms-2 buttonHover">
                                            <span class="fs-9 text-gray-800">{{ $prevSubMaterial->title }} - Sebelumnya</span>
                                            <span class="fs-7">{{ Str::limit($prevSubMaterial->material->title, 25, '...') }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-end align-items-center color-gray-700 next-sub-materials">
                            @foreach ($listSubMaterials as $listSubMaterial)
                                <a @if (auth()->user()->roles->pluck('name')[0] == 'student') href="{{ route('common.showDocument', [$listSubMaterial->id, 'student']) }}"
                                        @elseif (auth()->user()->roles->pluck('name')[0] == 'student')
                                        href="{{ route('common.showDocument', [$listSubMaterial->id, 'teacher']) }}"
                                        @else
                                        href="{{ route('common.showDocument', [$listSubMaterial->id, 'mentor']) }}" @endif
                                    class="align-items-center" style="width: 210px">
                                    <div class="d-flex justify-content-between align-items-center px-3 py-2 rounded buttonHover"
                                        style="border: 1px solid #6e6e6e">
                                        <div class="d-flex flex-column text-dark  me-2">
                                            <span class="fs-9 text-gray-800">Selanjutnya - {{ $listSubMaterial->title }}</span>
                                            <span class="fs-7">{{ Str::limit($listSubMaterial->material->title, 25, '...') }}</span>
                                        </div>
                                        <svg class="buttonHover" xmlns="http://www.w3.org/2000/svg" width="32"
                                            height="32" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M16.15 13H5q-.425 0-.712-.288T4 12q0-.425.288-.712T5 11h11.15L13.3 8.15q-.3-.3-.288-.7t.288-.7q.3-.3.713-.312t.712.287L19.3 11.3q.15.15.213.325t.062.375q0 .2-.062.375t-.213.325l-4.575 4.575q-.3.3-.712.288t-.713-.313q-.275-.3-.288-.7t.288-.7z" />
                                        </svg>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endempty
            </div>
            <x-delete-modal-component />
        </div>
    </div>
@endsection
@section('custom-action')
    <!--begin::Engage-->
    <div class="app-engage " id="kt_app_engage">
        <!--begin::Prebuilts toggle-->
        <a href="#" id="prev" class="app-engage-btn hover-primary">
            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2023-01-30-131017/core/html/src/media/icons/duotune/arrows/arr074.svg-->
            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
            Prev
        </a>
        <!--end::Prebuilts toggle-->

        <!--begin::Prebuilts toggle-->
        <a href="#" id="zoom-in" class="app-engage-btn hover-primary">
            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2023-01-30-131017/core/html/src/media/icons/duotune/arrows/arr075.svg-->
            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                        transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                </svg></span>
            <!--end::Svg Icon-->
            Zoom In
        </a>
        <!--end::Prebuilts toggle-->

        <!--begin::Prebuilts toggle-->
        <a href="#" id="zoom-out" class="app-engage-btn hover-primary">
            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2023-01-30-131017/core/html/src/media/icons/duotune/arrows/arr089.svg-->
            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
            Zoom Out
        </a>
        <!--end::Prebuilts toggle-->

        <!--begin::Prebuilts toggle-->
        <a href="#" id="next" class="app-engage-btn hover-primary">
            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2023-01-30-131017/core/html/src/media/icons/duotune/arrows/arr071.svg-->
            <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
            Next
        </a>
        <!--end::Prebuilts toggle-->
    </div>
    <!--end::Engage-->
@endsection
@section('script')
    <script src="{{ asset('app-assets/plugins/custom/pdfjs-3.4.120-dist/build/pdf.js') }}"></script>
    {{--    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script> --}}
    <script>
        // setup
        var width = 60;
        const url =
            "{{ $role == 'teacher' || $role == 'mentor' ? asset('storage/' . $submaterial->teacher_file) : asset('storage/' . $submaterial->student_file) }}";

        const pdfjsLib = window["pdfjs-dist/build/pdf"];
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            "{{ asset('app-assets/plugins/custom/pdfjs-3.4.120-dist/build/pdf.worker.js') }}";

        $('#pdfviewer').css('width', `${width}%`)


        let loggedIn = true,
            pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 1,
            canvas = document.getElementById("pdfviewer"),
            ctx = canvas.getContext("2d");

        /**
         * Get page info from document, resize canvas accordingly, and render page.
         * @param num Page number.
         */
        function renderPage(num) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                const viewport = page.getViewport({
                    scale
                });
                // Set dimensions to Canvas
                var resolution = 2; // for example

                // canvas.height = viewport.height;
                // canvas.width = viewport.width;
                canvas.height = resolution * viewport.height; //actual size
                canvas.width = resolution * viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport,
                    transform: [resolution, 0, 0, resolution, 0, 0] // force it bigger size
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById("currentPage").textContent = num;
        }

        /**
         * If another page rendering in progress, waits until the rendering is
         * finised. Otherwise, executes rendering immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        /**
         * Asynchronously downloads PDF.
         */
        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById("totalPages").textContent = pdfDoc.numPages;

            // Initial/first page rendering
            renderPage(pageNum || 1);
        });

        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }

        document.getElementById("prev").addEventListener("click", onPrevPage);

        function onNextPage() {
            if (
                (pageNum < 5) ||
                loggedIn
            ) {
                if (pageNum >= pdfDoc.numPages) {
                    return;
                }
                pageNum++;
                queueRenderPage(pageNum);
            } else {
                toastr.error("You Must be Logged in to view more pages", "Sorry");
            }
        }

        document.getElementById("next").addEventListener("click", onNextPage);


        const loggedInClass = "bg-green-500";
        const loggedOutClass = "bg-red-500";
        $(".nav").prepend($("<a>", {
                href: "#"
            })
            .text("Logged In")
            .addClass("border py-2 px-4 rounded " + ((loggedIn) ? loggedInClass : loggedOutClass))
            .on("click", function(e) {
                e.preventDefault();
                if (loggedIn) {
                    $(this).removeClass(loggedInClass).addClass(loggedOutClass);
                    loggedIn = false;
                } else {
                    $(this).removeClass(loggedOutClass).addClass(loggedInClass);
                    loggedIn = true;
                }
            }));

        document.getElementById("zoom-in").addEventListener("click", function() {
            if (width < 100) {
                width += 10
                $('#pdfviewer').css('width', `${width}%`)
            }
        });

        document.getElementById("zoom-out").addEventListener("click", function() {
            if (width > 50) {
                width -= 10
                $('#pdfviewer').css('width', `${width}%`)
            }
        });
    </script>
    @if (session('error'))
        <script>
            Swal.fire({
                text: "{{ Session::get('error') }}",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok!",
                customClass: {
                    confirmButton: "btn btn-danger"
                }
            });
        </script>
    @endif
@endsection
