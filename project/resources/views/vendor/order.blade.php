<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
?>

@extends('vendor.includes.master-vendor')
@section('content')
<link href="{{ URL::asset('assets/map/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/map/css/custom.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/map/css/font-awesome.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places"></script>

<script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js')}}"></script>
<!--<script src="{{ URL::asset('assets/map/js/bootstrap3.3.4.min.js')}}"></script>-->
<script src="{{ URL::asset('assets/map/js/jquery.blockUI.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {

        var pid = $('.itemSelect option').filter(function () {
            return ($(this).text() == "DNS -- Per File Box");
        }).val();

        $.ajax({
            type: "GET",
            url: '<?php echo route('get_ajax_product'); ?>',
            data: {'id': pid},
            success: function (data) {
                var product = JSON.parse(data);
                var rate = product['price'];

                $('.itemQty').val(1);
                $('.rate').html("$" + rate);
                $('.total').html("$" + rate);
                $('.hf_base_price').val(rate);
                $('.hf_tax').val(tax);

                $row = $('tr.item');
                countRow($row);
            }
        });

        $('.btn-prev').click(function () {
            var url = "";
            window.location = url;
        });

        $(document).on("change", ".itemSelect", function (e) {
            $this = $(this);
            $row = $this.parents('tr.item');

            var price_flag = false;
            if ($row.find('.itemSelect option:selected').text() == "DNS - Open Amount") {
                price_flag = true;
            } else {
                price_flag = false;
            }

            if ($(this).val() == "") {
                var rate = parseFloat(0.00).toFixed(2);
                var tax = parseFloat(0.00).toFixed(2);
                $row.find('.itemQty').val();
                $row.find('.rate').html("$" + rate);
                $row.find('.total').html("$" + rate);
                $row.find('.tax').html("$" + tax);
                $row.find('.hf_base_price').val(rate);
                $row.find('.hf_tax').val(tax);
                $('.subtotal').html("$" + rate);
                $('.finalTax').html("$" + tax);
                $('.grandTotal').html("$" + rate);
                $('#hf_subtotal').val("$" + rate);
                $('#hf_totaltax').val("$" + tax);
                $('#hf_grandtotal').val("$" + rate);
                return false;
            }

            $.ajax({
                type: "GET",
                url: '<?php echo route('get_ajax_product'); ?>',
                data: {'id': $(this).val()},
                success: function (data) {
                    var product = JSON.parse(data);

                    var rate = product['price'];
                    var tax = (rate * 13) / 100;
                    $row.find('.itemQty').val(1);
                    $row.find('.rate').html("$" + rate);
                    $row.find('.total').html("$" + rate);
                    $row.find('.tax').html("$" + tax);
                    $row.find('.hf_base_price').val(rate);
                    $row.find('.hf_tax').val(tax);

                    /*$('.subtotal').html("$"+rate);
                     $('.finalTax').html("$"+tax);
                     $('.grandTotal').html("$"+rate);*/
                    countRow($row);

                    if (price_flag) {
                        $row.find('.rate').hide();
                        $row.find('.hf_base_price').attr('type', 'text');
                    } else {
                        $row.find('.rate').show();
                        $row.find('.hf_base_price').attr('type', 'hidden');
                    }
                }
            });
        });

        $(document).on("change", ".itemQty", function (e) {
            var qty = $(this).val();
            $this = $(this);
            $row = $this.parents('tr.item');

            countRow($row);
        });

        $(document).on("keyup", ".hf_base_price", function (e) {
            var base_price = $(this).val();
            $this = $(this);
            $row = $this.parents('tr.item');

            var tax = (base_price * 13) / 100;
            tax = parseFloat(tax).toFixed(2);
            $('.tax').html("$" + tax);
            $('.hf_tax').val(tax);

            countRow($row);
        });

        $("#addItem").click(function () {
            $('.item>td.action').html($('<div class="form-group"><button title="Remove" class="btn btn-default removeItem" type="button"><i class="fa fa-minus"></i></button></div>'));

            $this = $(this);
            $row = $this.parents('tr.item');

            $newRow = rowTemplate();

            $('table.items tbody').append($newRow);
        });

        $(document).on("click", ".removeItem", function (e) {
            $this = $(this);
            $row = $this.parents('tr.item');
            $row.remove();

            var rows = $('.item>td.action');

            if (rows.length == 1) {
                rows.html('');
            }
            //getSubtotal();
            countRow($row);
        });

        $("#cmb_payment_method").change(function () {
            if ($(this).val() == "1") {
                $('.cheque-data').show();
                $('#txt_cheque_number').attr('required', 'required');
                $('.cc-data').hide();
                hideCCData()
            } else if ($(this).val() == "2") {
                $('.cheque-data').hide();
                $('#txt_cheque_number').removeAttr("required");
                $('.cc-data').hide();
                hideCCData()
            } else if ($(this).val() == "3") {
                $('.cheque-data').hide();
                $('#txt_cheque_number').removeAttr("required");
                $('.cc-data').hide();
                hideCCData()
            } else if ($(this).val() == "4") {
                $('.cheque-data').hide();
                $('#txt_cheque_number').removeAttr("required");
                $('.cc-data').show();
                showCCData();
            } else {
                $('.cheque-data').hide();
                $('#txt_cheque_number').removeAttr("required");
                $('.cc-data').hide();
                hideCCData()
            }
        });

    });

    function showCCData() {
        $('#txt_card_no').attr('required', 'required');
        $('#txt_cardholder_name').attr('required', 'required');
        $('#txt_cvv').attr('required', 'required');
        $('#cmb_exp_month').attr('required', 'required');
        $('#cmb_exp_year').attr('required', 'required');
    }

    function hideCCData() {
        $('#txt_card_no').removeAttr("required");
        $('#txt_cardholder_name').removeAttr("required");
        $('#txt_cvv').removeAttr("required");
        $('#cmb_exp_month').removeAttr("required");
        $('#cmb_exp_year').removeAttr("required");
    }

    function countRow($row) {
        var qty = $row.find('.itemQty').val();
        var rate = $row.find('.hf_base_price').val();
        var tax = $row.find('.hf_tax').val();
        var tax = parseFloat(tax * qty).toFixed(2) || 0;
        var total = parseFloat(rate * qty).toFixed(2) || 0;
        $row.find('.total').html("$" + total);
        $row.find('.tax').html("$" + tax);

        getSubtotal();

        /*$('.subtotal').html("$"+total);
         $('.finalTax').html("$"+tax);
         $('.grandTotal').html("$"+total);*/
    }

    function getSubtotal() {
        subtotal = 0;
        $('.total').each(function (i, el) {
            subtotal += parseFloat($(el).text().replace('$', ''), 10) || 0;
        });

        $('.subtotal').html('$' + subtotal.toFixed(2));

        tax = 0;
        $('.tax').each(function (i, el) {
            tax += parseFloat($(el).text().replace('$', ''), 10) || 0;
        });

        $('.finalTax').html('$' + tax.toFixed(2));

        $('.grandTotal').html('$' + (tax + subtotal).toFixed(2));

        $('#hf_subtotal').val(subtotal.toFixed(2));
        $('#hf_totaltax').val(tax.toFixed(2));
        $('#hf_grandtotal').val((tax + subtotal).toFixed(2));
    }

    function rowTemplate() {

        template = '';
        template += '<tr class="item">';
        template += '<td><div class="form-group"><div>';
        template += $('.itemSelect').prop('outerHTML');
        template += '</div></div></td>';
        template += '<td><div class="form-group"><div>';
        template += '<input name="txt_qty[]" class="itemQty form-control" min="1" required="required" type="number" id="txt_qty">';
        template += '</div></div></td>';
        template += '<td><div class="form-group"><div class="rate form-control-static"></div><input type="hidden" name="hf_base_price[]" class="hf_base_price form-control" value=""></div></td>';
        template += '<td><div class="form-group"><div class="total form-control-static"></div><div class="tax"></div></div></td>';
        template += '<td class="action"><div class="form-group"><button class="btn btn-default removeItem" title="Remove" style="padding: 2px 18px;" type="button"><i class="fa fa-minus"></i></button></div></td>';
        template += '<input type="hidden" name="hf_tax[]" class="hf_tax" value="">';
        template += '</tr>';

        return template;
    }


