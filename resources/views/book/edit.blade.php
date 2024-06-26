@extends('components.base')

@section('title', 'Editar livro')

@section('content')
    <h1>Editar livro</h1>

    @if(session('error'))
        <p>{{session('error')}}</p>
    @endif

    @if(session('success'))
        <p>{{session('success')}}</p>
    @endif

    @if(isset(Auth::user()->employee->id))
    <form action="{{route('book.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <input type="hidden" name="book_id" value="{{$book->id}}" required>

        <div class="form-group">
            <label for="title">Título do livro</label>
            <input type="text" name="title" id="title" class="form-control" value="{{$book->title}}" required>
        </div>

        <div class="form-group">
            <label for="isbn">Código ISBN</label>
            <input type="number" name="isbn" id="isbn" class="form-control" value="{{$book->isbn}}" required>
        </div>

        <div class="form-group" id="recipes">
            <label for="recipes">Receitas</label>

            @foreach ($book->publications as $publication)
                <div class="d-flex flex-row">

                    <select class="form-control" name="recipe_ids[]" required>
                        @foreach ($recipes as $recipe)
                            <option value="{{$recipe->id}}" {{$recipe->id == $publication->recipe_id ? 'selected' : ''}} required>{{$recipe->name}}</option>
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-danger remove_recipe">Remover</button>
                </div>
            @endforeach

            <button type="button" id="addRecipe">Adicionar receita</button>

            {{-- Módulo de receita --}}
            <template>
                <hr>
                <div class="d-flex flex-row">

                    <select class="form-control" name="recipe_ids[]" required>
                        @foreach ($recipes as $recipe)
                            <option value="{{$recipe->id}}" required>{{$recipe->name}}</option>
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-danger remove_recipe">Remover</button>

                </div>
            </template>

        </div>

        <div class="form-group">
            <label for="will_publish">Deseja publicar o livro?</label>
            <input type="checkbox" name="will_publish" id="will_publish">
        </div>

        <input class="btn btn-success" type="submit" value="Editar">
    </form>
    @else
        <h1 class="text-danger">Você não possui perfil de funcionário, portanto não pode editar livros.</h1>
    @endif

@endsection

@section('style')
<style>
    .book-card {
        text-decoration: none;
        transition: all 0.3s;
    }

    .book-card::hover {
        transform: scale(1.1);
    }
</style>
@endsection

@section('script')
<script>
    $('#addRecipe').click(function() {
        var template = $('template').html();
        $('#recipes').append(template);

        $('.remove_recipe').click(function() {
            $(this).parent().remove();
        });
    });

    $('.remove_recipe').click(function() {
        $(this).parent().remove();
    });
</script>
@endsection
