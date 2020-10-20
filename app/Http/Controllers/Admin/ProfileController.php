<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//Profile Modelが使えるよになる
use App\Profile;
// 以下を17にて追記
use App\Profilehistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = new Profile;
        $form = $request->all();
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);
        //データベースに保存
        $profile->fill($form);
        $profile->save();  //保存はsaveメソッドを使うだけ
        //リダイレクト
        return redirect('admin/profile/');
    }
    
    public function edit(Request $request)
    {
      // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      if (empty($profile)) {
        abort(404);    
      }
      return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      // News Modelからデータを取得する
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();
      if ($request->remove == 'true') {
            $profile_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $profile_form['image_path'] = basename($path);
        } else {
            $profile_form['image_path'] = $profile->image_path;
        }
      unset($profile_form['_token']);
      // 該当するデータを上書きして保存する
      $profile->fill($profile_form)->save();
      
     // 以下を17で追記
      $history = new Profilehistory;
      $history->profile_id = $profile->id;
      $history->edited_at = Carbon::now();
      $history->save();
      return redirect('admin/profile');
    }
    
    public function delete(Request $request)
    {
      // 該当するNews Modelを取得
      $profile = Profile::find($request->id);
      // 削除する
      $profile->delete();
      return redirect('admin/profile/');
    }  
    
    public function index(Request $request)
    {
      $cond_name = $request->cond_name;
      if ($cond_name != '') {
          // 検索されたら検索結果を取得する  
          $posts = Profile::where('name', $cond_name)->get();
      } else {
          //$cond_title（ユーザーが入力した文字）で一致しない全てのレコードを取得する
          $posts = Profile::all();
      }
      //index.blade.phpのファイルに取得したレコード（$posts）と
      //      ユーザーが入力した文字列（$cond_title）を渡し、ページを開く
      return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
  }

}
