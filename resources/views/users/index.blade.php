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
    <h3>Users</h3>

    

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="float:right;margin-top: -40px;">
          <li class="breadcrumb-item" aria-current="page">User Management</li>
          <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
      </nav>

    <div class="table table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark"> 
                <th>Name</th>
                <th>Email address</th>
                <th>Role</th>
                <th>Created at</th>
            </thead>
            <tbody>
                @forelse($users as $user)
                @if($user->role_id == 1)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @else
                        <tr onclick="onTdClicked(this)" 
                        data-id="{{ $user->id }}"
                        data-name="{{ $user->name }}"
                        data-email="{{ $user->email }}"
                        data-role-id="{{  $user->role_id }}">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center">No users</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
   <br>
    <button class="btn btn-primary" style="float:right" data-toggle="modal" data-target="#addModal">Add User</button>
    @include('users.create-modal')
    @include('users.edit-modal')
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
            $("#editEmail").val(self.getAttribute('data-email'));
            $("#editRole_id option").each(function(){
                    
                if($(this).val() == self.getAttribute('data-role-id')){
                    $(this).attr('selected', true);
                }
            });

            $("#editForm").attr('action', '/users/'+id+'');
            $("#deleteForm").attr('action', '/users/'+id+'');
        }

        function deleteClicked(){
            $("#editForm").find(":button").attr('disabled',true);
            $("#deleteForm").submit();
        }
    </script>
@endsection
