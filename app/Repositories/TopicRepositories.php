<?php

namespace App\Repositories;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Topic;
/**
 * Class TopicRepositories
 *
 * @package \App\Repositories
 */
class TopicRepositories
{
    public function getTopicsForTagging(Request $request){
        return Topic::select(['id','name'])->where('name','like','%'.$request->query('q').'%')->get();
    }
    public function getTopicsForQuestion($id){
//        return DB::table('question_topic')->leftJoin('questions','question_topic.question_id','=','questions.id')->where('question_topic.topic_id',$id)->get();
//        return Question::with (['topics','users'])->where('topic_id',$id)->get();
        return DB::table('questions')
            ->Join('question_topic','question_topic.question_id','=','questions.id')
            ->Join('users','questions.user_id','=','users.id')
            ->where('question_topic.topic_id',$id)
            ->select('questions.id','users.avatar','users.name','title','questions.followers_count','questions.updated_at')
            ->get();
 }
}
