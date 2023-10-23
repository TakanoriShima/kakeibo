@extends('layouts.app')
@section('content')
  <div class="flex justify-center items-center"><b>
      <a href="/chart?month={{ $prev_month }}" id="prev" class="border rounded-md shadow-sm p-3 bg-slate-100">前月</a> < <span id="now" class="text-2xl underline">{{ $month }}</span> ><a href="/chart?month={{ $next_month }}" id="next" class="border rounded-md shadow-sm p-3 bg-slate-100">次月</a>
  </div></b>
  <p style="height: 100px;"></p>
  <div style="position: relative; width: 50vw; height: 50vw; margin: 0 auto">
    <canvas id="myPieChart">
  </div>
  <script>
    const ctx = document.getElementById("myPieChart");
    const myPieChart = new Chart(ctx, {
      type: 'pie', // 円グラフを使用
      data: {
        labels: @json($labels),
        datasets: [{
          backgroundColor: [
            "#BB5179",
            "#FAFF67",
            "#58A27C",
            "#3C00FF"
          ],
          data: @json($data)
        }]
      },
      options: {
          }
    });
  </script>
@endsection

   
