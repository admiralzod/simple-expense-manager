<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategory;
use App\Expense;
use Validator;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expenses.index')
        ->with('expenseCategories', ExpenseCategory::get())
        ->with('expenses', auth()->user()->expenses()->latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validator = Validator::make(request()->all(),[
            'entry_date' => 'required|date_format:Y-m-d',
            'amount' => 'required|numeric|gt:0',
            'expense_category_id' => 'required|in:'.ExpenseCategory::all()->implode('id',','),
        ]);

        if($validator->fails()){
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with('addError', true);
        }

        auth()->user()->expenses()->create(request()->all());

        return redirect('expenses')
        ->with('success', true)
        ->with('message','Success creating a expense');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Expense $expense)
    {
        $validator = Validator::make(request()->all(),[
            'entry_date' => 'required|date_format:Y-m-d',
            'amount' => 'required|numeric|gt:0',
            'expense_category_id' => 'required|in:'.ExpenseCategory::all()->implode('id',','),
        ]);

        if($validator->fails()){
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with('editError', true);
        }

        $expense->update(request()->all());

        return redirect('expenses')
        ->with('success', true)
        ->with('message','Success updating a expense');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect('expenses')
        ->with('success', true)
        ->with('message','Success deleting a expense');
    }
}
