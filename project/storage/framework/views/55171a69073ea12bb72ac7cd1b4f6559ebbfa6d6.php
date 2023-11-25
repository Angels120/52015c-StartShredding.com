<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <style>
        .w-100 {
            width: 51% !important;
        }

        .w-50 {
            width: 25% !important;
        }
    </style>
    <div class="page-title row">
        <h2>Booking Date: <?php echo e(date('Y-m-d', strtotime($order->booking_date))); ?></h2>
        <div style="float: right;">
        </div>
    </div>
    <div class="bg-white row">
        <div class="panel-body-custom tableContainParent panel col-md-12 col-lg-12 col-sm-12 left-tab">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="top-title">
                        <h3>Order Details</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="mt-2 col-md-4">
                            <p><strong>ID:</strong></p>
                            <p><?php echo e($order->id); ?></p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Payment Method:</strong></p>
                            <p><?php echo e($order->method); ?></p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Payment Status:</strong></p>
                            <p><?php echo e($order->payment_status); ?></p>
                        </div>
                        <div class="mt-2 col-md-4">
                            <p><strong><u>Billing Address</u></strong></p>
                            <p><?php echo e($order->customer_name); ?></p>
                            <p><?php echo e($order->customer_address); ?></p>
                            <p><?php echo e($order->customer_city); ?></p>
                            <p><?php echo e($order->customer_zip); ?></p>
                            <p><?php echo e($order->customer_phone); ?></p>
                        </div>
                        <div class="mt-2 col-md-4">
                            <p><strong><u>Shipping Address</u></strong></p>
                            <p><?php echo e($order->shipping_name); ?></p>
                            <p><?php echo e($order->shipping_address); ?></p>
                            <p><?php echo e($order->shipping_city); ?></p>
                            <p><?php echo e($order->shipping_zip); ?></p>
                            <p><?php echo e($order->shipping_phone); ?></p>
                        </div>
<br/>
                        <div class="panel-body-custom tableContainParent panel col-md-12 col-lg-12 col-sm-12 ">
                            <div class="table-responsive">
                                <div id="example_wrapper" class="dataTables_wrapper no-footer">
                                    <table class="table table-bordered w-100">
                                        <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>QTY</th>
                                            <th>Sub Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $total=0.00;
                                        foreach ($products As $product){
                                        ?>
                                        <tr>
                                            <td><?php echo e($product->item_note); ?></td>
                                            <td><?php echo e(number_format((float)$product->base_price, 2, '.', '')); ?></td>
                                            <td><?php echo e($product->qty); ?></td>
                                            <?php
                                            $sub_total=$product->base_price*$product->qty;
                                            $total=$sub_total+$total;
                                            ?>
                                            <td><?php echo e(number_format((float)$sub_total, 2, '.', '')); ?></td>

                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><b>Tax</b></td>
                                            <td><b><?php echo e(number_format((float)$total*0.13, 2, '.', '')); ?></b></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><b>Total</b></td>
                                            <td><b><?php echo e(number_format((float)($total*0.13+$total), 2, '.', '')); ?></b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <a href="/vendor/customer/<?php echo e($order->customerid); ?>/orders" class="btn btn-success float-right my-2">Back To Customer
                orders</a>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"
            type="text/javascript"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 50,
                ajax: '/vendor/get-template-ajax',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'job_type_id', name: 'job_type_id'},
                    {data: 'repeat', name: 'repeat'},
                    {data: 'schedule_from', name: 'schedule_from'},
                    {data: 'action', name: 'action', searchable: false}
                ]
            });
        });
        var increment = 1;
        var laravelToken = "<?php echo csrf_token(); ?>";
        var options = <?php echo json_encode($products); ?>;

        function addItem() {
            $('.item-tbody').append(
                '<tr id="' + "row" + increment + '">'
                + '<td><select  name="item[' + increment + '][product_id]">' +
                '<option value="">Select Product</option></select>' +
                '</td>'
                + '<td><input type="textarea" name="item[' + increment + '][item_note]"/></td>'
                + '<td><input type="text" name="item[' + increment + '][qty]"/></td>'
                + '<td><input type="text" class="price" name="item[' + increment + '][base_price]"/></td>'
                + '<td><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();"'
                + 'class="btn btn-danger float-right">'
                + '<i class="glyphicon glyphicon-minus-sign"></i> remove</a></td>'
                + '</tr>'
            );
            $.each(options, function (value, key) {
                $("#row" + increment).find('select')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
            increment++;
        }

        $('table').on('change', "select", function () {
            var self = this;
            $.ajax({
                url: "/vendor/template-product/get-price",
                method: "POST", //First change type to method here

                data: {
                    id: this.value, // Second add quotes on the value.
                    _token: laravelToken
                },
                success: function (response) {
                    console.log(response);
                    jQuery(self).parent().parent().find(".price").val(response);
                },
                error: function () {
                    alert("Something went wrong!");
                }

            });
        });
        $('input[name="dates"]').daterangepicker({
            minDate: moment()
        });
        $('input[name="date"]').datepicker({
            minDate: moment()
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.includes.master-vendor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>