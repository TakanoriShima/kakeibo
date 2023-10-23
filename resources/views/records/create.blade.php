
@extends('layouts.app')
@section('content')

  
  <div class="text-2xl text-center m-5"><b>新規作成</b></div>
    
  <section class="p-section p-section__records-input flex justify-center">
    <form method="POST" action="{{ route('records.store') }}">
      @csrf
        
        <input type="hidden" name="date" id="date" value="<?php echo date("Y/m/d"); ?>">
        <div class="p-form__flex-input mr-10">日付
          <label for="date"><input type="date" name="date" id="date" value="<?php echo date("Y-m-d"); ?>" required></label>
        </div>

        <div class="form-control my-8 flex items-center justify-center">
          <label for="amount" class="label">
            <span class="label-text mr-10">金額</span>
            <input type="text" name="amount" class="input input-bordered">
          </label>
        </div>
        
        <div class="form-control my-8 text-center">
          <label for="category" class="label">
            <span class="label-text">カテゴリー</span>
              <select name="category_id">
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
              </select>
          </label>
        </div>
            
        <div class="form-control my-8 flex items-center">
            <label for="memo" class="label">
              <span class="label-text mr-10">メモ</span>
              <input type="text" name="memo" class="input input-bordered">
            </label>
        </div>

        <button class="btn btn-outline bg-orange-300 flex items-center" type="submit">登録</a>
    </form>
  </section>
  
@endsection