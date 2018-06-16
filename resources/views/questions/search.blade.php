@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">搜索结果</div>
                    <div class="panel-body">
                        @foreach($lists as $list)
                            <div class="media">
                                <div class="media-left">
                                    <a href="../questions/{{$list->id}}">
                                            <img src="{{ $list->user->avatar }}" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="../questions/{{$list->id}}">
                                            {{$list->title}}
                                        </a>
                                    </h4>
                                    <p>
                                        <a href="../questions/{{$list->id}}">
                                            {{str_limit($list->body, 150, '....')}}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
