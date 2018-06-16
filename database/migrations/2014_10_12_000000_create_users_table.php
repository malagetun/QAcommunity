<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar');//头像
            $table->string('confirmation_token');
            $table->smallInteger('is_active')->default(0);//是否激活邮箱
            $table->integer('questions_count')->default(0);//发表问题
            $table->integer('answers_count')->default(0);//回答
            $table->integer('comments_count')->default(0);//评论
            $table->integer('favorites_count')->default(0);//收藏
            $table->integer('likes_count')->default(0);//点赞
            $table->integer('followers_count')->default(0);//关注
            $table->integer('followings_count')->default(0);//被关注
            $table->string('settings')->nullable();//用户配置
            $table->rememberToken();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
