<?php  #　Migration（マグレーションファイル）

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) { //下記のカラムを持つｎｅｗｓというテーブルを作成
            $table->bigIncrements('id');
            $table->string('title'); // ニュースのタイトルを保存するカラム
            $table->string('body');
            $table->string('image_path')->nullable();// ニュースの本文を保存するカラム
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //関数downには、マイグレーションの取り消しを行う為のコード
    {
        Schema::dropIfExists('news'); //関数downには、マイグレーションの取り消しを行う為のコード
    }
}      #  マグレーションを実行するコマンド　【　php artisan migrate　】
# php artisan migrate:rollback  で直前に実行されたマイグレーションファイルのdown関数を実行し、テーブルが作成される前の状態に戻りました