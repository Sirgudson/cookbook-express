

@extends('components.base')

@section('title', 'Home')

@section('content')
    <section class="box-categorias">
        <div class="box-categoriasWrapper">
            <h1>Categorias</h1>

            @if(session('error'))
                <p>{{session('error')}}</p>
            @endif
            <table>
                <thead>

                    <form action="{{route('category.store')}}" method="POST">
        @csrf
        <label for="category">Criar Categoria: </label>
        <input type="text" name="name" id="category" list="categories" placeholder="Adicione a nova categoria">
        <form action="{{route('measure.store')}}" method="POST" class="formulario">


        @csrf
        <button type="submit" class="salvar">Criar</button>
</form>

            </table>
        </div>
    </section>
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
    main {
        background-color: #FBF7ED;
        height: 100vh;
    }
    .box-categorias {
        padding: 120px 100px;
    }
    .box-categoriasWrapper {
        background-color: #fff;
        border: 1px solid #FF9E0B;
        padding: 30px;
        border-radius: 16px;
    }
    .box-categoriasWrapper h1 {
        font-size: 28px;
        color: #8E3F1A;
    }
    .box-categoriasWrapper table {
        width: 100%;
    }
    .box-categoriasWrapper thead {
        background-color: #FF9E0B;
    }
    .box-categoriasWrapper th {
        padding: 8px;
        color: #FBF7ED;
    }
    .box-categoriasWrapper td {
        padding: 10px;
        border-bottom: 1px solid #FF9E0B;
    }
</style>
@endsection

@section('script')
<script>
</script>
@endsection
