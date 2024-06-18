<style>
        main {
        background-color: #FBF7ED;
        height: 95%;
    }
        .perfil__header{
        color: #FF9E0B;
        font-size: 36px;
        font-weight: 500;
        letter-spacing: normal;
        line-height: 120%;
        padding: 20px 0px 20px 50px;
    }
    .perfil__title {
        font-size: 24px;
        margin-bottom: 26px;
        color: #8E3F1A;
        margin-left: 5%;
    }
    .salvar{
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 8px 16px;
    }
    .profile-form {
        width: 100%;
        padding: 20px;
        border-radius: 5px;
        background-color: #FFFFFF;
    }

    .profile-form .form-group {
        margin-bottom: 15px;
    }
    .form-group label{
        color: rgba(0,0,0,.4);
        font-weight: 400;
        padding-bottom: 5px;
    }

    .profile-form label {
        display: block;
        margin-bottom: 5px;
    }

    .profile-form input[type="email"],
    .profile-form input[type="password"] {
        background-color: #fff;
        border: 1px solid rgba(234, 195, 157, .5);
        border-radius: 4px;
        color: rgba(0,0,0,.6);
        font-size: 16px;
        font-weight: 400;
        height: 48px;
        line-height: 48px;
        padding: 0 10px;
        transition: border .2s ease-in-out;
        width: 100%;
    }

    .profile-form button.salvar {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 8px 16px;
    }

    .profile-form button.salvar:hover {
        background-color: #FFFFFF;
    }
    .perfil__container{
        background-color: #fff;
        border: 1px solid #FBF7ED;
        border-radius: 12px;
        display: flex;
        justify-content: space-between;
        margin: 0 auto;
        padding: 30px 20px;
        width: 100%;  
    }
    .nome__col{
        border-right: 1px solid rgba(234, 195, 157, .5);
        margin-right: 20px;
        min-width: 212px;
        width: 20vw;
    }
</style>
@extends('components.base')

@section('title', 'Perfil')

@section('content')
    <h1 class="perfil__header">Editar Perfil</h1>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <div class="perfil__container">
        <aside class="nome__col">
            <h2 class="perfil__title">{{$user->name}}</h2>
        </aside>

        <form method="POST" action="{{ route('profile.update', $user->id) }}" class="profile-form">
        @csrf

        <input type="hidden" name="id" value="{{$user->id}}">

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label for="oldPassword">Senha Antiga</label>
            <input type="password" name="oldPassword" id="oldPassword">
        </div>

        <div class="form-group">
            <label for="password">Nova Senha</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Repita a nova senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <button class="salvar" type="submit">Salvar</button>
    </div>
</form>


    @if($user->role->name == 'chef')

        <h1>Experiencia</h1>
        @foreach ($user->employee->experiences as $experience)

            <p>{{$experience->restaurant->name}}</p>
            <p>{{App\Helpers\GlobalHelper::convertDate($experience->start_date)}} -
                {{$experience->end_date ? App\Helpers\GlobalHelper::convertDate($experience->end_date) : 'Atual'}}
            </p>
            <form method="POST" action="{{ route('employee.removeExperience') }}">
                @csrf

                <input type="hidden" name="id" value="{{$experience->id}}">
                <input type="hidden" name="restaurant" value="{{$experience->restaurant->id}}">

                <button type="submit">Remover</button>
            </form

        @endforeach

        <h1>Adicionar experiencia</h1>

        <form method="POST" action="{{ route('employee.addExperience') }}">
            @csrf

            <input type="hidden" name="employee_id" value="{{$user->employee->id}}">

            <label for="restaurant">Restaurante</label>
            <select name="restaurant_id" id="restaurant_id">
            @foreach ($restaurants as $restaurant)
                <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
            @endforeach
            </select>

            <label for="start_date">Data de admissão</label>
            <input type="date" name="start_date" id="start_date">

            <label for="end_date">Data de demissão</label>
            <input type="date" name="end_date" id="end_date">

            <label for="current_job">Emprego atual</label>
            <input type="checkbox" name="current_job" id="current_job">


            <button type="submit">Adicionar</button>
    @endif


@endsection

@section('style')
<style>

</style>
@endsection

@section('script')
<script>

    $(document).ready(function() {
        $('#current_job').change(function() {
            if(this.checked) {
                $('#end_date').prop('disabled', true);
                $('#end_date').prop('value', null);

            } else {
                $('#end_date').prop('disabled', false);
            }
        });
    });

</script>
@endsection


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
