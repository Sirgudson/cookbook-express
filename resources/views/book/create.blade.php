@extends('components.base')

@section('title', 'Cadastrar livro')

@section('content')
    <h1>Cadastrar livro</h1>

    @if(session('error'))
        <p>{{session('error')}}</p>
    @endif

    @if(session('success'))
        <p>{{session('success')}}</p>
    @endif

    @if(isset(Auth::user()->employee->id))
    <form action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="employee_id" value="{{Auth::user()->employee->id}}" required>

        <div class="form-group">
            <label for="title">Título do livro</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="isbn">Código ISBN</label>
            <input type="number" name="isbn" id="isbn" class="form-control" required>
        </div>

        <div class="form-group" id="recipes">
            <label for="recipes">Receitas</label>
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
                </div>
            </template>

        </div>

        <div class="form-group">
            <label for="will_publish">Deseja publicar o livro?</label>
            <input type="checkbox" name="will_publish" id="will_publish">
        </div>

        <input class="btn btn-success" type="submit" value="Cadastrar">
    </form>
    @else
        <h1 class="text-danger">Você não possui perfil de funcionário, portanto não pode cadastrar livros.</h1>
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
    });
</script>
@endsection
