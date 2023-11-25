@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/categories') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Edit Child Category</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <div id="response"></div>
                        <form method="POST" action="{!! action('ChildCategoryController@update',['id' => $category->id]) !!}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Main Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="mainid" id="maincats" required>
                                        <option value="">Select Main Category</option>
                                        @foreach($categories as $cat)
                                            @if($cat->id == $category->mainid->id)
                                                <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                                            @else
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sub Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="subid" id="subs" required>
                                        <option value="">Select Sub Category</option>
                                        @foreach($subcats as $subcat)
                                            @if($subcat->id == $category->subid->id)
                                                <option value="{{$subcat->id}}" selected>{{$subcat->name}}</option>
                                            @else
                                                <option value="{{$subcat->id}}">{{$subcat->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category Display Name<span class="required">*</span>
                                    <p class="small-label">(In Any Language)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="name" value="{{$category->name}}" placeholder="e.g Sports" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Category URL Slug<span class="required">*</span>
                                    <p class="small-label">(In English Must Be Unique)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="slug" class="form-control col-md-7 col-xs-12" name="slug" value="{{$category->slug}}" placeholder="e.g sports" required="required" type="text">
                                </div>
                            </div>
                            @if($category->featured != 0)
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="featured" id="atofea" value="1" checked><strong>Add to Featured</strong></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="item form-group" id="fimg">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Current Featured Image <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <img style="max-width: 250px;" src="{{url('assets/images/categories')}}/{{$category->feature_image}}" alt="No Featured Image Added">
                                        </div>
                                    </div>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Change Featured Image<span class="required">*</span>
                                        <p class="small-label">Must Be a Square Sized Image(400x400)</p>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" accept="image/*" name="fimage"/>
                                    </div>
                                </div>
                            @else
                                {{-- <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="featured" id="atofea" value="1"><strong>Add to Featured</strong></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="item form-group" id="fimg" style="display: none;">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Add Featured Image<span class="required">*</span>
                                        <p class="small-label">Must Be a Square Sized Image(400x400)</p>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" accept="image/*" name="fimage" required/>
                                    </div>
                                </div> --}}
                            @endif
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Update Category</button>
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

@stop