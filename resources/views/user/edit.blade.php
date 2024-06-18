@extends('components.base')

@section('title', 'Editar Usuário')

@section('content')
<h1 class="editar_usuario__header">Editar Usuário</h1>
<form action="{{ route('user.update') }}" method="post" class="usuario__container">
    @csrf
    @method('PATCH')
    <input type="hidden" name="userId" value="{{ $user->id }}">

    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}">

        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}">

        <label for="role_id">Cargo</label>
        <select name="role_id" id="role_id">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>


    <h1 class="editar_usuario__header">Dados de funcionário</h1>
    @if(!$user->employee()->exists())
        <p class="text-danger">O usuário não possui perfil de funcionário!</p>
    @endif
    @method('PATCH')
    <div class="form-group">
        <label for="rg">RG</label>
        <input type="number" name="rg" id="rg" value="{{ $user->employee->rg ?? '' }}">

        <label for="admission_date">Data de admissão</label>
        <input type="date" name="admission_date" id="admission_date"
            value="{{ $user->employee->admission_date ?? '' }}">

        <label for="demission_date">Data de demissão</label>
        <input type="date" name="demission_date" id="demission_date"
            value="{{ $user->employee->demission_date ?? '' }}">

        <label for="salary">Salário</label>
        <input type="number" name="salary" id="salary" value="{{ $user->employee->salary ?? '' }}">

        <label for="fantasy_name">Nome fantasia</label>
        <input type="text" name="fantasy_name" id="fantasy_name" value="{{ $user->employee->fantasy_name ?? '' }}">
    </div>

    <div class="form-buttons">
        <button class="salvar" type="submit">Salvar</button>
        <a href="{{ route('user.index') }}" class="voltar">Voltar</a>
    </div>
</form>
@endsection

@section('script')
<script>
    console.log('Hello World');
</script>
@endsection

@section('style')
<style>
    main {
        background-color: #FBF7ED;
        height: 95%;
    }

    .editar_usuario__header {
        color: #FF9E0B;
        font-size: 36px;
        font-weight: 500;
        letter-spacing: normal;
        line-height: 120%;
        padding: 20px 0px 20px 50px;
    }

    .salvar,
    .voltar {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 8px 16px;
    }

    .voltar {
        padding: 10px 16px;
    }

    .usuario__container {
        background-color: #FFFFFF;
        padding: 20px;
        margin-bottom: 20px;
        /* Adicionado para espaçar do título seguinte */
    }

    .form-group label {
        color: rgba(0, 0, 0, .4);
        font-weight: 400;
        padding-bottom: 5px;
        display: block;
        margin-left: 10%;
    }

    .form-group input,
    .form-group select {
        background-color: #fff;
        border: 1px solid rgba(234, 195, 157, .5);
        border-radius: 4px;
        color: rgba(0, 0, 0, .6);
        font-size: 16px;
        font-weight: 400;
        height: 48px;
        line-height: 48px;
        padding: 0 10px;
        transition: border .2s ease-in-out;
        width: 50%;
        margin-left: 10%;
        margin-bottom: 30px;
    }

    .form-buttons {
        display: flex;
        justify-content: space-between;
        margin: 20px 10%;
    }

    .form-buttons button,
    .form-buttons a {
        width: 48%;
        text-align: center;
    }
</style>
@endsection