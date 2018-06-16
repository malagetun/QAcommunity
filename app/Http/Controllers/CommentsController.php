<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use App\Repositories\CommentRepositories;
use App\Repositories\QuestionRepository;
use Auth;

use Illuminate\Http\Request;

/**
 * Class CommentsController
 *
 * @package App\Http\Controllers
 */
class CommentsController extends Controller
{
    /**
     * @var \App\Repositories\AnswerRepository
     */
    protected $answer;
    /**
     * @var \App\Repositories\QuestionRepository
     */
    protected $question;
    /**
     * @var \App\Repositories\CommentRepositories
     */
    protected $comment;

    /**
     * CommentsController constructor.
     *
     * @param $answer
     * @param $question
     * @param $comment
     */
    public function __construct(AnswerRepository $answer,QuestionRepository $question,CommentRepositories $comment)
    {
        $this->answer = $answer;
        $this->question = $question;
        $this->comment = $comment;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function answer($id)
    {
        return $this->answer->getAnswerCommentsById($id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public  function question($id){
     return $this->question->getQuestionCommentsById($id);

    }

    /**
     * @return mixed
     */
    public  function store(){
        $model=$this->getModelNameFromType(request('type'));
//        Auth::user()->increment('comments_count');
        Auth::guard('api')->user()->increment('comments_count');
        return $this->comment->create([
            'commentable_id'=>request('model'),
            'commentable_type'=>$model,
            'user_id'=>user('api')->id,
            'body'=>request('body')
        ]);
    }

    /**
     * @param $type
     *
     * @return string
     */
    private function getModelNameFromType($type){
        return $type==='question'?'App\Question':'App\Answer';
    }
}
