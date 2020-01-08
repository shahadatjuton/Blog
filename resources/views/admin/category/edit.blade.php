@extends('layouts.backend.app')

@section('title', 'Category')

@push('css')

<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush


@section('content')

<h1>
    <img src="{{asset('storage/category/'.$category->image)}}" alt="Image"  class="img-fluid" style="height: 120px; width: 140px;">

</h1>


<!-- Vertical Layout | With Floating Label -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Update Category
                </h2>

            </div>
            <div class="body">
                <form action="{{route('admin.category.update', $category->id)}}" method="post"  enctype="multipart/form-data">
                  @csrf

                  @method('PUT')

<!--
                  @if ($errors->any())
                  <div class="alert alert-danger">
                    @if($errors->count()==1)
                    {{$errors->first() }}

                    @else

                    <ul>
                      @foreach ($errors->all() as $error )
                      <li> {{ $error }} </li>
                      @endforeach
                    </ul>
                    @endif

                  </div>
                  @endif -->

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="name" value="{{($category->name)}}">

                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="file"  class="form-control" name="image">

                        </div>
                    </div>


                    <br>
                    <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.category.index')}}"> Back</a>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Vertical Layout | With Floating Label -->

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


<!-- Custom Js -->

<script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
@endpush
