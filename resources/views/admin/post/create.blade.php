@extends('layouts.backend.app')

@section('title', 'Category')

@push('css')

<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

<!-- Multi Select Css -->
<link href="{{ asset('assets/backend/plugins/multi-select/css/multi-select.css')}}" rel="stylesheet">
<!-- Bootstrap Select Css -->
<link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

@endpush


@section('content')

<h1>Create Category</h1>


<div class="container-fluid">

  <!-- Vertical Layout | With Floating Label -->
  <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
    @csrf
          <div class="row clearfix">
              <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="header">
                          <h2>
                              Add Category

                          </h2>
                          <ul class="header-dropdown m-r--5">
                              <li class="dropdown">
                                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                      <i class="material-icons">more_vert</i>
                                  </a>
                                  <ul class="dropdown-menu pull-right">
                                      <li><a href="javascript:void(0);">Action</a></li>
                                      <li><a href="javascript:void(0);">Another action</a></li>
                                      <li><a href="javascript:void(0);">Something else here</a></li>
                                  </ul>
                              </li>
                          </ul>
                      </div>
                      <div class="body">
                          <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                              <div class="form-group form-float">
                                  <div class="form-line">
                                      <input type="text" id="name" class="form-control" name="title" placeholder="{{old('title')}}">

                                  </div>
                              </div>
                              <div class="form-group form-float">
                                  <div class="form-line">
                                    <label for="">Featured Image</label>
                                      <input type="file" id="name" class="form-control" name="image">
                                  </div>
                              </div>

                              <div class="form-group form-float">

                                    <input type="checkbox" id="publish" class="form-control" name="status" value="1">
                                    <label for="">Publish</label>

                              </div>

                          </form>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="header">
                          <h2>
                              CATEGORIES & TAGS

                          </h2>
                          <ul class="header-dropdown m-r--5">
                              <li class="dropdown">
                                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                      <i class="material-icons">more_vert</i>
                                  </a>
                                  <ul class="dropdown-menu pull-right">
                                      <li><a href="javascript:void(0);">Action</a></li>
                                      <li><a href="javascript:void(0);">Another action</a></li>
                                      <li><a href="javascript:void(0);">Something else here</a></li>
                                  </ul>
                              </li>
                          </ul>
                      </div>
                      <div class="body">
                          <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                              <div class="form-group form-float">
                                  <div class="form-line">
                                    <label for="">Select Category</label>
                                    <select name="categories[]" class="form-control show-tick" data-live-searche="true" multiple>
                                      @foreach($categories as $category)
                                      <option value="{{$category->id}}">{{$category->name}}</option>

                                      @endforeach

                                    </select>

                                  </div>
                              </div>
                              <div class="form-group form-float">
                                  <div class="form-line">
                                    <label for="">Select Tag</label>
                                    <select name="tags[]" class="form-control show-tick" data-live-searche="true" multiple>
                                      @foreach($tags as $tag)
                                      <option value="{{$category->id}}">{{$tag->name}}</option>

                                      @endforeach

                                    </select>

                                  </div>
                              </div>


                              <br>
                              <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.tag.index')}}"> Back</a>
                              <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="header">
                          <h2>
                              Add Category

                          </h2>
                          <ul class="header-dropdown m-r--5">
                              <li class="dropdown">
                                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                      <i class="material-icons">more_vert</i>
                                  </a>
                                  <ul class="dropdown-menu pull-right">
                                      <li><a href="javascript:void(0);">Action</a></li>
                                      <li><a href="javascript:void(0);">Another action</a></li>
                                      <li><a href="javascript:void(0);">Something else here</a></li>
                                  </ul>
                              </li>
                          </ul>
                      </div>
                      <div class="body">
                          <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                              <div class="form-group form-float">
                                  <div class="form-line">
                                      <input type="text" id="name" class="form-control" name="name" placeholder="{{old('name')}}">

                                  </div>
                              </div>
                              <div class="form-group form-float">
                                  <div class="form-line">
                                      <input type="file" id="name" class="form-control" name="image">

                                  </div>
                              </div>


                              <br>
                              <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.tag.index')}}"> Back</a>
                              <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
  </form>
  <!-- Vertical Layout | With Floating Label -->

</div>


@endsection






@push('js')

<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

<!-- Select Plugin Js -->
<script src="{{asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<!-- Multi Select Plugin Js -->
<script src="{{asset('assets/backend/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
<!-- Custom Js -->

<script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
@endpush
