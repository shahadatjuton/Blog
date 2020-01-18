@extends('layouts.backend.app')

@section('title', 'Pending Post')

@push('css')

<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endpush


@section('content')

<div class="container-fluid">
    <div class="block-header">
        <h2>
          Post Table
        </h2>

        <a class="btn btn-primary waves-effect" href="{{route('admin.post.create' )}}">

            <span>Create Post</span>
       </a>
    </div>

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        TOTAL POST
                        <span class="badge bg-blue">{{ $posts->count() }}</span>
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
                                    <th><i class="material-icons">visibility </i></th>
                                    <th>Status</th>
                                    <th>Condition</th>
                                    <th>Updated At</th>
                                    <th>Action</th>

                                </tr>
                            </thead>





                              <tbody>
                                @foreach($posts as $key=> $post)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{str_limit($post->title,15)}}</td>

                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->view_count}}</td>
                                    <td>
                                      @if ($post->status==true)
                                        <span class="badg bg-green">Published</span>
                                      @else
                                        <span class="badg bg-yellow">Pending</span>
                                      @endif
                                    </td>
                                    <td>
                                      @if ($post->is_approved==true)
                                        <span class="badg bg-green">Approved</span>
                                      @else
                                        <span class="badg bg-yellow">Pending</span>
                                      @endif
                                    </td>

                                    <td>{{$post->updated_at}} At</td>
                                    <td>
                                      @if($post->is_approved==false)

                                      <button type="button" name="button" class="btn btn-success waves-effect" onclick="approvePost({{ $post->id }})">
                                        <i class="material-icons">done </i>
                                        <span>Approve</span>
                                      </button>

                                      <form  id="approve-post-{{$post->id}}" action="{{route('admin.post.approve', $post->id)}}"
                                      method="post" style="display:none;"
                                        >
                                        @csrf
                                        @method('PUT')

                                      </form>


                                      @endif

                                      <a class="btn btn-info waves-effect" href="{{route('admin.post.show', $post->id)}}">
                                        <i class="material-icons">visibility </i>
                                      </a>
                                      <a class="btn btn-info waves-effect" href="{{route('admin.post.edit', $post->id)}}">
                                        <i class="material-icons">edit </i>
                                      </a>

                                      <button type="button" name="button"  class="btn btn-danger waves-effect" onclick="deletepost({{$post->id}})">
                                        <i class="material-icons" >delete</i>

                                      </button>
                                      <form  id="delete-post-{{$post->id}}" action="{{route('admin.post.destroy', $post->id)}}"
                                      method="post" style="display:none;"
                                        >
                                        @csrf
                                        @method('DELETE')

                                      </form>

                                    </td>
                                </tr>
                                @endforeach

                              </tbody>







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

function deletepost(id) {

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
      document.getElementById('delete-post-' + id).submit();
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

// Approve post notification message using toaster
function approvePost(id) {

  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: 'Are you sure?',
    text: "You wan't to approve this post!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, Approve this post!',
    cancelButtonText: 'No, cancel!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      event.preventDefault();
      document.getElementById('approve-post-' + id).submit();
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Cancelled',
        'Your post remains as unapproved :)',
        'error'
      )
    }
  })

}


</script>

@endpush
