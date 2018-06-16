<?php

namespace App\Http\Controllers;

use App\Repositories\TopicRepositories;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    protected $topic;

    /**
     * TopicsController constructor.
     *
     * @param $topic
     */
    public function __construct(TopicRepositories $topic)
    {
        $this->topic = $topic;
    }

    public function index(Request $request){
        return $this->topic->getTopicsForTagging($request);
    }
    public function show($id){
        $lists=$this->topic->getTopicsForQuestion($id);
        return view ('topic.index',compact ('lists'));
    }
}
