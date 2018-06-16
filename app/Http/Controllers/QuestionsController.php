<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Repositories\QuestionRepository;

use Auth;



class QuestionsController extends Controller
{
    protected $questionRepository;
    public function __construct(QuestionRepository $questionRepository){
        $this->middleware('auth')->except(['index','show']);
        $this->questionRepository=$questionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions=$this->questionRepository->getQuestionsFeed();
        return view('questions.index',compact('questions'));
    }
    public function news(){
//        dd($this->questionRepository->getQuestionsNews());
$questions=$this->questionRepository->getQuestionsFeed();
return view('questions.index',compact('questions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }


    public function store(StoreQuestionRequest $request)
    {
        $topics=$this->questionRepository->normalizeTopic($request->get('topics'));

        $data=[
          'title'=>$request->get('title'),
            'body'=>$request->get('body'),
            'user_id'=>Auth::id()
        ];

       $question=$this->questionRepository->create($data);

       $question->topics()->attach($topics);
       return redirect()->route('questions.show',[$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question=$this->questionRepository->byIdWithTopicsAndAnswers($id);
        return view('questions.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question=$this->questionRepository->byId($id);
        if (Auth::user()->owns($question)){
            return view('questions.edit',compact('question'));


        }
        return back();
    }


    public function update(StoreQuestionRequest $request, $id)
    {
        $question=$this->questionRepository->byId($id);
        $topics=$this->questionRepository->normalizeTopic($request->get('topics'));

        $question->update([
            'title'=>$request->get('title'),
            'body'=>$request->get('body')

        ]);
        $question->topics()->sync($topics);
        return redirect()->route('questions.show',[$question->id]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question=$this->questionRepository->byId($id);
        if(Auth::user()->owns($question)){
            $question->delete();
            return redirect('/');
        }
        abort(403,'Forbidden');//return back();
    }

    public function search($q){
        $lists=$this->questionRepository->getSearch($q);
        return view('questions.search',compact('lists'));

    }
}
