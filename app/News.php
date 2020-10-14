<?php  #  バリデーション　不備をあらかじめ防ぐために検証する仕組み

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = array('id');
    //バリデーションでデータが異常であることを見つけたときには、データを保存せずに入力フォームへ戻すようにしている　テキスト14で追記
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
        
    // 以下を１７にて追記
    // app/HistoryをNewsモデルに関連付けを行う
    public function histories()
    {
        return $this->hasMany('App\History');//hasMany(〇〇) 　テーブルに関連付いているhistoriesテーブルを全て取得するというメソッ

    }
}
