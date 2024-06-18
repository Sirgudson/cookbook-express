@extends('components.base')

@section('title', 'Detalhes do livro')

@section('content')
    <h1>Detalhes do livro</h1>

    <h1>{{$book->name}}
        @if(!$book->published_at)
            <span class="badge bg-danger">Não publicado</span>
        @endif
    </h1>

    <p>Publicado por {{$book->employee->user->name}}</p>

    <h2>Receitas</h2>
    <ul>
        @foreach ($book->publications as $publication)
            <li>
                <a href="{{route('recipe.show', $publication->recipe_id)}}">
                    <div class="d-flex flex-column recipeLink">
                        {{$publication->recipe->name}}
                        <img src="{{ asset('storage/recipe_images/'.$publication->recipe->photos[0]->name) }}" alt="Imagem da receita">
                    </div>
                </a>
            </li>
        @endforeach
    </ul>

    @if($book->published_at)
        <h2>Publicado em:</h2>
        <p>{{ \Carbon\Carbon::parse($book->published_at)->format('d/m/Y') }}</p>
    @elseif($book->employee->id == Auth::user()->employee->id)
        <a href="{{route('book.publish', $book->id)}}" class="btn btn-success">Publicar</a>
        <a href="{{route('book.edit', $book->id)}}" class="btn btn-primary">Editar</a>
        <a href="{{route('book.delete', $book->id)}}" class="btn btn-danger">Excluir</a>
    @endif


@endsection

@section('style')
<style>
    .recipeLink {
        text-decoration: none;
        color: black;
    }

    .recipeLink img {
        width: 100px;
        height: 100px;
    }
</style>
@endsection

@section('script')
<script>
</script>
@endsection
