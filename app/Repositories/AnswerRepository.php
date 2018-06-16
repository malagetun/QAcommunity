<?php
/**
 * Created by PhpStorm.
 * User: Think
 * Date: 2017/10/31
 * Time: 22:52
 */

namespace App\Repositories;


use App\Answer;

class AnswerRepository
{
    public function create(array $attributes){
        return Answer::create($attributes);
    }
    public function byId($id){
        return Answer::find($id);

    }
    public function getAnswerCommentsById($id){
        $answer=Answer::with('comments','comments.user')->where('id',$id)->first();
        return $answer->comments;
    }
}
