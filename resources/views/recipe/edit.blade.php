@extends('components.base')

@section('title', 'Editar receita')

@section('content')
    <h1>Editar receita</h1>

    @if(session('error'))
        <p>{{session('error')}}</p>
    @endif

    @if(session('success'))
        <p>{{session('success')}}</p>
    @endif

    @if(isset(Auth::user()->employee->id))
    <form action="{{route('recipe.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        @METHOD('patch')

        <input type="hidden" name="recipe_id" value="{{$recipe->id}}">

        <div class="form-group">
            <label for="name">Nome da receita</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$recipe->name}}" required>
            </div>

        {{-- mostrar foto da receita como input --}}
        <div class="form-group">
            <label for="image">Foto</label>
            <input class="form-control" type="file" name="image" id="image">
        </div>

        <div class="form-group">
            <label for="portions">Porções</label>
            <input type="number" step="0.1" name="portions" id="portions" class="form-control" value="{{$recipe->portions}}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}"
                        {{$category->id == $recipe->category_id ? 'selected' : ''}}
                        >{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" id="ingredients">
            <label for="ingredients">Ingredientes</label>
            @foreach ($recipe->ingredientRecipes as $pivot)
                <div class="d-flex flex-row">

                    <select class="form-control" name="ingredient_ids[]" required>
                        @foreach ($ingredients as $ingredient)
                            <option value="{{$ingredient->id}}"
                                {{$ingredient->id == $pivot->ingredient_id ? 'selected' : ''}}
                                >{{$ingredient->name}}</option>
                        @endforeach
                    </select>

                    <input type="number" step="0.1" name="quantities[]" class="form-control" value="{{$pivot->quantity}}">

                    <select name="measure_ids[]" class="form-control">
                        @foreach ($measures as $measure)
                            <option value="{{$measure->id}}"
                                {{$measure->id == $pivot->measure_id ? 'selected' : ''}}
                                >{{$measure->name}}</option>
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-danger remove_ingredient">Remover</button>
                </div>
            @endforeach

            <button type="button" id="addIngredient">Adicionar ingrediente</button>

            {{-- Módulo de ingrediente --}}
            <template>
                <div class="d-flex flex-row">

                    <select class="form-control" name="ingredient_ids[]" required>
                        @foreach ($ingredients as $ingredient)
                            <option value="{{$ingredient->id}}" required>{{$ingredient->name}}</option>
                        @endforeach
                    </select>

                    <input type="number" step="0.1" name="quantities[]" class="form-control">

                    <select name="measure_ids[]" class="form-control">
                        @foreach ($measures as $measure)
                            <option value="{{$measure->id}}" required>{{$measure->name}}</option>
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-danger remove_ingredient">Remover</button>
                </div>
            </template>

        </div>

        <input class="btn btn-success" type="submit" value="Editar">
    </form>
    @else
        <h1 class="text-danger">Você não possui perfil de funcionário, portanto não pode editar receitas.</h1>
    @endif

@endsection

@section('style')
<style>
    .recipe-card {
        text-decoration: none;
        transition: all 0.3s;
    }

    .recipe-card::hover {
        transform: scale(1.1);
    }
</style>
@endsection

@section('script')
<script>
    $('#addIngredient').click(function() {
        var template = $('template').html();
        $('#ingredients').append(template);

        $('.remove_ingredient').click(function() {
        $(this).parent().remove();
    });
    });

    $('.remove_ingredient').click(function() {
        $(this).parent().remove();
    });
</script>
@endsection
