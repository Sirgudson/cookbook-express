<style>
    main {
        background-color: #FBF7ED;
        height: 95%;
    }
    .box-usuarios {
        padding: 120px 100px;
    }
    .box-usuariosWrapper {
        background-color: #fff;
        border: 1px solid #FF9E0B;
        padding: 30px;
        border-radius: 16px;
    }
    .box-usuariosWrapper table {
        /* margin: 5px; */
        width: 100%;
    }
    .box-usuariosWrapper thead {
        background-color: #FF9E0B;
    }
    .box-usuariosWrapper th {
        padding: 8px;
        color: #FBF7ED;
    }
    .box-usuariosWrapper td {
        padding: 10px;
        border-bottom: 1px solid #FF9E0B;
    }
</style>
@extends('components.base')

@section('title', 'Usuários')

@section('content')
    <section class="box-usuarios">
        <div class="box-usuariosWrapper">
            <h1>Usuários</h1>
            <p>Verificar usuários cadastrados no sistema</p>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Criado em</th>
                        <th>Atualizado em</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>Ativo</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}"  style="text-decoration: none; color: black;"><i class="ri-edit-2-line"></i></a>
                                <a href="{{ route('user.show', $user->id) }}"  style="text-decoration: none; color: black;"><i class="ri-more-line"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <a href="{{ route('user.create') }}">Criar</a> --}}
        </div>
    </section>
@endsection

@section('script')
@endsection

@section('style')
@endsection
