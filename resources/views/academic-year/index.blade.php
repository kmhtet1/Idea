@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
@stop
    
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8 margin-tb">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mt-5">
                    <h2>Academic Year List</h2>
                </div>
            </div>
            <div class="col-md-12 text-end mt-4">
                <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal">
                    <i class="fa fa-plus"></i> Add New Academic Year
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-8 margin-tb">
        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-3 alert-flash">
                <span>{{ $message }}</span>
            </div>
        @endif
        <table class="table table-bordered mt-4" id="academic_list">
            <tr class="btn-primary">
                <th>No</th>
                <th>Academic Year</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Closure Date</th>
                <th>Final Closure Date</th>
                <th width="180px">Action</th>
            </tr>
            @foreach ($academic_years as $key => $academic)
            <tr>
                <td>{{ $academic_years->firstItem() + $key}}</td>
                <td>{{ $academic->academic_year }}</td>
                <td>{{ $academic->start_date }}</td>
                <td>{{ $academic->end_date }}</td>
                <td>{{ $academic->closure_date }}</td>
                <td>{{ $academic->final_closure_date }}</td>
                <td>
                    <a class="btn btn-primary btn-sm academic_edit" data-edit="{{$academic}}" data-toggle="modal" data-target="#editModal">
                    <span class="fa fa-edit"></span></a>
                    <button type="button" class="btn btn-danger btn-sm open_delete" data-toggle="modal" data-id="{{$academic->id}}" data-target="#modal_delete"><span class="fa fa-trash"></span></button>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $academic_years->links('pagination::bootstrap-4')}}
    </div>
</div>

<!-- Add Record  Modal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-white bg-primary mb-3">
                <h4 class="modal-title">Add New Academic Year</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="formData" method="POST">
                    @csrf 

                    <div class="form-group">
                        <label for="academic_year">Academic Year </label>
                        <input type="text" class="form-control" name="academic_year" placeholder="Enter Academic Year" required="">
                    </div>                    
                    <div class="form-group">
                        <label for="start_date">Start Date </label>
                        <input type="date" class="form-control" name="start_date" placeholder="Enter Start Date" required="">
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date </label>
                        <input type="date" class="form-control" name="end_date" placeholder="Enter End Date" required="">
                    </div>
                    <div class="form-group">
                        <label for="closure_date">Closure Date </label>
                        <input type="date" class="form-control" name="closure_date" placeholder="Enter Closure Date" required="">
                    </div>
                    <div class="form-group">
                        <label for="final_closure_date">Final Closure Date </label>
                        <input type="date" class="form-control" name="final_closure_date" placeholder="Enter Final Closure Date" required="">
                    </div>

                    <hr>
                    <div class="form-group float-right">
                        <button type="submit" class="btn btn-success" id="btn_save">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header text-white bg-primary mb-3">
                    <h4 class="modal-title">Edit Academic Year</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="EditformData" method="POST">
                        @csrf
                        @method("PATCH")
                        <input type="hidden" name="id" id="edit-form-id">

                        <div class="form-group">
                            <label for="academic_year">Academic Year </label>
                            <input type="text" class="form-control" name="academic_year" id="academic_year" placeholder="Enter Academic Year" required="">
                        </div>                    
                        <div class="form-group">
                            <label for="start_date">Start Date </label>
                            <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Enter Start Date" required="">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date </label>
                            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Enter End Date" required="">
                        </div>
                        <div class="form-group">
                            <label for="closure_date">Closure Date </label>
                            <input type="date" class="form-control" name="closure_date" id="closure_date" placeholder="Enter Closure Date" required="">
                        </div>
                        <div class="form-group">
                            <label for="final_closure_date">Final Closure Date </label>
                            <input type="date" class="form-control" name="final_closure_date" id="final_closure_date" placeholder="Enter Final Closure Date" required="">
                        </div>

                        <hr>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-primary" id="btn_update">Update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="alert_ModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><span class="fa fa-info-circle"></span> Confirmation</h4>
                </div>
                <div class="modal-body">
                    Are you sure want to delete?
                </div>
                <div class="modal-footer">
                    <form id="delete_form" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-primary" id="delete-btn">Yes</button>
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<script type="text/javascript">
 $(document).ready(function() {
      $('#formData').on('btn_save', function(e){

        var url = '{{ route("academic-years.store") }}';

          $.ajax({
                url: url, 
                type: 'POST', 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('#formData').serialize(),
                success: function(data){
                    Swal.fire({
                        icon: 'success',
                        title: 'Saved successfully',
                    });

                    $("#addModal").modal('hide');
                    $("#formData")[0].reset();
                    location.reload();
                },
                error: function(error) {
                    console.log('error');
                    
                }
          });
      });
    

      $(document).on("click", ".academic_edit", function () {
          var edit_datas = $(this).data('edit');  
          $(".modal-body #edit-form-id").val(edit_datas.id);
          $(".modal-body #academic_year").val(edit_datas.academic_year);
          $(".modal-body #start_date").val(edit_datas.start_date);          
          $(".modal-body #end_date").val(edit_datas.end_date);
          $(".modal-body #closure_date").val(edit_datas.closure_date);          
          $(".modal-body #final_closure_date").val(edit_datas.final_closure_date);

          // $(".modal-body #btn_save").html("Update");
      });

      $("#btn_update").click(function(e) {
            e.preventDefault();
           let academic = $('#edit-form-id').val();
           let url = "{{ route('academic-years.update', ':academic') }}"
           url  = url.replace(':academic', academic)
            $.ajax({
                url: url,
                type: "POST",
                data: $("#EditformData").serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated successfully',
                    });
                    $("#editModal").modal('hide');
                    $("#EditformData")[0].reset();
                    setTimeout(function(){location.reload()}, 2200);
                    //$("#academic_list").load(window.location + " #academic_list");
                }
            });
            
        });

          $(document).on("click", ".open_delete", function () { 
                 var id = $(this).data('id');
                 var url = '{{ route("academic-years.destroy", ":id") }}';
                 url = url.replace(':id', id);
                 $('#delete_form').attr('action', url);
             });
  });
</script>
@endsection