<div class="modal fade" tabindex="-1" role="dialog" id="addModal"  data-backdrop="static" data-keyboard="false">      
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Add expense</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <form action="{{ url('expenses') }}" method="post" onsubmit="$(this).find(':button').attr('disabled', true);">
            {{ csrf_field() }}   
            {{ method_field('POST') }} 
            <div class="modal-body  ">
                    <div class="form-group row {{ $errors->has('expense_category_id') ? 'has-error' : '' }}">
                        <label for="expense_category_id" class="col-sm-4 col-form-label">Expense Category</label>
                        <div class="col-sm-8">
                        <select class="form-control" name="expense_category_id" id="expense_category_id">
                            @foreach($expenseCategories as $expenseCategory)
                            <option value="{{ $expenseCategory->id }}" {{ old('expense_category_id') == $expenseCategory->id ? 'selected' : '' }}>{{ $expenseCategory->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('expense_category_id'))
                            <span class="help-block">
                                {{ $errors->first('expense_category_id') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('amount') ? 'has-error' : '' }} ">
                        <label for="amount" class="col-sm-4 col-form-label">Amount</label>
                        <div class="col-sm-8">
                            <input type="number" step="any" class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" id="amount" name="amount"  value="{{ old('amount') }}">
                            @if($errors->has('amount'))
                                <span class="help-block">
                                    {{ $errors->first('amount') }}
                                </span>
                            @endif
                        </div>
                      </div>

                      <div class="form-group row {{ $errors->has('entry_date') ? 'has-error' : '' }}">
                        <label for="entry_date" class="col-sm-4 col-form-label">Entry Date</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control {{ $errors->has('entry_date') ? 'is-invalid' : '' }}" id="entry_date" name="entry_date"  value="{{ old('entry_date') }}">
                          @if($errors->has('entry_date'))
                            <span class="help-block">
                                {{ $errors->first('entry_date') }}
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