</script>
	 @if(Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
            @if($_GET['action'] == "new")
                            <div class="bg-success">
                                <div id="flashMessage" class="bg-success">New client added</div>
                            </div>
                            @endif
                <div>
                    <div class="inner" style="width: 100%;">
                        <div id="wizard-form" class="wizard">
                            <ul class="steps">
                                <li data-target="step1"><span class="badge badge-info">1</span>Customer<span class="chevron"></span></li>
                                <li data-target="step2"  class="active"><span class="badge">2</span>Services<span class="chevron"></span></li>
                                <li data-target="step3"><span class="badge">3</span>Confirm<span class="chevron"></span></li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
									<form method="post" action="{{ route('vendor.order_add') }}" id="main-form" class="bg-white basic-form horizontal-form col-md-12 col-sm-12 col-xs-12">
                        {{ csrf_field() }}
                        <div class="step-content">
						
                           
                            <!-- Step 2 Start -->
                            <div class="step-pane">
                                <div class="col-sm-12 col-xs-12 col-md-12 service-block">
                                    <input type="hidden" name="hf_client_id" value="{{ $_GET['client_id'] }}">

                                    <table class="items">
                                        <thead>
                                            <tr>
                                                <td style="width: 55%;">ITEM</td>
                                                <td style="width: 10%;">QTY</td>
                                                <td class="rateCol" style="width: 10%;">RATE</td>
                                                <td class="totalCol" style="width: 10%;">TOTAL</td>
                                                <td style="width: 15%;"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="item">
                                                <td>
                                                    <div class="form-group">
                                                        <?php
                                                            $order_items = DB::table('products')->orderBy('title')->get();
                                                            ?>
                                                            <select name="cmb_order_item[]" id="cmb_order_item" class="itemSelect form-control" style="width: 300px;" required="required">
                                                            <option value="">Select</option>
                                                                <?php
                                                                foreach ($order_items as $order_item) {
                                                                    $selected = "";
                                                                    if ($order_item->title == "DNS -- Per File Box") {
                                                                        $selected = "selected='selected'";
                                                                    }
                                                                    if ($order_item->id == Input::get('cmb_order_item')) {
                                                                        $selected = "selected='selected'";
                                                                    }
                                                                    echo "<option value='" . $order_item->id . "' " . $selected . ">" . $order_item->title . "</option>";
                                                                }
                                                                ?>
                                                                </select>
                                                        </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div>
                                                            <input name="txt_qty[]" class="itemQty form-control" min="1" required="required" type="number" id="txt_qty" >
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="rate form-control-static"></div>
                                                        <input type="hidden" name="hf_base_price[]" class="hf_base_price form-control" value="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="total form-control-static"> </div>
                                                        <div class="tax"></div>
                                                        <input type="hidden" name="hf_tax[]" class="hf_tax" value="">
                                                    </div>
                                                </td> 
											</tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="action"><button class="btn btn-default" id="addItem" title="Add More" style="padding: 2px 18px;" type="button"><i class="fa fa-plus"></i></button></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <span class="label">Subtotal:</span> <span class="subtotal">$0.00</span>
                                                    <input type="hidden" name="hf_subtotal" id="hf_subtotal" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <span class="label">Tax:</span> <span class="finalTax">$0.00</span>
                                                    <input type="hidden" name="hf_totaltax" id="hf_totaltax" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="big-text">
                                                    <span class="label">Grand Total:</span> <span class="grandTotal">$0.00</span>
                                                    <input type="hidden" name="hf_grandtotal" id="hf_grandtotal" value="">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="text-left col-xs-12">
                                        <a href="{{ route('vendor.customer') }}" data-prev="step1" class="btn btn-success btn-next">Back<i class="icon-arrow-left"></i></a>
                                        <button type="submit" class="btn btn-success btn-next" data-last="Finish">Submit<i class="icon-arrow-right"></i></button>
                                    </div>
                                    <div class="form-group"></div>
                                    <div class="form-group"></div>
                                </div>
                            </div>
                        </div>
                    </form>
    </div>
</div>
@stop

@section('footer')

@stop
