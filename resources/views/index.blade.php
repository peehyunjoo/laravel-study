@extends('layouts.app')

@section('content');
  <div class="container">
    <h1>포럼 글 목록</h1>
    <hr/>

    <ul>
      @forelse ($articles as $article)
        <li>{{ $article->title }}</li>
      @empty
        글이 없습니다.
      @endforelse
    </ul>
    <div class="text-center">
      {!! $articles->render() !!}
    </div>
    <div class="text-right">
      <a class="btn btn-danger" href="/articles/create">글쓰기</a>
    </div>
  </div>
@stop
