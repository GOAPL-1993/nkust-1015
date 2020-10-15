@extends('layouts.base')

@section('title')
LIST CONTENT
@endsection

@section('content')
<h2>LIST CONTENT</h2>
<hr>
@auth
<form method=post action='/addlist/'>
    @csrf
    <!-- 防攻擊用的語法 -->
    LIST NAME：<input type=text size=40 name=title>
    <input type=submit value=ADD>
</form>
@endif
<table class='table table-hover table-dark'>
    <thead>
        <tr>
            <th>ID</th>
            <th>name</th>
            @auth
            <th>manage</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($titles as $title)
        <tr>
            <td>{{ $title->id }}</td>
            <td><a href="/showlist/{{ $title->name }}/">$title</a></td>
            @auth
            <td><a href="/delete/{{$title->id}}/">delete</a></td>
            @endif
        </tr>
        @empty
        <tr>
            <td>No users</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection