@extends('layouts.app')

@section('content')
<div>
    @if(session('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      
        <strong>Success!</strong>


        {{ session('message') }}
    </div>

    @endif
    <h3>Roles</h3>

    

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="float:right;margin-top: -40px;">
          <li class="breadcrumb-item" aria-current="page">User Management</li>
          <li class="breadcrumb-item active" aria-current="page">Roles</li>
        </ol>
      </nav>

    <div class="table table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark"> 
                <th>Display Name</th>
                <th>Description</th>
                <th>Created at</th>
            </thead>
            <tbody>
                @forelse($roles as $role)
                @if($role->id == 1)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>{{ $role->created_at->format('Y-m-d') }}</td>
                    </tr>
                @else
                    <tr onclick="onTdClicked(this)" data-id="{{ $role->id }}"
                        data-name="{{ $role->name }}"
                        data-description="{{ $role->description }}">
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->created_at->format('Y-m-d') }}</td>
                        </tr>
                @endif
                   
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center">No roles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
   <br>
    <button class="btn btn-primary" style="float:right" data-toggle="modal" data-target="#addModal">Add Role</button>
    @include('roles.create-modal')
    @include('roles.edit-modal')
</div>
@endsection
@section('scripts')
    @if(session('addError'))
        <script>
            window.onload = function () {
                $("#addModal").modal('show');
            }
            
        </script>
    @endif
    <script>
        function onTdClicked(self){
            $("#editModal").modal('show');
            const id = self.getAttribute('data-id');
            $("#editName").val(self.getAttribute('data-name'));
            $("#editDescription").val(self.getAttribute('data-description'));
            $("#editForm").attr('action', '/roles/'+id+'');
            $("#deleteForm").attr('action', '/roles/'+id+'');
        }

        function deleteClicked(){
            $("#editForm").find(":button").attr('disabled',true);
            $("#deleteForm").submit();
        }
    </script>
@endsection
