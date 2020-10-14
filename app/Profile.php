<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = array('id');
        public static $rules = array(
            'name' => 'required',
            'gender' => 'required',
            'hobby' => 'required',
            'introduction' => 'required',
    );
    //課題１７で追記　Profileモデルに関連付け
    public function histories()
    {
      return $this->hasMany('App\Profilehistory');

    }
}