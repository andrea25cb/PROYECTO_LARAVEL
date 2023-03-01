@extends('layout.layout')

@section('title','USERS')

@section('content')
    
<div class="pull-left"><h2>USERS LIST:</h2></div>
    <div class="pull-right mb-2">
    {{-- <a class="btn btn-success" href="{{ route('users.create') }}"> NEW USER</a> --}}
    <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Add New User</button>
    
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    @error('nif')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror<p>
    </div>
    @endif
    <div class="card-body">

        <table class="table table-bordered yajra-datatable">
            <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col" width="15%">NIF</th>
                <th scope="col" width="15%">NAME</th>
                <th scope="col" width="15%">USERNAME</th>
                <th scope="col" width="10%">ADDRESS</th>
                <th scope="col" width="10%">EMAIL</th>
                <th scope="col" width="10%">TLF</th>
                <th scope="col" width="10%">TIPO</th>
                <th scope="col" width="1%" colspan="3"></th>    
            </tr>
            </thead>
            <tbody id="users-list" name="users-list">
            </tbody>
    </table> 
    </div>
    </div>
    {{-- <div class="modal fade" id="linkShowModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"> 
                  hola
                    <h4 class="modal-title" id="linkShowModalLabel">User:</h4>  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="linkEditorModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"> 
                  
                    <h4 class="modal-title" id="linkEditorModalLabel">User</h4>  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="">
                        <div id="errorName" class="text-danger"></div>
                        <div class="form-group">
                            <label for="inputLink" class="col-sm-2 control-label">name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Enter Name" value="">   
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputLink" class="col-sm-2 control-label">username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username"
                                       placeholder="Enter username" value="">
                                       <div id="errorUsername" class="text-danger"></div>
                            </div>
                     
                        </div>

                        <div class="form-group">
                            <label for="inputLink" class="col-sm-2 control-label">nif</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nif" name="nif"
                                       placeholder="Enter nif" value="">
                                       <div id="errorNif" class="text-danger"></div>
                            </div>
                    
                        </div>

                        <div class="form-group">
                            <label for="inputLink" class="col-sm-2 control-label">email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Enter email" value="">
                                       <div id="errorEmail" class="text-danger"></div>
                            </div>
                   
                        </div>

                        <div class="form-group">
                            <label for="inputLink" class="col-sm-2 control-label">tlf</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="tlf" name="tlf"
                                       placeholder="Enter tlf" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">direccion</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                       placeholder="Enter direccion" value="">
                            </div>
                   
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Enter password" value="">
                            </div>
                     
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">password confirmation</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                       placeholder="Enter password_confirmation" value="">
                            </div>
                         
                        </div>
                       
                        <div class="form-group">
                            <label class="col-sm-2 control-label">tipo</label>
                            <div class="col-sm-10">
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="admin" @selected(old('tipo')) >admin </option>
                            <option value="operario" @selected(old('tipo'))  >operario </option>
                          </select>
                        </div>
                    </div>
                    </form>
                </div>
        
                    <button type="submit" class="btn btn-primary" id="btn-save" value="add">Save changes
                    </button>
                    {{-- <input type="hidden" id="link_id" name="link_id" value="0"> --}}
            </div>
        </div>
    </div>
</div>
</div>

    @endsection

    @section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">

$(function () {

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
       
            {data: 'id', name: 'id'},
            {data: 'nif', name: 'nif'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'tlf', name: 'tlf'},
            {data: 'direccion', name: 'direccion'},
            {data: 'tipo', name: 'tipo'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
})

  jQuery(document).ready(function($){
    ////----- Open the modal to CREATE a user -----////
    jQuery('#btn-add').click(function () {
        jQuery('#btn-save').val("add");
        jQuery('#modalFormData').trigger("reset");
        jQuery('#linkEditorModal').modal('show');
    });

    $('body').on('click', '.deletePost', function () {
        var id = $(this).data("id");
        swal.fire({
            title: "Delete user?",
            icon: 'question',
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete user!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('users.store') }}"+'/'+id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        location.reload();
                        if (results.success === true) {
                            swal.fire("Done!", results.message, "success");
                            // table.draw();
                            // refresh page after 2 seconds
                          location.reload();
                            
                        } 
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    })

    ////----- Open the modal to UPDATE a user -----////
    jQuery('body').on('click', '.open-modal', function () {
        var id = $(this).val();
        $.get("{{ route('users.store') }}" +'/' + id +'/edit', function (data) {
        //  $.get("{{ route('users.store') }}" + id, function (data) {
            jQuery('#nif').val(data.nif);
            jQuery('#name').val(data.name);
            jQuery('#username').val(data.username);
            jQuery('#email').val(data.email);
            jQuery('#tlf').val(data.tlf);
            jQuery('#direccion').val(data.direccion);
            jQuery('#password').val(data.password);
            jQuery('#password_confirmation').val(data.password_confirmation);
            jQuery('#tipo').val(data.tipo);
            jQuery('#btn-save').val("update");
            jQuery('#linkEditorModal').modal('show');
        })

    });

    jQuery('body').on('click', '.show-modal', function () {
        var id = $(this).val();
        $.get("{{ route('users.index') }}" +'/' + id +'/show', function (data) {
        //  $.get("{{ route('users.store') }}" + id, function (data) {
            jQuery('#nif').val(data.nif);
            jQuery('#name').val(data.name);
            jQuery('#username').val(data.username);
            jQuery('#email').val(data.email);
            jQuery('#tlf').val(data.tlf);
            jQuery('#direccion').val(data.direccion);
            jQuery('#password').val(data.password);
            jQuery('#password_confirmation').val(data.password_confirmation);
            jQuery('#tipo').val(data.tipo);
            jQuery('#btn-save').val("update");
            jQuery('#linkShowModal').modal('show');
        })

    });

    // Clicking the save button on the open modal for both CREATE and UPDATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            nif: jQuery('#nif').val(),
            name: jQuery('#name').val(),
            username: jQuery('#username').val(),
            direccion: jQuery('#direccion').val(),
            email: jQuery('#email').val(),
            tlf: jQuery('#tlf').val(),
            password: jQuery('#password').val(),
            password_confirmation: jQuery('#password_confirmation').val(),
            tipo: jQuery('#tipo').val(),
   
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var id = jQuery('#id').val();
        var ajaxurl = "{{ route('users.store') }}";
        if (state == "update") {
            type = "PUT";
            ajaxurl = 'users/' + id;
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var user = '' + data.id + '' + data.nif + '' + data.name + ''+ data.username + '' + data.direccion + '' + data.email +'' +  data.tlf +'' +   data.password + ''+   data.password_confirmation + '' +  data.tipo + '';
                user += 'Edit ';
                user += 'Delete';
                if (state == "add") {
                    jQuery('#users-list').append(user);
                } else {
                    $("#user" + id).replaceWith(user);
                }
                jQuery('#modalFormData').trigger("reset");
                jQuery('#linkEditorModal').modal('hide');
                location.reload();
            },
            error: function (data) {
            var error = JSON.parse(data.responseText);
            var datos = JSON.stringify(data.responseText);
            $('#errorName').text(error.message);
            console.log(error);
            }
        });
    })
});

</script>

@endsection