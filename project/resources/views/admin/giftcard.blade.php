@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/gift-cards') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    @if($id === 'new')
                    <h3>Add Gift Card</h3>
                    @else
                    <h3>Edit Gift Card</h3>
                    @endif
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="gocover"></div>
                        <div id="response"></div>
                        @if($id === 'new')
                        <form method="POST" action="{!! action('GiftCardController@store') !!}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        @else
                        <form method="POST" action="{!! action('GiftCardController@update',['gift_card' => $id]) !!}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        @endif

                            {{csrf_field()}}

                            @if($id !== 'new')
                            <input type="hidden" name="_method" value="PATCH">
                            @endif

                            <input id="status" class="form-control col-md-7 col-xs-12" name="status" placeholder="Gift Card Status" 
                            @if($id !== 'new')
                            value = "{{ $giftcard->status }}"
                            @else
                            value = "1"
                            @endif
                            required="required" type="hidden">

                            <input id="is_deleted" class="form-control col-md-7 col-xs-12" name="is_deleted" placeholder="Gift Card Is Delete" 
                            @if($id !== 'new')
                            value = "{{ $giftcard->is_deleted }}"
                            @else
                            value = "0"
                            @endif
                            required="required" type="hidden">

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Code<span class="required">*</span></label>
                                <div class="col-md-4 col-sm-4 col-xs-8">
                                    <input id="code" class="form-control col-md-4 col-xs-8" name="code" placeholder="Gift Card Code" 
                                    @if($id !== 'new')
                                    value = "{{ $giftcard->code }}"
                                    @endif
                                    required="required" type="text"
                                    onkeypress="return event.charCode == 13  || event.charCode == 8 || event.charCode == 46 || event.target.value.length < 6">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-4" style="padding-left: 0px">
                                    <button id="auto_code" class="btn btn-primary">Generate Random Code</button>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="title" class="form-control col-md-7 col-xs-12" name="title" placeholder="Gift Card Title" 
                                    @if($id !== 'new')
                                    value = "{{ $giftcard->title }}"
                                    @endif
                                    required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="description" name="description" class="form-control col-md-7 col-xs-12" placeholder="Gift Card Description" required="required">@if($id !== 'new'){{ $giftcard->description }}@endif</textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img src="{{ $id !== 'new' ? url('assets/img/gift-cards/' . $giftcard->image) : null }}" height="100" id="image_preview">
                                    <button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('image').click();">Browse Image</button>  
                                    <input id="image" class="form-control col-md-7 col-xs-12" style="display:none" name="image" placeholder="Gift Card Image"
                                        onchange="readURL(this)"
                                        value = "{{ $id !== 'new' ? url('assets/img/gift-cards/' . $giftcard->image) : null }}"
                                        {{ $id == 'new' ? 'required="required"' : null }} type="file">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="purchase_price">Purchase Price<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="purchase_price" class="form-control col-md-7 col-xs-12" name="purchase_price" placeholder="Gift Card Purchase Price" 
                                    @if($id !== 'new')
                                    value = "{{ $giftcard->purchase_price }}"
                                    @endif
                                    onkeypress="return (event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode == 46  || event.charCode == 0"
                                    required="required" type="number" step="0.01" min="0">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="credit_amount">Credit Amount<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="credit_amount" class="form-control col-md-7 col-xs-12" name="credit_amount" placeholder="Gift Card Credit Amount" 
                                    @if($id !== 'new')
                                    value = "{{ $giftcard->credit_amount }}"
                                    @endif
                                    onkeypress="return (event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode == 46  || event.charCode == 0"
                                    required="required" type="number" step="0.01" min="0">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expiry_date">Expiry Date<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="expiry_date" class="form-control col-md-7 col-xs-12" name="expiry_date" placeholder="Gift Card Expiry Date" 
                                    @if($id !== 'new')
                                    value = "{{ $giftcard->expiry_date }}"
                                    @endif
                                    type="text">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    @if($id === 'new')
                                    <button id="add_giftcard" type="submit" class="btn btn-success btn-block">Add New Gift Card</button>
                                    @else
                                    <button id="update_giftcard" type="submit" class="btn btn-success btn-block">Update Gift Card</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@stop

@section('footer')
    <script>
        document.getElementById("auto_code").addEventListener("click", function(event){
            event.preventDefault();
            var length = 6;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            document.getElementById("code").value = result;
        });

        $( function() {
            $("#expiry_date").datepicker({dateFormat: 'yy-mm-dd'});
        } );

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#image_preview').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@stop