@extends('layouts.master')
@section('title', 'MAHASISWA')
@section('page-title', 'DATA MAHASISWA')
@section('breadcrumb', 'MAHASISWA')

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
                        class="form-control form-control-solid w-250px ps-14" placeholder="Cari Data Mahasiswa">
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
                            <tr class="text-gray-800 fw-semibold fs-6" style="background-color: #e9edc9;">
                                <th>No.</th>
                                <th>Program Studi</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Dosen Wali</th>
                                <th>IPK</th>
                                <th>Status Mahasiswa</th>
                                <th>Status Prakerin</th>
                                <th>Status Seminar</th>
                                <th>Status Sidang</th>
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
    @includeIf('pages.mahasiswa.modal')
    @includeIf('pages.mahasiswa.detail')
@endsection
@push('addon-script')
    <script src="{{ URL::asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $("#kt_datepicker_1").flatpickr();
        
            // Dynamic form fields for Status Mahasiswa conditional logic
            $(document).ready(function() {
            var previousStatus = '';
            
            function handleStatusMahasiswa() {
                var status = $('#status_mahasiswa').val();
                var prakerinStatus = $('#prakerin_status').val();
                var seminarStatus = $('#seminar_status').val();
                var meetingStatus = $('#meeting_status').val();
                
                // Handle Status = Aktif
                if (status === 'aktif') {
                    // Show Status Prakerin field (always visible for Aktif)
                    $('#prakerin_field_wrapper').slideDown();
                    
                    // Set default if empty
                    if (!prakerinStatus) {
                        $('#prakerin_status').val('belum terlaksana').trigger('change');
                        prakerinStatus = 'belum terlaksana';
                    }
                    
                    // IMPORTANT: If Prakerin = "Belum Terlaksana" OR "Sedang Terlaksana"
                    // Do NOT show Status Seminar, Status Sidang, or Informasi Pekerjaan
                    // Show Save button immediately
                    if (prakerinStatus === 'belum terlaksana' || prakerinStatus === 'sedang terlaksana') {
                        // Hide all subsequent fields
                        $('#status_aktif_fields').slideUp();
                        $('#seminar_field_wrapper').slideUp();
                        $('#meeting_field_wrapper').slideUp();
                        $('#alumni_fields').slideUp();
                        
                        // Auto-set defaults for hidden fields
                        $('#seminar_status').val('belum terlaksana').trigger('change');
                        $('#meeting_status').val('belum terlaksana').trigger('change');
                        $('#work_status').val('belum bekerja').trigger('change');
                    } else if (prakerinStatus === 'sudah terlaksana') {
                        // Show Status Seminar and Sidang fields container
                        $('#status_aktif_fields').slideDown();
                        
                        // Show Status Seminar (always shown when Prakerin = Sudah Terlaksana)
                        $('#seminar_field_wrapper').slideDown();
                        
                        // Set default for seminar if empty
                        if (!seminarStatus) {
                            $('#seminar_status').val('belum terlaksana').trigger('change');
                            seminarStatus = 'belum terlaksana';
                        }
                        
                        // Show Status Sidang ONLY if Seminar = Sudah Terlaksana
                        if (seminarStatus === 'sudah terlaksana') {
                            $('#meeting_field_wrapper').slideDown();
                            
                            // Set default for meeting if empty
                            if (!meetingStatus) {
                                $('#meeting_status').val('belum terlaksana').trigger('change');
                                meetingStatus = 'belum terlaksana';
                            }
                            
                            // Show Informasi Pekerjaan ONLY if Status Sidang = Sudah Terlaksana
                            if (meetingStatus === 'sudah terlaksana') {
                                $('#alumni_fields').slideDown();
                            } else {
                                $('#alumni_fields').slideUp();
                                // Auto-set work_status to "Belum Bekerja" if hidden
                                $('#work_status').val('belum bekerja').trigger('change');
                            }
                        } else {
                            // Seminar is not "Sudah Terlaksana", hide Sidang and Alumni fields
                            $('#meeting_field_wrapper').slideUp();
                            $('#meeting_status').val('belum terlaksana').trigger('change');
                            $('#alumni_fields').slideUp();
                            $('#work_status').val('belum bekerja').trigger('change');
                        }
                    }
                } 
                // Handle Status = Cuti or Mengundurkan Diri
                else if (status === 'cuti' || status === 'mengundurkan diri') {
                    // Hide all fields
                    $('#prakerin_field_wrapper').slideUp();
                    $('#status_aktif_fields').slideUp();
                    $('#alumni_fields').slideUp();
                    
                    // Auto-fill defaults only when status changes to Cuti/Mengundurkan Diri
                    if (previousStatus !== status) {
                        $('#prakerin_status').val('belum terlaksana').trigger('change');
                        $('#seminar_status').val('belum terlaksana').trigger('change');
                        $('#meeting_status').val('belum terlaksana').trigger('change');
                        $('#work_status').val('belum bekerja').trigger('change');
                    }
                }
                // Handle Status = Lulus
                else if (status === 'lulus') {
                    // Hide all status fields (prakerin/seminar/sidang)
                    $('#prakerin_field_wrapper').slideUp();
                    $('#status_aktif_fields').slideUp();
                    
                    // Auto-set defaults (no user input)
                    $('#prakerin_status').val('sudah terlaksana').trigger('change');
                    $('#seminar_status').val('sudah terlaksana').trigger('change');
                    $('#meeting_status').val('sudah terlaksana').trigger('change');
                    
                    // Show Informasi Pekerjaan immediately
                    $('#alumni_fields').slideDown();
                }
                // Other statuses (empty)
                else {
                    $('#prakerin_field_wrapper').slideUp();
                    $('#status_aktif_fields').slideUp();
                    $('#alumni_fields').slideUp();
                }
                
                // Update previous status
                previousStatus = status;
            }
            
            function toggleJobFields() {
                var workStatus = $('#work_status').val();
                if (workStatus === 'bekerja') {
                    // Only show job fields when "Bekerja" is selected
                    $('#job_fields').slideDown();
                } else {
                    // Hide all job fields for "Tidak Bekerja" and "Belum Bekerja"
                    $('#job_fields').slideUp();
                }
                // Always hide work_waiting_time_field (not needed anymore)
                $('#work_waiting_time_field').slideUp();
            }
            
            // Listen to status change in modal
            $(document).on('change', '#status_mahasiswa', function() {
                handleStatusMahasiswa();
            });
            
            // Listen to prakerin_status change
            $(document).on('change', '#prakerin_status', function() {
                var status = $('#status_mahasiswa').val();
                if (status === 'aktif') {
                    handleStatusMahasiswa();
                }
            });
            
            // Listen to seminar_status change
            $(document).on('change', '#seminar_status', function() {
                var status = $('#status_mahasiswa').val();
                if (status === 'aktif') {
                    handleStatusMahasiswa();
                }
            });
            
            // Listen to meeting_status change
            $(document).on('change', '#meeting_status', function() {
                var status = $('#status_mahasiswa').val();
                if (status === 'aktif') {
                    handleStatusMahasiswa();
                }
            });
            
            // Listen to work_status change in modal
            $(document).on('change', '#work_status', function() {
                toggleJobFields();
            });
            
            // Initialize when modal opens
            $('#kt_modal_1').on('shown.bs.modal', function() {
                handleStatusMahasiswa();
                toggleJobFields();
            });
            
            // IPK Input Validation (Real-time, Friendly)
            function validateIPK(inputId, errorId, submitId) {
                var input = $('#' + inputId);
                var errorDiv = $('#' + errorId);
                var submitBtn = submitId ? $('#' + submitId) : null;
                
                input.on('input', function(e) {
                    var value = this.value;
                    var originalValue = value;
                    var cursorPos = this.selectionStart;
                    
                    // Remove all non-numeric and non-dot characters (prevent letters)
                    value = value.replace(/[^0-9.]/g, '');
                    
                    // Prevent multiple dots
                    var dotIndex = value.indexOf('.');
                    if (dotIndex !== -1) {
                        value = value.substring(0, dotIndex + 1) + value.substring(dotIndex + 1).replace(/\./g, '');
                    }
                    
                    // Enforce format: ONLY 1 digit before dot (1-4), max 2 digits after
                    var parts = value.split('.');
                    
                    // Only allow 1 digit before dot (must be 1-4)
                    if (parts[0].length > 0) {
                        var firstDigit = parts[0].charAt(0);
                        // Only allow digits 1-4
                        if (firstDigit >= '1' && firstDigit <= '4') {
                            parts[0] = firstDigit;
                        } else if (firstDigit === '0' || firstDigit > '4') {
                            // Block 0 or >4 as first digit
                            parts[0] = '';
                            value = '';
                        } else {
                            parts[0] = firstDigit;
                        }
                    }
                    
                    // Only allow max 2 digits after dot
                    if (parts.length > 1 && parts[1].length > 2) {
                        parts[1] = parts[1].substring(0, 2);
                    }
                    
                    value = parts.join('.');
                    
                    // Update input value if changed
                    if (value !== originalValue) {
                        this.value = value;
                        // Restore cursor position
                        var newCursorPos = Math.min(cursorPos, value.length);
                        this.setSelectionRange(newCursorPos, newCursorPos);
                    }
                    
                    // Range validation (1.00 - 4.00)
                    var numValue = parseFloat(value);
                    var isValid = false;
                    
                    if (value === '' || value === '.' || value.length === 0) {
                        // Empty or incomplete - don't show error yet
                        errorDiv.hide();
                        input.removeClass('is-invalid is-valid');
                        isValid = false;
                    } else if (!isNaN(numValue) && value.match(/^[1-4](\.\d{0,2})?$/)) {
                        // Valid format check
                        if (numValue >= 1.00 && numValue <= 4.00) {
                            // Valid range
                            errorDiv.hide();
                            input.removeClass('is-invalid').addClass('is-valid');
                            isValid = true;
                        } else {
                            // Outside range - show error but keep input (friendly UX)
                            errorDiv.show();
                            input.removeClass('is-valid').addClass('is-invalid');
                            isValid = false;
                        }
                    } else {
                        // Invalid format
                        errorDiv.hide();
                        input.removeClass('is-valid is-invalid');
                        isValid = false;
                    }
                    
                    // Disable/enable submit button
                    if (submitBtn) {
                        if (isValid) {
                            submitBtn.prop('disabled', false);
                        } else {
                            submitBtn.prop('disabled', true);
                        }
                    }
                });
                
                // Validate on blur as well
                input.on('blur', function() {
                    var value = this.value;
                    var numValue = parseFloat(value);
                    
                    if (value && !isNaN(numValue) && value.match(/^[1-4](\.\d{1,2})?$/)) {
                        if (numValue < 1.00 || numValue > 4.00) {
                            errorDiv.show();
                            input.removeClass('is-valid').addClass('is-invalid');
                            if (submitBtn) submitBtn.prop('disabled', true);
                        } else {
                            errorDiv.hide();
                            input.removeClass('is-invalid').addClass('is-valid');
                            if (submitBtn) submitBtn.prop('disabled', false);
                        }
                    } else if (value && value !== '') {
                        // Invalid format on blur
                        errorDiv.hide();
                        input.removeClass('is-valid is-invalid');
                        if (submitBtn) submitBtn.prop('disabled', true);
                    }
                });
                
                // Initial validation
                setTimeout(function() {
                    input.trigger('input');
                }, 100);
            }
            
            // Generation (Angkatan) Input Validation - Only allow year numbers
            function validateGeneration(inputId, errorId, submitId) {
                var input = $('#' + inputId);
                var errorDiv = $('#' + errorId);
                var submitBtn = submitId ? $('#' + submitId) : null;
                
                input.on('input', function(e) {
                    var value = this.value;
                    var originalValue = value;
                    var cursorPos = this.selectionStart;
                    
                    // Remove all non-numeric characters (prevent letters, symbols, decimals)
                    value = value.replace(/[^0-9]/g, '');
                    
                    // Limit to 4 digits (year format)
                    if (value.length > 4) {
                        value = value.substring(0, 4);
                    }
                    
                    // Update input value if changed
                    if (value !== originalValue) {
                        this.value = value;
                        // Restore cursor position
                        var newCursorPos = Math.min(cursorPos, value.length);
                        this.setSelectionRange(newCursorPos, newCursorPos);
                    }
                    
                    // Validate year format (4 digits, reasonable range 1900-2099)
                    var isValid = false;
                    
                    if (value === '' || value.length === 0) {
                        // Empty - don't show error yet
                        errorDiv.hide();
                        input.removeClass('is-invalid is-valid');
                        isValid = false;
                    } else if (value.length === 4) {
                        var yearValue = parseInt(value);
                        if (yearValue >= 1900 && yearValue <= 2099) {
                            // Valid year format
                            errorDiv.hide();
                            input.removeClass('is-invalid').addClass('is-valid');
                            isValid = true;
                        } else {
                            // Invalid year range
                            errorDiv.show();
                            input.removeClass('is-valid').addClass('is-invalid');
                            isValid = false;
                        }
                    } else {
                        // Incomplete (less than 4 digits) - don't show error yet
                        errorDiv.hide();
                        input.removeClass('is-invalid is-valid');
                        isValid = false;
                    }
                    
                    // Disable/enable submit button
                    if (submitBtn) {
                        if (isValid) {
                            submitBtn.prop('disabled', false);
                        } else {
                            submitBtn.prop('disabled', true);
                        }
                    }
                });
                
                // Validate on blur as well
                input.on('blur', function() {
                    var value = this.value;
                    
                    if (value && value.length === 4) {
                        var yearValue = parseInt(value);
                        if (yearValue >= 1900 && yearValue <= 2099) {
                            errorDiv.hide();
                            input.removeClass('is-invalid').addClass('is-valid');
                            if (submitBtn) submitBtn.prop('disabled', false);
                        } else {
                            errorDiv.show();
                            input.removeClass('is-valid').addClass('is-invalid');
                            if (submitBtn) submitBtn.prop('disabled', true);
                        }
                    } else if (value && value !== '') {
                        // Invalid format on blur
                        errorDiv.show();
                        input.removeClass('is-valid').addClass('is-invalid');
                        if (submitBtn) submitBtn.prop('disabled', true);
                    }
                });
                
                // Initial validation
                setTimeout(function() {
                    input.trigger('input');
                }, 100);
            }
            
            // Initialize IPK validation for modal
            $('#kt_modal_1').on('shown.bs.modal', function() {
                validateIPK('gpa', 'gpa_error', 'submit_mahasiswa');
                validateGeneration('generation', 'generation_error', 'submit_mahasiswa');
            });
        });
    </script>
    {{-- Tampil data detail mahasiswa --}}
    <script>
        $(document).on('click', '.detail-btn', function() {
            var mahasiswaId = $(this).data('id');

            // Perform an AJAX request to fetch mahasiswa details
            $.ajax({
                url: "{{ url('/mahasiswa') }}/" + mahasiswaId,
                method: 'GET',
                success: function(response) {
                    // prodi
                    $("#prodi").text(response.prodi);
                    $("#nim").text(response.nim);
                    $("#name").text(response.name);
                    if(response.gender == 'men') {
                        $("#gender").text("Laki-laki");
                    } else {
                        $("#gender").text("Perempuan");
                    }
                    $("#lecturer").text(response.lecturer);
                    $("#gpa").text(response.gpa);
                    $("#status").text(response.status);
                    $("#prakerin_status").text(response.prakerin_status);
                    $("#seminar_status").text(response.seminar_status);
                    $("#meeting_status").text(response.meeting_status);
                    $("#nik ").text(response.nik);
                    $("#birth_place_date").text(response.birth_place + ', ' + response.birth_date);
                    $("#address").text(response.address);
                    $("#religion").text(response.religion);
                    $("#mothers_name").text(response.mothers_name);
                    $("#fathers_name").text(response.fathers_name);
                    $("#generation").text(response.generation);

                    // Show the modal
                    $("#detail_modal").modal('show');
                },
                error: function(error) {
                    // Handle error
                    console.error("Error fetching mahasiswa details:", error);
                }
            });
        });
    </script>
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
                        url: '{{ route('api.mahasiswa.index') }}',
                        type: 'GET',
                        dataSrc: 'results',
                    },
                    "columns": [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'prodi'
                        },
                        {
                            data: 'nim'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'gender',
                            render: function(data, type, row) {
                                if (data == 'men') {
                                    return 'Laki-laki';
                                } else {
                                    return 'Perempuan';
                                }
                            }
                        },
                        {
                            data: 'lecturer'
                        },
                        {
                            data: 'gpa'
                        },
                        {
                            data: 'status'
                        },
                        {
                            data: 'prakerin_status'
                        },
                        {
                            data: 'seminar_status'
                        },
                        {
                            data: 'meeting_status'
                        },
                        {
                            data: null,
                            className: 'no-export',
                            render: function(data, type, row) {
                                var baseUrl = "{{ route('mahasiswa.index') }}";
                                var editUrl = baseUrl + "/" + row.id + "/edit";
                                var deleteUrl = baseUrl + "/" + row.id;

                                @role('admin')
                                    return '<div class="d-flex">' +
                                        '<a href="' + editUrl +
                                        '" type="button" class="btn btn-sm btn-success me-2">Ubah</a>' +
                                        '<button class="btn btn-sm btn-danger delete-btn me-2" data-url="' +
                                        deleteUrl + '">Hapus</button>' +
                                        '<button class="btn btn-sm btn-info detail-btn me-2" data-id="' +
                                        row.id + '">Detail</button>' +
                                        '</div>';
                                @else
                                    return '<div class="d-flex">' + '<button class="btn btn-sm btn-info detail-btn me-2" data-id="' +
                                        row.id + '">Detail</button>' + '</div>';
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
                const documentTitle = 'Mahasiswa Data Report';
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
