@extends('layouts.app')

@section('content')

    <div class="text-2xl flex justify-center m-5"><b>編集</b></div>

    <section class="p-section p-section__records-input flex justify-center">
    
        <form method="POST" action="{{ route('records.update', $record->id) }}" class="p-form p-form--input-record">
            @csrf
            @method('PUT')

                <input type="hidden" name="input_time" id="input_time" value="<?php echo date("Y/m/d-H:i:s"); ?>">
                <div class="p-form__flex-input flex justify-center">
                    <span>日付</span>
                    <label for="date"><input type="date" name="date" id="date" value="{{ $record->date }}" ></label>
                </div>
                         
                <div class="flex justify-center my-8">
                    <span class="label-text mr-10">金額</span>
                    <input type="text" name="amount" value="{{ $record->amount }}" maxlength="7" >
                </div>
            
                <div class="flex justify-center my-8">
                    <label for="category" class="label">
                        <span class="label-text">カテゴリー</span>
                    </label>
                    <select name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @if(old('category_id') == $category->id) selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex justify-center my-8">
                    <span class="label-text mr-10">メモ</span>
                    <input type="text" name="memo" value="{{ $record->memo }}" maxlength="20" >
                </div>

            <button class="btn btn-outline bg-orange-300 flex items-center" type="submit">更新</a>
        </form>
    </div>

@endsection