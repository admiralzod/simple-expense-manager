<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['user_id','expense_category_id','amount','entry_date'];

    public function category(){
        return $this->belongsTo(ExpenseCategory::class,'expense_category_id');
    }
}
