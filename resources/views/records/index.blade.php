@extends('layouts.app')

@section('content')

    <div class="text-lg text-center">
        <a href="/records?month={{ $prev_month }}" id="prev">前月</a> < <span id="now">{{ $month }}</span> ><a href="/records?month={{ $next_month }}" id="next">次月</a>
    </div>
    
   <!--合計表示-->
   <div class="card-body">
        <div class='bg-gray p-6 roundded shadow'>
            <div class=text-x2 mb-6>
                <h2>今月の合計</h2>
                <p class='text-2xl'>￥{{ number_format($amount_income - $amount_outcome) }}</p>
            </div>    
        </div>
    </div>
    
    <div class="card-body">
        <div class='bg-white p-6 roundded shadow'>
            <div class=text-x1>
                <h2>今月の収入</h2>
                <p class='text-2xl'>￥{{ number_format($amount_income) }}</p>
            </div>
        </div>
    </div>
    
    <div class="card-body">    
        <div class='bg-white p-6 roundded shadow'>
            <div class=text-x1>
                <h2>今月の支出</h2>
                <p class='text-2xl'>￥{{ number_format($amount_outcome) }}</p>
            </div>
        </div>
    </div>
    
    <!--カレンダー表示-->

   <div id='calendar'></div>

    <!--入力済みのデータ表示-->
    <div class="card-body">
    @if (isset($records))
        <table class="table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>日付</th>
                    <th>カテゴリー</th>
                    <th>メモ</th>
                    <th>金額</th>
                </tr>
            </thead>
            <tbody>
        @foreach($records as $record)
        <tr>
            <td><a class="link link-hover text-info" href="{{ route('records.show', $record->id) }}">{{ $record->date }}</a></td>
            <td>{{$record->category->name}}</td>
            <td>{{$record->memo}}</td>
            <td>￥{{number_format($record->amount)}}</td>
            <td> <a class="btn btn-outline" href="{{ route('records.edit', $record->id) }}">編集</a></td>
            <td> <form method="POST" action="{{ route('records.destroy', $record->id) }}" >
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-error btn-outline" 
            onclick="return confirm('id = {{ $record->id }} 削除します。よろしいですか？')">削除</button>
        </form></td>
        </tr>
        @endforeach
    
            </tbody>
        </table>
    @endif

        <td class="button-td">
    </div>
            
    {{-- ページネーションのリンク --}}
    {{ $records->links() }}

@endsection