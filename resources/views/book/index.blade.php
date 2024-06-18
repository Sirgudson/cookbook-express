@extends('components.base')

@section('title', 'Livros')

@section('content')
    <h1>Livros</h1>

    @if(session('error'))
        <p>{{session('error')}}</p>
    @endif

    @if(session('success'))
        <p>{{session('success')}}</p>
    @endif

    <div class="d-flex flex-row w-100 ms-3">
        @foreach ($books as $book)

            <a href="{{route('book.show', $book->id)}}" class="book-card ms-3">

                <div class="card">
                    <div class="card-header"style="background-image: url('{{ asset('storage/recipe_images/'.$book->publications[0]->recipe->photos[0]->name) }}');">
                    </div>

                    <div class="card-body">
                        <h3>{{$book->title}}</h3>

                        @if(!$book->published_at)
                            <span class="badge bg-danger">Não publicado</span>
                        @else
                            <p>Compilado por {{$book->employee->user->name}}</p>
                        @endif

                    </div>
                </div>

            </a>

        @endforeach
    </div>

    @can('manageBooks', Auth::user())
        <a href="{{route('book.create')}}" class="btn btn-primary">Criar novo livro</a>
    @endcan

@endsection

@section('style')
<style>
    .card-header{
        background-size: cover;
        background-position: center;
        height: 100px;
    }
    .book-card {
        text-decoration: none;
        transition: all 0.4s;
        overflow: hidden;
    }

    .book-card:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.11);
        transform: scale(1.03);
    }
</style>
@endsection

@section('script')
<script>
</script>
@endsection
