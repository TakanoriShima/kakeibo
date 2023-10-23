<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Record;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RecordsController extends Controller
{
    // getでrecords/にアクセスされた場合の「一覧表示処理」
    public function index(Request $request)
    {
        $month = $request->month;
        
        if($month == null){
            $month =  Carbon::now()->format('Y-m');
            $prev_month = Carbon::now()->firstOfMonth()->subMonth(1)->format('Y-m');
            $next_month = Carbon::now()->firstOfMonth()->addMonth(1)->format('Y-m');
            $start_date = Carbon::now()->startOfMonth()->toDateString();
            $end_date = Carbon::now()->endOfMonth()->toDateString();
        }else{
            $start_date = $month . '-01';
            $end_date = (new Carbon($start_date))->endOfMonth()->toDateString();
            $prev_month = (new Carbon($start_date))->subMonth(1)->format('Y-m');
            $next_month = (new Carbon($start_date))->firstOfMonth()->addMonth(1)->format('Y-m');
        }

        
        // 入力一覧を取得
        $records = Record::whereHas('Category', function($query){
            $query->where('user_id', \Auth::id());
        })->where('date', '<=',  $end_date)->where('date', '>=', $start_date)->orderBy('date')->paginate(10);                                                                                                                           

        $amount_income = 0;
        $amount_outcome = 0;
        
        foreach($records as $record){
            $category = $record->category;

            if($category->name == '収入'){
                $amount_income += $record->amount;
            }else{                  
                $amount_outcome +=  $record->amount;
            }
                                                                                                                                                                                                
        }                                                                                           

        
        // 一覧ビューでそれを表示
        return view('records.index', [
            'month' => $month,
            'prev_month' => $prev_month,
            'next_month' => $next_month,
            'records' => $records,
            'amount_income' => $amount_income,
            'amount_outcome' => $amount_outcome,
        ]);                              
    }


    // getでrecords/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        // dd('create');
         $record = new Record;
         $categories = Category::where('user_id', \Auth::id())->get();

        // メッセージ作成ビューを表示
        return view('records.create', [
            'record' => $record,
            'categories' => $categories,
        ]);
    }
    
    /**
     * 新規登録処理
     *
     * @param  Request  $request
     */
    public function store(Request $request)
    {
        // dd($request);
        /*dd($request);*/
        // バリデーション
        $request->validate([
            'category_id'=> 'required|integer',
            'date'=> 'required|date',
            'amount'=> 'required|max:7',
            'memo'=> 'required|max:20'
        ]);

        // 登録処理
        $record = new Record;
       
        $record->date = $request->date;
        $record->category_id = $request->category_id;
        $record->amount = $request->amount;
        $record->memo = $request->memo;
        $record->save();

        return redirect('/records');
    }
    
      // getでrecords/（任意のid）にアクセスされた場合の「取得表示処理」
    public function show($id)
    {
      // idの値で検索して取得
        $record = Record::findOrFail($id);

        // 詳細ビューでそれを表示
        return view('records.show', [
            'record' => $record,
        ]);

    }

    // getでmessages/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $record = Record::findOrFail($id);
        $categories = Category::all();

        // メッセージ編集ビューでそれを表示
        return view('records.edit', [
            'record' => $record,
            'categories' => $categories,
        ]);
    }

    // putまたはpatchでrecords/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'category_id'=> 'required|integer',
            'input_time'=> 'required|date',
            'amount'=> 'required|max:7',
            'memo'=> 'required|max:20'
        ]);
        
        // idの値でメッセージを検索して取得
        $record = Record::findOrFail($id);
        
        // 更新
        $record->date = $request->input('date');
        $record->category_id = $request->input('category_id');
        $record->amount = $request->input('amount');
        $record->memo = $request->input('memo');
        $record->save();
        
        return redirect('/records/' . $id);

    }

    // deleteでrecords/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        // idの値でメッセージを検索して取得
        $record = Record::findOrFail($id);

        // メッセージを削除
        $record->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
    public function scheduleGet(){
        // $date = date('Y-m-d');
        $start_date = Carbon::now()->startOfMonth()->toDateString();
        $end_date = Carbon::now()->endOfMonth()->toDateString();
       
        $params = ["user_id" => \Auth::id(), 'category_name' => '収入'];
        $records = DB::select('SELECT records.id AS id, CONCAT(categories.name, CONCAT(records.amount)) AS title, records.amount AS description, records.date AS start, records.date AS end FROM records JOIN categories ON records.category_id = categories.id WHERE  categories.user_id = :user_id AND categories.name != :category_name', $params);
        // dd($records);
        $list = array('records' => $records);
        // 明示的に指定しない場合は、text/html型と判断される
        header("Content-type: application/json; charset=UTF-8");
        //JSONデータを出力
        echo json_encode($list);
        exit;
    }
    
    public function chartGet(Request $request) { 
        
        $month = $request->month;
        
        if($month == null){
            $month =  Carbon::now()->format('Y-m');
            $prev_month = Carbon::now()->firstOfMonth()->subMonth(1)->format('Y-m');
            $next_month = Carbon::now()->firstOfMonth()->addMonth(1)->format('Y-m');
            $start_date = Carbon::now()->startOfMonth()->toDateString();
            $end_date = Carbon::now()->endOfMonth()->toDateString();
        }else{
            $start_date = $month . '-01';
            $end_date = (new Carbon($start_date))->endOfMonth()->toDateString();
            $prev_month = (new Carbon($start_date))->subMonth(1)->format('Y-m');
            $next_month = (new Carbon($start_date))->firstOfMonth()->addMonth(1)->format('Y-m');
        }
        
       
        $params = ["user_id" => \Auth::id(), 'category_name' => '収入', 'start_date' => $start_date, 'end_date' => $end_date];
        $records = DB::select('select categories.name as label, SUM(records.amount) as data from records join categories on records.category_id=categories.id where categories.user_id=:user_id AND records.date >= :start_date AND records.date <= :end_date AND categories.name != :category_name GROUP BY categories.id', $params);
        
        $labels = [];
        $data = [];

        foreach($records as $record){
            $labels[] = $record->label;
            $data[] = $record->data;
        }
        
        return view('chartjs.index', compact('month', 'prev_month', 'next_month', 'labels', 'data'));

    }

    
}