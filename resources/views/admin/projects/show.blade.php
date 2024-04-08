
@extends('layouts.app')

@section('title', 'Crea nuovo Project')

@section('content')
<section>
    
    <div class="container my-4">

        <a href="{{ route('admin.projects.index') }}" class="my-4 btn btn-primary"><i class="fa-solid fa-table me-1">
            </i> Torna alla Lista
        </a>


        <h3>Dettaglio Project: <strong class="fs-2">{{ $project->title }}</strong></h3>

        <div class="card mt-4 p-4">

            <h3 class="">Titolo:</h3>
            <p><strong>{{ $project['title'] }}</strong></p>
            <br>
            <h3>Tipo:</h3>
            <p><strong class="fs-3">{!! $project->type->getBadge() !!}</strong></p>
            <br>
            <h3>Contenuto:</h3>
            <p>{{ $project['content'] }}</p>
        </div>
            

    </div>

</section>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection