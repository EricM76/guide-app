@extends('layout')
@section('title','Home')
@section('content')
<h1>Editar proyecto: {{$project->title}}</h1>
<hr>
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
<form action="{{route('projects.update',$project)}}" method="POST">
    @csrf
    @method('PUT')
<input type="text" id="title" name="title" placeholder="Titulo del proyecto" value="{{old('title',$project->title)}}"><br><br>
<textarea name="description" id="description" cols="30" rows="10" placeholder="Descripción del proyecto">{{old('description',$project->description)}}</textarea>
<button type="submit">Actualizar</button>
</form>
@endsection