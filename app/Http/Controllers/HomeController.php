<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chartExpenses = [];
        $expenses = auth()->user()->expenses()->with('category')->get()
            ->groupBy('category.name')
            ->map(function($item){
                return $item->sum('amount');
            })->sortByDesc(function($item){
                return $item;
            });
        foreach($expenses as $key => $total){
            $chartExpenses[] = [
                'category' => $key,
                'total' => $total
            ];
        }
        
        
      
        return view('dashboard')
            ->with('expenses', $expenses)
            ->with('chartExpenses', $chartExpenses);
    }
}
