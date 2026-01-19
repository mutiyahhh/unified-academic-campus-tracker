@extends('layouts.master')
@section('title', 'PMB')
@section('page-title', 'DATA PENERIMAAN MAHASISWA BARU')
@section('breadcrumb', 'PENERIMAAN MAHASISWA BARU')

@push('addon-style')
    <link href="{{ URL::asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    @include('partials.alert')
    <div class="card">
        <div class="pt-6 border-0 card-header">
            <div class="card-title">
                <!--begin::Search-->
                <div class="my-1 d-flex align-items-center position-relative">
                    <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-4"><span class="path1"></span><span
                            class="path2"></span></i> <input type="text" data-kt-filter="search"
                        class="form-control form-control-solid w-250px ps-14" placeholder="Cari Data PMB">
                </div>
                <!--end::Search-->
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-light-primary me-2" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
                        Export Data
                    </button>
                    @role('admin')
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                        Tambah Data
                    </button>
                    @endrole
                    <!--begin::Menu-->
                    <div id="kt_datatable_example_export_menu"
                        class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="px-3 menu-item">
                            <a href="#" class="px-3 menu-link" data-kt-export="excel">
                                Export as Excel
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="px-3 menu-item">
                            <a href="#" class="px-3 menu-link" data-kt-export="pdf">
                                Export as PDF
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <div id="kt_datatable_example_buttons" class="d-none"></div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="kt_datatable_example_wrapper dt-bootstrap4 no-footer" class="datatables_wrapper">
                <div class="table-responsive">
                    <table class="table table-row-bordered gy-5 gs-7" id="kt_datatable_example">
                        <thead>
                            <tr class="text-gray-800 fw-semibold fs-6"
                            style="background-color: #e9edc9;">
                                <th>No.</th>
                                <th>Prodi</th>
                                <th>Tahun Penerimaan</th>
                                <th>Jumlah Pendaftar</th>
                                <th>Kuota Diterima</th>
                                <th>Pendaftar Ulang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-900 fw-semibold">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @includeIf('pages.pmb.modal')
@endsection
@push('addon-script')
    <script src="{{ URL::asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        "use strict";

        // Class definition
        var KTDatatablesExample = function() {
            // Shared variables
            var table;
            var datatable;

            // Private functions
            var initDatatable = function() {
                // Set date data order
                const tableRows = table.querySelectorAll('tbody tr');

                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    order: [],
                    pageLength: 10,
                    scrollX: true,
                    "ajax": {
                        url: '{{ route('api.pmb.index') }}',
                        type: 'GET',
                        dataSrc: 'results',
                    },
                    "columns": [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                        },
                        {
                            data: 'prodi'
                        },
                        {
                            data: 'year'
                        },
                        {
                            data: 'number_of_registrants'
                        },
                        {
                            data: 'quota_accepted'
                        },
                        {
                            data: 're_registration'
                        },
                        {
                            data: null,
                            className: 'no-export',
                            render: function(data, type, row) {
                                var baseUrl = "{{ route('pmb.index') }}";
                                var editUrl = baseUrl + "/" + row.id + "/edit";
                                var deleteUrl = baseUrl + "/" + row.id;

                                @role('admin')
                                return '<div class="d-flex">' +
                                    '<a href="' + editUrl +
                                    '" type="button" class="btn btn-sm btn-success me-2">Ubah</a>' +
                                    '<button class="btn btn-sm btn-danger delete-btn" data-url="' +
                                    deleteUrl + '">Hapus</button>' +
                                    '</div>';
                                @else
                                return ''
                                @endrole
                            },
                        },
                    ],
                });
            }

            document.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('delete-btn')) {
                    e.preventDefault();

                    // Get the delete URL from the data-url attribute
                    var deleteUrl = e.target.getAttribute('data-url');

                    // Show the SweetAlert confirmation
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: 'Data yang dihapus tidak dapat dikembalikan!',
                        icon: 'warning',
                        buttonsStyling: false,
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: 'btn btn-danger'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If the user confirms, submit the delete form
                            var form = document.createElement('form');
                            form.action = deleteUrl;
                            form.method = 'POST';

                            var csrfField = document.createElement('input');
                            csrfField.type = 'hidden';
                            csrfField.name = '_token';
                            csrfField.value = '{{ csrf_token() }}';

                            var methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';

                            form.appendChild(csrfField);
                            form.appendChild(methodField);

                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                }
            });

            // Hook export buttons
            var exportButtons = () => {
                const documentTitle = 'PMB Data Report';
                var buttons = new $.fn.dataTable.Buttons(table, {
                    buttons: [{
                            extend: 'copyHtml5',
                            title: documentTitle,
                            exportOptions: {
                                columns: ':not(.no-export)'
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            title: documentTitle,
                            exportOptions: {
                                columns: ':not(.no-export)'
                            },
                            customize: function(xlsx) {
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                $('row c', sheet).attr('s', '50');
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            title: documentTitle,
                            exportOptions: {
                                columns: ':not(.no-export)'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            title: documentTitle,
                            exportOptions: {
                                columns: ':not(.no-export)'
                            },
                            orientation: 'landscape',
                            pageSize: 'A4',
                            customize: function(doc) {
                                doc.defaultStyle.fontSize = 9;
                                doc.styles.tableHeader.fontSize = 10;
                                doc.styles.tableHeader.alignment = 'center';
                                doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                                doc.styles.tableBodyEven.alignment = 'center';
                                doc.styles.tableBodyOdd.alignment = 'center';
                            }
                        }
                    ]
                }).container().appendTo($('#kt_datatable_example_buttons'));

                // Hook dropdown menu click event to datatable export buttons
                const exportButtons = document.querySelectorAll(
                    '#kt_datatable_example_export_menu [data-kt-export]');
                exportButtons.forEach(exportButton => {
                    exportButton.addEventListener('click', e => {
                        e.preventDefault();

                        // Get clicked export value
                        const exportValue = e.target.getAttribute('data-kt-export');
                        const target = document.querySelector('.dt-buttons .buttons-' +
                            exportValue);

                        // Trigger click event on hidden datatable export buttons
                        target.click();
                    });
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.querySelector('[data-kt-filter="search"]');
                filterSearch.addEventListener('keyup', function(e) {
                    datatable.search(e.target.value).draw();
                });
            }

            // Public methods
            return {
                init: function() {
                    table = document.querySelector('#kt_datatable_example');

                    if (!table) {
                        return;
                    }

                    initDatatable();
                    exportButtons();
                    handleSearchDatatable();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KTDatatablesExample.init();
        });
    </script>
@endpush
