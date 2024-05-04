@extends('layout')
@section('title', 'Portfolio')
@section('content')
    <main>
        <h1>Portfolio</h1>
        <hr>
        <section>
            <a href="{{route('projects.create')}}">Nuevo proyecto</a>
            <h4>Todos los proyectos</h4>

            <ul>
                @forelse ($projects as $project)
                    <li>
                        <p><a href="{{route('projects.show',$project)}}">{{ $project->title }}</a> </p>
                        <small>{{ $project->description }}</small>
                    </li>
                @empty
                    <li>No hay proyectos</li>
                @endforelse
            </ul>

        </section>
        <section>
            <h4>Todos los proyectos (ordenados por fecha)</h4>
            <ul>
                @forelse ($newest as $project)
                    <li>
                        <p>{{ $project->title }}</p>
                        <small>{{ $project->description }}</small><br>
                        <small><b>{{$project->created_at->diffForHumans()}}</b></small>
                    </li>
                @empty
                    <li>No hay proyectos</li>
                @endforelse
            </ul>

        </section>
        <section>
            <h4>Projectos paginados</h4>
            <ul>
                @forelse ($paginates as $project)
                    <li>
                        <p>{{ $project->title }}</p>
                        <small>{{ $project->description }}</small><br>
                    </li>
                @empty
                    <li>No hay proyectos</li>
                @endforelse
            </ul>
            {{$paginates->links()}}
        </section>
    </main>

@endsection
