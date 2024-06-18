@extends('components.base')

@section('title', 'Detalhes da receita')

@section('content')
    <h1>Detalhes da receita</h1>

    <h1>{{$recipe->name}}
        @if(!$recipe->published)
            <span class="badge bg-success">inédita</span>
        @endif
    </h1>

    <img src="{{ asset('storage/recipe_images/'.$recipe->photos[0]->name) }}" alt="Imagem da receita">
    <p>Criada por {{$recipe->employee->user->name}}</p>

    <h2>Ingredientes</h2>
    <ul>
        @foreach ($recipe->ingredientRecipes as $pivot)
            <li>{{$pivot->ingredient->name}}: {{$pivot->quantity}}{{$pivot->measure->name}}</li>
        @endforeach
    </ul>

    @if($recipe->published )
        <h2>Publicada nos livros:</h2>
        @foreach($recipe->publications as $publication)
            <a href="{{route('book.show', $publication->book_id)}}">{{$publication->book->title}}</a>
        @endforeach
    @elseif($recipe->employee->id == Auth::user()->employee->id)
        <a class="btn btn-primary" href="{{route('recipe.edit', $recipe->id)}}" class="btn btn-primary">Editar receita</a>
        <a class="btn btn-danger" href="{{route('recipe.delete', $recipe->id)}}" class="btn btn-primary">Apagar receita</a>
    @endif



@endsection

@section('style')
<style>
</style>
@endsection

@section('script')
<script>
</script>
@endsection
