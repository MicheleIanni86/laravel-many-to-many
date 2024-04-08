@extends('layouts.app')

@section('title', 'Lista Tipologie')

@section('content')
<section>
    <div class="container my-4">

        <a href="{{ route('admin.types.create') }}" class="my-4 btn btn-primary"><i class="fa-solid fa-plus">
            </i> Nuova Tipologia
        </a>

        <h1>Lista Tipologie</h1>

        <table class="table">
            <thead>
                <th>ID</th>
                <th>ETICHETTA</th>
                <th>COLORE</th>
                <th>BADGE</th>
                <th>AZIONI</th>
                <th></th>
                
            </thead>
            <tbody>
                @forelse ($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->label }}</td>
                    <td>{{ $type->color }}</td>
                    <td>{!! $type->getBadge() !!}</td>
                    <td>
                        <a href="{{ route('admin.types.show', $type) }}" class="btn btn-primary">
                            <i class="fa-solid fa-eye fa-sm"></i>
                        </a> 
                  

                        <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-primary">
                            <i class="fa-solid fa-pencil fa-sm"></i>
                        </a> 


                            <a href="{{ route('admin.types.destroy', $type) }}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-type-{{ $type->id }}-modal">
                                <i class="fa-solid fa-trash fa-sm"></i>
                            </a> 
                        </td>
                    
                </tr>
                    
                @empty
                    <tr>
                        <td colspan="100%">
                            <i>Nessun risultato trovato</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</section>
@endsection

@section('modal')
@foreach ($types as $type)
<div class="modal fade" id="delete-type-{{ $type->id }}-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Elimina Tipologia</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Stai per cancellare la Tipologia <b>{!! $type->getBadge() !!}</b>...cancellando questa tipologia, cancellerai tutti i progetti associati!!! <strong>{{ $type->title }}</strong> !
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non Cancellare!</button>

          <form action="{{ route('admin.types.show', $type) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Si Cancella!</button>
           </form>

        </div>
      </div>
    </div>
  </div>
  @endforeach
@endsection  

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection