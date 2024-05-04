@extends('layout')
@section('title','Home')
@section('content')
<h1>Projecto: {{$project->title}}</h1>
<a href="{{route('projects.edit',$project)}}">Editar</a>
<hr>
<h4>Descripción</h4>
<p>{{$project->description}}</p>
<h5>Creado {{$project->created_at->diffForHumans()}}</h5>
@endsection