@extends('layouts.backend.app')

@section('title', 'Tag')

@push('css')

<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush


@section('content')

<div class="container-fluid">
    <div class="block-header">
        <h2>
          Taggs Table

        </h2>

        <a class="btn btn-primary waves-effect" href="{{route('admin.tag.create' )}}">
            <i class="material-icons">add</i>
            <span>Create Tag</span>
       </a>
    </div>

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                      TOTAL TAGS <b>:</b>
                      <span class="badge bg-blue">{{ $tags->count() }}</span>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created At </th>
                                    <th>Updated At</th>
                                    <th>Action</th>

                                </tr>
                            </thead>



                              @foreach($tags as $key=> $tag)


                              <tr>
                                  <td>{{ $key +1 }}</td>
                                  <td>{{$tag->name}}</td>
                                  <td>{{$tag->created_at}}</td>
                                  <td>{{$tag->updated_at}}</td>
                                  <td>
                                    <a class="btn btn-info waves-effect" href="{{route('admin.tag.edit', $tag->id)}}">
                                      <i class="material-icons">edit </i>
                                    </a>

                                    <button type="button" name="button"  class="btn btn-danger waves-effect" onclick="deletetag({{$tag->id}})">
                                      <i class="material-icons" >delete</i>

                                    </button>
                                    <form  id="delete-tag-{{$tag->id}}" action="{{route('admin.tag.destroy', $tag->id)}}"
                                    method="post" style="display:none;"
                                      >
                                      @csrf
                                      @method('DELETE')

                                    </form>

                                  </td>
                              </tr>

                              @endforeach
                            </thead>




                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
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


<!-- Custom Js -->

<script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{ asset('assets/backend/js/sweetalert2.all.min.js')}}"></script>


<script type="text/javascript">

function deletetag(id) {

  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      event.preventDefault();
      document.getElementById('delete-tag-' + id).submit();
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Cancelled',
        'Your data is safe :)',
        'error'
      )
    }
  })

}

</script>

@endpush
