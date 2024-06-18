<style>
    main {
        background-color: #FBF7ED;
        height: 100vh;
    }
    .box-cargos {
        padding: 120px 100px;
    }
    .box-cargosWrapper {
        background-color: #fff;
        border: 1px solid #FF9E0B;
        padding: 30px;
        border-radius: 16px;
    }
    .box-cargosWrapper h1 {
        font-size: 28px;
        color: #8E3F1A;
    }
    .box-cargosWrapper table {
        /* margin: 5px; */
        width: 100%;
    }
    .box-cargosWrapper thead {
        background-color: #FF9E0B;
    }
    .box-cargosWrapper th {
        padding: 8px;
        color: #FBF7ED;
    }
    .box-cargosWrapper td {
        padding: 10px;
        border-bottom: 1px solid #FF9E0B;
    }
    .box-cargos__acoes {
        display: flex;
        gap: 20px;
    }
    /* .form-delet {
        padding: 10px;
        font-size: 20px;
    } */
    .ativo {
        background-color: #7ed27e;
        color: #fff;
        border-radius: 10px;
        text-align: center;
        width: 80%;
    }

    .inativo {
        background-color: red;
        color: #fff;
        border-radius: 10px;
        text-align: center;
        width: 80%;
    }
</style>
@extends('components.base')

@section('title', 'Home')

@section('content')
    <section class="box-cargos">
        <div class="box-cargosWrapper">
            <h1>Cargos</h1>

            @if(session('error'))
                <p>{{session('error')}}</p>
            @endif
            <table>
                <thead>
                    <tr>
                        <th>Cargo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @foreach ($roles as $role)
                    <tbody>
                        <tr>
                            <td>
                                <p>{{ $role->name }}</p>
                            </td>
                            <td>
                                <p class="{{ $role->active ? 'ativo' : 'inativo' }}">{{$role->active ? 'Ativo' : 'Inativo'}}</p>
                            </td>
                            <td class="box-cargos__acoes">
                                @if($role->active)
                                    <form action="{{route('role.deactivate')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$role->id}}">
                                        <button type="submit">Desativar</button>
                                    </form>
                                @else
                                    <form action="{{route('role.activate')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$role->id}}">
                                        <button type="submit">Ativar</button>
                                    </form>
                                @endif

                                <form action="{{route('role.delete')}}" method="POST" class="form-delet">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$role->id}}">
                                    <button type="submit">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>            
                @endforeach
            </table>
        </div>
    </section>
    <!-- <h1>Cargos</h1>

    @if(session('error'))
        <p>{{session('error')}}</p>
    @endif

    @foreach ($roles as $role)
        <div class="d-flex flex-row">
            <h3>{{ $role->name }}</h3>
            <p>Status: {{$role->active ? 'Ativo' : 'Inativo'}}</p>

            @if($role->active)
                <form action="{{route('role.deactivate')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$role->id}}">
                    <button type="submit">Desativar</button>
                </form>
            @else
                <form action="{{route('role.activate')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$role->id}}">
                    <button type="submit">Ativar</button>
                </form>
            @endif

            <form action="{{route('role.delete')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$role->id}}">
                <button type="submit">Deletar</button>
            </form>

        </div>
    @endforeach

    <h1>Criar Cargo</h1>

    <form action="{{route('role.store')}}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nome do cargo">
        <button type="submit">Criar</button>
    </form> -->

@endsection

@section('style')
<style>
</style>
@endsection

@section('script')
<script>
</script>
@endsection
