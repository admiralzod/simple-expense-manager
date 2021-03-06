<div class="modal fade" tabindex="-1" role="dialog" id="editModal"  data-backdrop="static" data-keyboard="false">      
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Edit user</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <form id="editForm" action="{{ url('users') }}" method="post" onsubmit="$(this).find(':button').attr('disabled', true);">
            {{ csrf_field() }}   
            {{ method_field('PATCH') }} 
            <div class="modal-body  ">
                <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }} ">
                    <label for="editName" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="editName" name="name"  value="{{ old('name') }}">
                        @if($errors->has('name'))
                            <span class="help-block">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                    </div>
                  </div>
                  <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="editEmail" class="col-sm-4 col-form-label">Email Address</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="editEmail" name="email"  value="{{ old('email') }}">
                      @if($errors->has('email'))
                        <span class="help-block">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                  </div>

                  <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="editPassword" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="editPassword" name="password">
                      @if($errors->has('password'))
                        <span class="help-block">
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                  </div>

                  <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="editPassword_confirmation" class="col-sm-4 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="editPassword_confirmation" name="password_confirmation">
                      @if($errors->has('password'))
                        <span class="help-block">
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                  </div>

                  <div class="form-group row {{ $errors->has('role_id') ? 'has-error' : '' }}">
                    <label for="editRole_id" class="col-sm-4 col-form-label">Role</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="role_id" id="editRole_id">
                          @foreach($roles as $role)
                          <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                          @endforeach
                      </select>
                      @if($errors->has('role_id'))
                        <span class="help-block">
                            {{ $errors->first('role_id') }}
                        </span>
                        @endif
                    </div>
                  </div>
                    
                </div>
            
                <div class="modal-footer">
                    <button type="button" style="float:left" class="btn btn-danger" onclick="deleteClicked()">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
            </form>

            <form id="deleteForm" method="post">
                {{csrf_field() }}
                {{ method_field('DELETE') }}
            </form>
            </div>
        </div>
    </div>
</div>