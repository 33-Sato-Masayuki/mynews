@extends('layouts.admin')

@section('title', 'ニュースの新規作成')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ニュース新規作成</h2>
                {{-- テキスト13にて追記 --}}
                <form action="{{ action('Admin\NewsController@create') }}" method="post" enctype="multipart/form-data">
                     @if (count($errors) > 0) {{--  エラーの個数を返してる  --}}
                        <ul>
                            @foreach($errors->all() as $e) {{--  配列の数だけループし、その中身を$sにだ代入  --}}
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="title">タイトル</label> {{--  for="title"をテキスト14で追記  --}}
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">本文</label> {{--  for="body"をテキスト14で追記  --}}
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">画像</label> {{--  for="title"をテキスト14で追記  --}}
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="こうしん">
                    {{--  テキスト13にてここまで追記  --}}
                </form>
            </div>
        </div>
    </div>
@endsection