<div class="modal fade" tabindex="-1" role="dialog" id="addModal"  data-backdrop="static" data-keyboard="false">      
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Add role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <form action="{{ url('roles') }}" method="post" onsubmit="$(this).find(':button').attr('disabled', true);">
            {{ csrf_field() }}   
            {{ method_field('POST') }} 
            <div class="modal-body  ">
            <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }} ">
                        <label for="name" class="col-sm-4 col-form-label">Display Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name"  value="{{ old('name') }}">
                            @if($errors->has('name'))
                                <span class="help-block">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="form-group row {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label for="description" class="col-sm-4 col-form-label">Description</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description"  value="{{ old('description') }}">
                          @if($errors->has('description'))
                            <span class="help-block">
                                {{ $errors->first('description') }}
                            </span>
                            @endif
                        </div>
                      </div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            </div>
        </div>
    </div>
</div>