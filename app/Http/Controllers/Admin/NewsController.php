<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//　↓　下記を追記するとNews Modelが扱えるようになる　テキスト14で追記
use App\News;
// 以下を17にて追記
use App\History;
use Carbon\Carbon;

class NewsController extends Controller
{
     public function add()
    {
        return view('admin.news.create');
    }
    //Request $requestrequestをテキスト13にて追記
    public function create(Request $request)
    {
    // Varidationを行う
        $this->validate($request, News::$rules);
        $news = new News;
        $form = $request->all();
    // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $news->image_path = basename($path);
        } else {
            $news->image_path = null;
        }
    // フォームから送信されてきた_tokenを削除する 　　　　　　unset($form['〇〇']);
        unset($form['_token']);
    // フォームから送信されてきたimageを削除する
        unset($form['image']);
    // データベースに保存する
        $news->fill($form);
        $news->save();  //保存はsaveメソッドを使うだけ
        //リダイレクト
        return redirect('admin/news/');
    }

    // 以下をPHP/Laravel 15で追記
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する  
          //newsテーブルの中のtitleカラムで$cond_title（ユーザーが入力した文字）に一致するレコードを全て取得する
          $posts = News::where('title', $cond_title)->get();
      } else {
          //$cond_title（ユーザーが入力した文字）で一致しない全てのレコードを取得する
          $posts = News::all();
      }
      //index.blade.phpのファイルに取得したレコード（$posts）と
      //      ユーザーが入力した文字列（$cond_title）を渡し、ページを開く
      return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  // 以下をカリキュラム16にて追記

  public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $news = News::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
      return view('admin.news.edit', ['news_form' => $news]);
  }
  
  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, News::$rules);
      // News Modelからデータを取得する
      $news = News::find($request->id);
      // 送信されてきたフォームデータを格納する
      $news_form = $request->all();
      if ($request->remove == 'true') {
            $news_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $news_form['image_path'] = basename($path);
        } else {
            $news_form['image_path'] = $news->image_path;
        }
      unset($news_form['_token']);
      unset($news_form['image']);
      unset($news_form['remove']);
      // 該当するデータを上書きして保存する
      $news->fill($news_form)->save();
      
      // 以下を１７にて追記
        $history = new History;
        $history->news_id = $news->id;
        $history->edited_at = Carbon::now();//時刻を扱う Carbonという日付操作ライブラリ
        $history->save();
      return redirect('admin/news');
  }
  
    // 以下をカリキュラム16で追記　　データの場合はdelete()メソッドを使用
 public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $news = News::find($request->id);
      // 削除する
      $news->delete();
      return redirect('admin/news/');
  }  
}