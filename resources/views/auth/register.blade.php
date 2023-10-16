@extends('layouts.app')

@section('content')

    <div class="prose mx-auto text-center">
        <h2>Sign up</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('register') }}" class="w-4/5">
            @csrf

            <div class="form-control my-4">
                <label for="name" class="label">
                    <span class="label-text">名前</span>
                <input type="text" name="name" class="input input-bordered ">
                </label>
            </div>

            <div class="form-control my-4">
                <label for="email" class="label">
                    <span class="label-text">メール</span>
                <input type="email" name="email" class="input input-bordered">
                </label>
            </div>

            <div class="form-control my-4">
                <label for="password" class="label">
                    <span class="label-text">パスワード</span>
                <input type="password" name="password" class="input input-bordered">
                </label>
            </div>

            <div class="form-control my-4">
                <label for="password_confirmation" class="label">
                    <span class="label-text">パスワード（確認用）</span>
                <input type="password" name="password_confirmation" class="input input-bordered">
                </label>
            </div>

            <div align="center">
            <button type="submit" class="btn btn-primary">登録</button>
        </form>
    </div>
@endsection