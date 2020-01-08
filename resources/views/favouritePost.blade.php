@extends('layouts.backend.app')

@section('title', 'Category')

@push('css')

<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush


@section('content')

<div class="container-fluid">

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Total Favourite Post
                        <span class="badge bg-blue">{{ $favourite_post->count() }}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th><i class="material-icons">favourite </i></th>
                                    <th><i class="material-icons">visibility </i></th>
                                    <th>Action</th>

                                </tr>
                            </thead>



                              @foreach($favourite_post as $key=> $favourite)


                              <tr>
                                  <td>{{ $key +1 }}</td>
                                  <td>{{$favourite->title}}</td>
                                  <td>{{$favourite->user->name}}</td>
                                  <td>{{$favourite->favourite_to_users->count()}}</td>
                                  <td>{{$favourite->view_count}}</td>
                                  <td>
                                    <a class="btn btn-info waves-effect" href="{{route('admin.category.edit', $favourite->id)}}">
                                      <i class="material-icons">edit </i>
                                    </a>

                                    <button type="button" name="button"  class="btn btn-danger waves-effect" onclick="removePost({{$favourite->id}})">
                                      <i class="material-icons" >delete</i>

                                    </button>
                                    <form  id="remove-post-{{$favourite->id}}" action="{{route('post.favourite', $favourite->id)}}"
                                    method="post" style="display:none;"
                                      >
                                      @csrf

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

function removePost(id) {

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
      document.getElementById('remove-post-' + id).submit();
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
