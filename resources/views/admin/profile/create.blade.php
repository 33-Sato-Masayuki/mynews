@extends('layouts.profile')    {{--ボタンや記入欄を作っている--}}

@section('title', 'プロフィール作成画面用')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>profile作成</h2>
                {{--  Admin\ProfileController の create Actionに指定  --}}
                <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">
                   @if (count($errors) > 0)
                       <ul>
                            @foreach($errors->all() as $e)    {{--  配列の数だけループし、その中身を$sにだ代入  --}}
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    {{-- 名前入力欄  --}}
                    <div class="form-group row">
                        <label class="col-md-2">名前</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>  
                    {{--  性別入力欄　ラジオボタン、マイグレーションのカラム記入方法がわからず諦め  --}}
                    <div class="form-group row">
                        <label class="col-md-2">性別</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="gender" value="{{ old('gender') }}"> 
                        </div>
                    </div>
                    {{--  趣味入力欄  --}}
                    <div class="form-group row">
                        <label class="col-md-2">趣味</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ old('hobby') }}">
                        </div>
                    </div>
                    {{--  自己紹介欄  --}}
                    <div class="form-group row">
                        <label class="col-md-2">自己紹介</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="20">{{ old('introduction') }}</textarea>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection