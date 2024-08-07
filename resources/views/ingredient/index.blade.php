@extends('components.base')

@section('title', 'Ingredientes')

@section('content')
    <h1 class="titulo__header">Ingredientes</h1>

    @if(session('error'))
        <p class="ingrediente__error">{{session('error')}}</p>
    @endif

    @if(session('success'))
        <p class="ingrediente__success">{{session('success')}}</p>
    @endif

    <div class="d-grid" style="grid-template-columns: 1fr 1fr;">
        @foreach ($ingredients as $ingredient)
            <div class="">

                <form action="{{route('ingredient.update')}}" method="POST" class="formulario atualizar">
                    @csrf
                    <input type="hidden" name="id" value="{{$ingredient->id}}">
                    <input type="text" name="name" id="name" class="form-control" value="{{$ingredient->name}}">
                    <input type="text" name="description" id="description" class="form-control" value="{{$ingredient->description}}"
                        placeholder="{{$ingredient->description ?? 'Descrição do ingrediente'}}">
                    <input type="submit" value="Salvar" class="salvar">
                </form>

                <form action="{{route('ingredient.delete')}}" method="POST" class="formulario atualizar">
                    @csrf
                    <input type="hidden" name="id" value="{{$ingredient->id}}">
                    <button type="submit" class="salvar" style="width: 80%;">Deletar</button>
                </form>

            </div>
        @endforeach
    </div>

    <h1 class="titulo__header">Cadastrar ingrediente</h1>

    <form action="{{route('ingredient.store')}}" method="POST" class="formulario">
        @csrf
        <input type="text" name="name" placeholder="Nome do ingrediente">
        <input type="text" name="description" placeholder="Descrição do ingrediente">
        <button type="submit" class="salvar">Criar</button>
    </form>

@endsection

@section('style')
<style>    
    .salvar{
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 3px 30px;
        display: block;
    }
    .titulo__header{
        color: #FF9E0B;
        font-size: 36px;
        font-weight: 500;
        letter-spacing: normal;
        line-height: 120%;
        padding: 20px 0px 20px 50px;
    }

    .ingrediente__error {
        color: #b94520;
        padding: 0 50px;
    }

    .ingrediente__success {
        color: #7db920;
        padding: 0 50px;
    }
    .formulario{
        background-color: #fff;
        border-radius: 4px;
        color: rgba(0,0,0,.6);
        font-size: 16px;
        font-weight: 400;
        height: 48px;
        line-height: 48px;
        padding: 20px 0px 0px 50px;
        transition: border .2s ease-in-out;
        width: 100%;
    }
    .formulario input{
        display: block;
        color: rgba(0, 0, 0, .4);
        font-weight: 400;
        padding-bottom: 5px;
        border-radius: 4px;
        width: 80%;
        margin-bottom: 15px;
        border: 1px solid rgba(234, 195, 157, .5);
    }
    .atualizar{
        display: table;
    }
    ::placeholder {
        color: rgba(0, 0, 0, .4);
        font-weight: 400;
        padding-bottom: 5px;
}

</style>
@endsection

@section('script')
<script>
</script>
@endsection
