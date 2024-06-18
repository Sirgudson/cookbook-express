@extends('components.base')

@section('title', 'Receitas')

@section('content')
    <h1>Receitas</h1>

    @if(session('error'))
        <p>{{session('error')}}</p>
    @endif

    @if(session('success'))
        <p>{{session('success')}}</p>
    @endif

    <div class="d-flex flex-row w-100 ms-3">
        @foreach ($recipes as $recipe)

            <a href="{{route('recipe.show', $recipe->id)}}" class="recipe-card ms-3">

                <div class="card">

                    <div class="card-header"style="background-image: url('{{ asset('storage/recipe_images/'.$recipe->photos[0]->name) }}');">
                    </div>

                    <div class="card-body">
                        <h3>{{$recipe->name}}</h3>
                        <p>Criada por {{$recipe->employee->user->name}}</p>
                        <p>Status:
                            <span class="badge
                                {{$recipe->published ? 'text-bg-warning' : 'text-bg-success'}}">
                                {{$recipe->published ? 'Publicada' : 'Inédita'}}
                            </span>
                        </p>

                    </div>
                </div>

            </a>

        @endforeach
    </div>

    @can('manageRecipes', Auth::user())
        <a href="{{route('recipe.create')}}" class="btn btn-primary">Criar nova receita</a>
    @endcan

@endsection

@section('style')
<style>
    .card-header{
        background-size: cover;
        background-position: center;
        height: 100px;
    }
    .recipe-card {
        text-decoration: none;
        transition: all 0.4s;
        overflow: hidden;
    }

    .recipe-card:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.11);
        transform: scale(1.03);
    }
</style>
@endsection

@section('script')
<script>
</script>
@endsection
