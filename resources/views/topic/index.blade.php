@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">话题相关问题列表</div>
                    <div class="panel-body">
                        @foreach($lists as $list)
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img src="{{$list->avatar}}?imageView2/1/w/70/h/70/format/png/q/75|imageslim" alt="{{$list->name}}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/questions/{{$list->id}}">
                                            {{str_limit($list->title, 50, '...')}}
                                        </a>
                                    </h4>
                                    <p>
                                        <a href="/questions/{{$list->id}}">
                                            <span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--Comment Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M10.241 19.313a.97.97 0 0 0-.77.2 7.908 7.908 0 0 1-3.772 1.482.409.409 0 0 1-.38-.637 5.825 5.825 0 0 0 1.11-2.237.605.605 0 0 0-.227-.59A7.935 7.935 0 0 1 3 11.25C3 6.7 7.03 3 12 3s9 3.7 9 8.25-4.373 9.108-10.759 8.063z" fill-rule="evenodd"></path></svg></span>
                                            {{$list->followers_count}}个赞&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$list->updated_at}}

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
