@extends('layouts.admin')  {{--ボタンやコメント欄の作成をしている--}}
@section('title', '登録済みニュースの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ニュース一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\NewsController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\NewsController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value={{ $cond_title }}>
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="admin-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="30%">本文</th>
                                <th width="10%">作成日</th>
                                <th width="10%">更新日</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $news)
                            {{--@foreach を使って取得したデータのひとつひとつを処理し、各データの idと名前、メールアドレスを表示しています--}}
                                <tr>
                                    <th>{{ $news->id }}</th>
                                    <td>{{ \Str::limit($news->title, 100) }}</td> 
                                     {{-- \Str::limit($news->title, 100)は、最大文字数１００文字（半角）、もしタイトルが全て全角なら最大50文字まで表示する --}}
                                    
                                    <td>{{ \Str::limit($news->body, 250) }}</td>
                                    <th>{{ $news->created_at }}</th>
                                    <th>{{ $news->updated_at }}</th>
                                    {{--\Str::limit()は、文字列を指定した数値で切り詰めるというメソッド--}}
                                    {{--注意してほしいのは切り詰める文字の数は半角で認識するようになり、全角の文字は2文字として認識される--}}
                                    {{-- 例） --}}
                                    {{-- \Str::limit(“2018/12/13”,7) --}}
                                    {{-- #結果は、「2018/12」        --}}
                                    {{-- \Str::limit(“2018年12月13日”,7) --}}
                                    {{-- #結果は、「2018年1」        --}}
                                    
                                    <td>
                                    <div>
                                        <a href="{{ action('Admin\NewsController@edit', ['id' => $news->id]) }}">編集</a>
                                    </div>
                                    <div>
                                        <a href="{{ action('Admin\NewsController@delete', ['id' => $news->id]) }}">削除</a>
                                    </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection