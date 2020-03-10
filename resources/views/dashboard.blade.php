@extends('layouts.app')

@section('content')
<div>
    <h3>My Expenses</h3>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="float:right;margin-top: -40px;">
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </nav>
      <br>
      <div class="col-md-12">
        
          <div class="table table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark"> 
                    <th>Expense Categories</th>
                    <th>Total</th>
                </thead>
                <tbody>
                    @forelse($expenses as $key => $amount)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ number_format($amount,2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align:center">No expenses</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
          </div>
        
      

        <div id="chartdiv" style="width: 100%; height: 400px;"></div>
      </div>
      
</div>

@endsection
@section('scripts')
  <script src="//www.amcharts.com/lib/4/core.js"></script>
  <script src="//www.amcharts.com/lib/4/charts.js"></script>
  <script>
    // Create chart instance
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    
    // Add data
    chart.data = {!! json_encode($chartExpenses) !!};
    
    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
      pieSeries.dataFields.value = "total";
      pieSeries.dataFields.category = "category";
    </script>
@endsection
