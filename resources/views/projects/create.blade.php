@extends('layout')
@section('title','Home')
@section('content')
<h1>Crear nuevo proyecto</h1>
<hr>
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
<form action="{{route('projects.store')}}" method="POST">
    @csrf
<input type="text" id="title" name="title" placeholder="Titulo del proyecto" value="{{old('title')}}"><br><br>
<textarea name="description" id="description" cols="30" rows="10" placeholder="Descripción del proyecto">{{old('description')}}</textarea>
<button type="submit">Enviar</button>
</form>
@endsection