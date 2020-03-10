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
    <h3>Update password</h3>

    

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="float:right;margin-top: -40px;">
          <li class="breadcrumb-item" aria-current="page">User Management</li>
          <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
      </nav>
<br>
    <form action="{{ url('profile') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('POST')}}
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label for="password">Password</label>
            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password">
            @if($errors->has('password'))
                            <span class="help-block">
                                {{ $errors->first('password') }}
                            </span>
                            @endif
          </div>

          <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection
@section('scripts')


@endsection
