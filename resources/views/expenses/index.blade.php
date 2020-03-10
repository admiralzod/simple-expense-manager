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
    <h3>Expenses</h3>

    

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="float:right;margin-top: -40px;">
          <li class="breadcrumb-item" aria-current="page">Expense Management</li>
          <li class="breadcrumb-item active" aria-current="page">Expenses</li>
        </ol>
      </nav>

    <div class="table table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark"> 
                <th>Expense Category</th>
                <th>Amount</th>
                <th>Entry Date</th>
                <th>Created at</th>
            </thead>
            <tbody>
                @forelse($expenses as $expense)
                    <tr onclick="onTdClicked(this)" 
                    data-id="{{ $expense->id }}"
                    data-expense-category-id="{{ $expense->expense_category_id }}"
                    data-amount="{{ $expense->amount }}"
                    data-entry-date="{{  $expense->entry_date }}">
                        <td>{{ $expense->category->name }}</td>
                        <td>{{ $expense->amount }}</td>
                        <td>{{ $expense->entry_date }}</td>
                        <td>{{ $expense->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center">No expenses</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
   <br>
    <button class="btn btn-primary" style="float:right" data-toggle="modal" data-target="#addModal">Add Expense</button>
    @include('expenses.create-modal')
    @include('expenses.edit-modal')
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

            $("#editAmount").val(self.getAttribute('data-amount'));
            $("#editEntry_date").val(self.getAttribute('data-entry-date'));
            $("#editExpense_category_id option").each(function(){
                    
                if($(this).val() == self.getAttribute('data-expense-category-id')){
                    $(this).attr('selected', true);
                }
            });

            $("#editForm").attr('action', '/expenses/'+id+'');
            $("#deleteForm").attr('action', '/expenses/'+id+'');
        }

        function deleteClicked(){
            $("#editForm").find(":button").attr('disabled',true);
            $("#deleteForm").submit();
        }
    </script>
@endsection
