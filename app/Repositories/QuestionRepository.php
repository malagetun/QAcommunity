<?php
/**
 * Created by PhpStorm.
 * User: Think
 * Date: 2017/10/30
 * Time: 1:43
 */

namespace App\Repositories;

use App\Question;
use App\Topic;

/**
 * Class QuestionRepository
 * @package App\Repositories
 */
class QuestionRepository
{
    /**
     * @param $id
     * @return mixed
     */
    public function byIdWithTopicsAndAnswers($id){
        return Question::where('id',$id)->with(['topics','answers'])->first();
    }
    public function create(array $attributes){
        return Question::create($attributes);
    }
    public function normalizeTopic(array $topics){
        $ids = Topic::pluck('id');

        $ids = collect($topics)->map(function ($topic) use ($ids) {
            if (is_numeric($topic) && $ids->contains($topic)) {
                return (int) $topic;
            }

            return Topic::firstOrCreate(['name' => $topic])->id;
        })->toArray();

        Topic::whereIn('id', $ids)->increment('questions_count');
        return $ids;
    }
    public function byId($id){
        return Question::find($id);

    }

    public function getQuestionCommentsById($id){
        $question=Question::with('comments','comments.user')->where('id',$id)->first();
        return $question->comments;
    }
    public function getQuestionsFeed(){
        return Question::published()->latest('updated_at')->with('user')->get();

    }
    public function getSearch($q){
//        return Question::where('title', 'like', '%'.$q.'%')->orwhere('body', 'like', '%'.$q.'%')->with('user')->select(['title','body','id','created_at','followers_count','body'])->get();
        return Question::where('title', 'like', '%'.$q.'%')->orwhere('body', 'like', '%'.$q.'%')->with('user')->get();
    }
}
