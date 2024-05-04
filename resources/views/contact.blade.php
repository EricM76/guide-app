@extends('layout')
@section('title','Contacto')
@section('content')
<h1>{{__('Contact')}}</h1>
<hr>
<main>
    <section>
          
        <form action="{{route('messages.store')}}" method="POST">
            @csrf
            <div>
                <input name="name" type="text" placeholder="Nombre" value="{{old('name')}}"><br>
                {!!$errors->first('name','<small>:message</small>')!!}
            </div>
            <div>
                <input name="email" type="email" placeholder="Email" value="{{old('email')}}"><br>
                {!!$errors->first('email','<small>:message</small>')!!}

            </div>
            <div>
                <input name="subject" type="text" placeholder="Asunto" value="{{old('subject')}}"><br>
                {!!$errors->first('subject','<small>:message</small>')!!}

            </div>
            <div>
                <textarea name="content" id="content" placeholder="Mensaje" cols="30" rows="10">{{old('content')}}</textarea><br>
                {!!$errors->first('content','<small>:message</small>')!!}

            </div>
            <div>
                <button type="submit">Enviar</button>
            </div>
        </form>
    </section>
</main>
@endsection