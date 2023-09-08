<?php $__env->startSection('landlord-content'); ?>



<div class="container-fluid mb-3">
    <div class="card">
        <div class="card-header"><h3><?php echo e(__('file.Customers')); ?></h3></div>
        <div class="card-body">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> <?php echo e(__('file.Add New')); ?></button>
        </div>
    </div>
</div>


<div class="table-responsive">
    <table id="dataListTable" class="table">
        <thead>
            <tr>
                <th class="not-exported"></th>
                <th><?php echo e(trans('file.ID')); ?></th>
                <th><?php echo e(trans('file.Database')); ?></th>
                <th><?php echo e(trans('file.Domain')); ?></th>
                <th><?php echo e(trans('file.Customer')); ?></th>
                <th><?php echo e(trans('file.Email')); ?></th>
                <th><?php echo e(trans('file.Package')); ?></th>
                <th><?php echo e(trans('file.Subscription Type')); ?></th>
                
                <th class="not-exported"><?php echo e(trans('file.Action')); ?></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<?php echo $__env->make('landlord.super-admin.pages.customers.create-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('landlord.super-admin.pages.customers.renew-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('landlord.super-admin.pages.customers.change-package-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        let dataTableURL = "<?php echo e(route('customer.datatable')); ?>";
        let storeURL = "<?php echo e(route('customer.signup')); ?>";
        let tenantInfoURL = '/super-admin/customers/tenant-info/';
        let renewSubscriptionURL = '/super-admin/customers/renew-subscription/';
        let changePackageURL = '/super-admin/customers/change-package/';
        let destroyURL = '/super-admin/customers/destroy/';
    </script>

    <script type="text/javascript">
        (function ($) {
            var packages = <?php echo json_encode($packages, 15, 512) ?>;

            "use strict";
            $(document).ready(function() {


                var date = $('.date');
                date.datepicker({
                    format: '<?php echo e(env('Date_Format_JS')); ?>',
                    autoclose: true,
                    todayHighlight: true
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let table = $('#dataListTable').DataTable({
                    initComplete: function() {
                        this.api().columns([1]).every(function() {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function(d, j) {
                                select.append('<option value="' + d + '">' + d +
                                    '</option>');
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
                        url: dataTableURL,
                    },
                    columns: [{
                            data: 'id',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'tenantId',
                            name: 'tenantId',
                        },
                        {
                            data: 'database',
                            name: 'database',
                        },
                        {
                            data: 'domain',
                            name: 'domain',
                        },
                        {
                            data: 'customer',
                            name: 'customer',
                        },
                        {
                            data: 'email',
                            name: 'email',
                        },
                        {
                            data: 'package',
                            name: 'package',
                        },
                        {
                            data: 'subscription_type',
                            name: 'subscription_type',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                        }
                    ],

                    "order": [],
                    'language': {
                        'lengthMenu': '_MENU_ <?php echo e(__('records per page')); ?>',
                        "info": '<?php echo e(trans('file.Showing')); ?> _START_ - _END_ (_TOTAL_)',
                        "search": '<?php echo e(trans('file.Search')); ?>',
                        'paginate': {
                            'previous': '<?php echo e(trans('file.Previous')); ?>',
                            'next': '<?php echo e(trans('file.Next')); ?>'
                        }
                    },
                    'columnDefs': [{
                            "orderable": false,
                            'targets': [0, 3],
                        },
                        {
                            'render': function(data, type, row, meta) {
                                if (type == 'display') {
                                    data =
                                        '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
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
                    'select': {
                        style: 'multi',
                        selector: 'td:first-child'
                    },
                    'lengthMenu': [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    dom: '<"row"lfB>rtip',
                    buttons: [{
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

            // Renew
            $(document).on("click", ".renewSubscription", function (e) {
                e.preventDefault();
                let id = $(this).data("id");
                $.get({
                    url: tenantInfoURL + id,
                    success: function(response) {
                         console.log(response);
                        $("#modelId").val(response.id);
                        $("#expiryDate").val(response.expiry_date);

                        if ($('#subscriptionType1').val() === response.subscription_type) {
                            $('#subscriptionType1').prop('checked', true);
                        }
                        else if ($('#subscriptionType2').val() === response.subscription_type) {
                            $('#subscriptionType2').prop('checked', true);
                        }
                        else if ($('#subscriptionType3').val() === response.subscription_type) {
                            $('#subscriptionType3').prop('checked', true);
                        }
                        $('#editRenewModal').modal('show');
                    }
                })
            });

            $(document).ready(function() {
                $("#updateRenewForm").on("submit",function(e){
                    e.preventDefault();
                    let id = $('#modelId').val();
                    $('#updateButtonRenew').text('Updating...');
                    $.post({
                        url: renewSubscriptionURL + id,
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        error: function(response) {
                            console.log(response);
                            let htmlContent = prepareMessage(response);
                            displayErrorMessage(htmlContent);
                            $('#updateButtonRenew').text('Update');
                        },
                        success: function (response) {
                            console.log(response);
                            displaySuccessMessage(response.success);
                            if ($.fn.DataTable.isDataTable('#dataListTable')) {
                                $('#dataListTable').DataTable().ajax.reload();
                                $('#updateRenewForm')[0].reset();
                                $("#editRenewModal").modal('hide');
                            }
                            $('#updateButtonRenew').text('Update');
                        }
                    });
                });
            });


            // Change Package
            $(document).on("click", ".changePackage", function (e) {
                e.preventDefault();
                let id = $(this).data("id");
                $.get({
                    url: tenantInfoURL + id,
                    success: function(response) {
                        $("#tenantId").val(response.id);
                        $('#packageIdChange').selectpicker('val', response.package_id);
                        $('#editChangePackageModal').modal('show');
                    }
                })
            });
            $(document).ready(function() {
                $("#packageUpdateForm").on("submit",function(e){
                    e.preventDefault();
                    let id = $('#tenantId').val();
                    $('#updateButtonPackage').text('Updating...');
                    $.post({
                        url: changePackageURL + id,
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        error: function(response) {
                            console.log(response);
                            let htmlContent = prepareMessage(response);
                            displayErrorMessage(htmlContent);
                            $('#updateButtonPackage').text('Update');
                        },
                        success: function (response) {
                            console.log(response);
                            displaySuccessMessage(response.success);
                            if ($.fn.DataTable.isDataTable('#dataListTable')) {
                                $('#dataListTable').DataTable().ajax.reload();
                                $('#packageUpdateForm')[0].reset();
                                $("#editChangePackageModal").modal('hide');
                            }
                            $('#updateButtonPackage').text('Update');
                        }
                    });
                });
            });


        })(jQuery);
    </script>

    <script type="text/javascript" src="<?php echo e(asset('js/landlord/common-js/store.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/landlord/common-js/delete.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/landlord/common-js/alertMessages.js')); ?>"></script>




    

<?php $__env->stopPush(); ?>

<?php echo $__env->make('landlord.super-admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/peopleprosaas/resources/views/landlord/super-admin/pages/customers/index.blade.php ENDPATH**/ ?>