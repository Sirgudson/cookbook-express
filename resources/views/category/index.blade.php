@extends('components.base')

@section('title', 'Categorias')

@section('content')
    <h1>Categorias</h1>

    @if(session('error'))
        <p>{{session('error')}}</p>
    @endif

    @foreach ($categories as $category)
        <div class="d-flex flex-row">
            <h3>{{ $category->name }}</h3>

            <form action="{{route('category.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$category->id}}">
                <input type="text" name="name" placeholder="Nome da categoria">
                <button type="submit">Atualizar</button>
            </form>

            <form action="{{route('category.delete')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$category->id}}">
                <button type="submit">Deletar</button>
            </form>

        </div>
    @endforeach

    <h1>Cadastrar categoria</h1>

    <form action="{{route('category.store')}}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nome da categoria">
        <button type="submit">Criar</button>
    </form>

@endsection

@section('style')
<style>
</style>
@endsection

@section('script')
<script>
</script>
@endsection
