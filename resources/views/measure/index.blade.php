@extends('components.base')

@section('title', 'Medidas')

@section('content')
    <h1 class="titulo__header">Medidas</h1>

    @if(session('error'))
        <p>{{session('error')}}</p>
    @endif

    @foreach ($measures as $measure)
        <div class="d-flex flex-row listagem">
            <h3>{{ $measure->name }}</h3>

            <form action="{{route('measure.delete')}}" method="POST" class="formulario">
                @csrf
                <input type="hidden" name="id" value="{{$measure->id}}">
                <button type="submit" class="salvar">Deletar</button>
            </form>

        </div>
    @endforeach

    <h1 class="titulo__header">Cadastrar medida</h1>

    <form action="{{route('measure.store')}}" method="POST" class="formulario">
        @csrf
        <input type="text" name="name" placeholder="Nome da medida">
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
    .formulario{
        background-color: #fff;
        border-radius: 4px;
        color: rgba(0,0,0,.6);
        font-size: 16px;
        font-weight: 400;
        height: 48px;
        line-height: 48px;
        padding: 20px 0px 20px 50px;
        transition: border .2s ease-in-out;
        width: 100%;
    }
    .formulario input{
        display: block;
        color: rgba(0, 0, 0, .4);
        font-weight: 400;
        padding-bottom: 5px;
        border-radius: 4px;
        width: 50%;
        margin-bottom: 15px;
        border: 1px solid rgba(234, 195, 157, .5);
    }
    ::placeholder {
        color: rgba(0, 0, 0, .4);
        font-weight: 400;
        padding-bottom: 5px;
    }
    .listagem{
        padding-left: 50px;
        padding-bottom: 30px;
        align-items: baseline;
    }
    .listagem h3{
        color: rgba(0, 0, 0, .4);
        font-weight: 400;
        padding-bottom: 5px;
        font-size: 17px;
    }
</style>
@endsection

@section('script')
<script>
</script>
@endsection
