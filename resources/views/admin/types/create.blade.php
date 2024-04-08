
@extends('layouts.app')

@section('title', 'Crea nuova Tipologia')

@section('content')
<section>
    
    <div class="container my-4">
        <a href="{{ route('admin.types.index') }}" class="my-4 btn btn-primary"><i class="fa-solid fa-table me-1">
        </i> Torna alla Lista delle Tipologie
    </a>
    
    
    <h1>Crea Tipologia</h1>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>                    
            @endforeach
        </ul>
    </div>
    @endif

        <form action="{{ route('admin.types.store') }}" class="row g-3" method="POST">
            @csrf

            <div class="col-10">
                <label for="label" class="form-label">ETICHETTA</label>
                <input type="text" name="label" id="label" class="form-control" >
            </div>

            <div class="col-2">
                <label for="color" class="form-label">COLORE</label>
              <input type="color" name="color" id="color" class="form-control"></input>
            </div>

            <div class="col-12">
                <button class="btn btn-success">
                    <i class="fa-solid fa-floppy-disk me-1"></i>
                        Salva Tipologia                
                </button>
            </div>
        </form>

    </div>

</section>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection