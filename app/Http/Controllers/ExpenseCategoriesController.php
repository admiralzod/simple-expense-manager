<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategory;
use Validator;

class ExpenseCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expense-categories.index')
        ->with('expenseCategories', ExpenseCategory::latest()->get());
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
            'name' => 'required|unique:expense_categories|max:255',
            'description' => 'required|max:255'
        ]);

        if($validator->fails()){
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with('addError', true);
        }

        ExpenseCategory::create(request()->all());

        return redirect('expense-categories')
        ->with('success', true)
        ->with('message','Success creating a expense category');
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
    public function update(ExpenseCategory $expenseCategory)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required|max:255|unique:expense_categories,name,'.$expenseCategory->id,
            'description' => 'required|max:255'
        ]);

        if($validator->fails()){
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->with('editError', true);
        }

        $expenseCategory->update(request()->all());

        return redirect('expense-categories')
        ->with('success', true)
        ->with('message','Success updating a expense category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();
        return redirect('expense-categories')
        ->with('success', true)
        ->with('message','Success deleting a expense category');
    }
}
