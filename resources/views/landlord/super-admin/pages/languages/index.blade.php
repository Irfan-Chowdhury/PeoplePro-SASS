@extends('landlord.super-admin.layouts.master')
@section('landlord-content')

<section>
    <div class="container-fluid"><span id="generalResult"></span></div>

    <div class="container-fluid mb-3">
        <h4 class="font-weight-bold mt-3">{{__('file.Languages')}}</h4>
        <div id="success_alert" role="alert"></div>
        <br>

        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> {{__('file.Add New')}}</button>
    </div>

    <div class="container">
        <div class="table-responsive">
            <table id="dataListTable" class="table">
                <thead>
                    <tr>
                        <th class="not-exported"></th>
                        <th>{{__('file.Name')}}</th>
                        <th>{{__('file.Locale')}}</th>
                        <th>{{__('file.Default')}}</th>
                        <th class="not-exported">{{__('file.Action')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>

@include('landlord.super-admin.pages.languages.create-modal')
@include('landlord.super-admin.pages.languages.edit-modal')

@endsection


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let table = $('#dataListTable').DataTable({
                initComplete: function () {
                    this.api().columns([1]).every(function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                            $('select').selectpicker('refresh');
                        });
                    });
                },
                responsive: true,
                fixedHeader: {
                    header: true,
                    footer: true
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('language.datatable') }}",
                },
                columns: [
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'locale',
                        name: 'locale',
                    },
                    {
                        data: 'is_default',
                        name: 'is_default',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                    }
                ],

                "order": [],
                'language': {
                    'lengthMenu': '_MENU_ {{__("records per page")}}',
                    "info": '{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)',
                    "search": '{{trans("file.Search")}}',
                    'paginate': {
                        'previous': '{{trans("file.Previous")}}',
                        'next': '{{trans("file.Next")}}'
                    }
                },
                'columnDefs': [
                    {
                        "orderable": false,
                        'targets': [0, 3],
                    },
                    {
                        'render': function (data, type, row, meta) {
                            if (type == 'display') {
                                data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                            }

                            return data;
                        },
                        'checkboxes': {
                            'selectRow': true,
                            'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                        },
                        'targets': [0]
                    }
                ],
                'select': {style: 'multi', selector: 'td:first-child'},
                'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: '<"row"lfB>rtip',
                buttons: [
                    {
                        extend: 'pdf',
                        text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'csv',
                        text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i title="print" class="fa fa-print"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'colvis',
                        text: '<i title="column visibility" class="fa fa-eye"></i>',
                        columns: ':gt(0)'
                    },
                ],
            });

            new $.fn.dataTable.FixedHeader(table);
        });

        let storeURL = "{{route('language.store')}}";
        let updateURL = '/super-admin/languages/update/';
        let destroyURL = '/super-admin/languages/destroy/';



        //--------- Edit -------
        $(document).on('click', '.edit', function () {
            let id = $(this).data("id");
            let editURL = `/super-admin/languages/edit/${id}`;
            $.ajax({
                url: editURL,
                method: "GET",
                data: {id:id},
                success: function (response) {
                    console.log(response);
                    $('#modelId').val(response.id);
                    $('#name').val(response.name);
                    $('#locale').val(response.locale);
                    if (response.is_default === 1) {
                        $('#isDefault').prop('checked', true);
                    } else {
                        $('#isDefault').prop('checked', false);
                    }
                    // $('#isDefault').prop('checked',response.is_default);
                    $('#editModal').modal('show');
                }
            })
        });
    </script>

    <script type="text/javascript" src="{{asset('js/landlord/common-js/store.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/landlord/common-js/update.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/landlord/common-js/delete.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/landlord/common-js/alertMessages.js')}}"></script>
@endpush
