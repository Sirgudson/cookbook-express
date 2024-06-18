@extends('components.base')

@section('title', 'Home')

@section('content')
<section class="box-restaurant">
    <div class="box-restaurantWrapper">
        <div class="box-restarant_title">
            <h1>Restaurantes</h1>

            <div class="box-restaurant_cadastrar">
                <h1>Cadastrar Restaurante</h1>

                <form action="{{route('restaurant.store')}}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Nome do restaurante">
                    <button type="submit">Criar</button>
                </form>
            </div>
        </div>

        @if(session('error'))
            <p>{{session('error')}}</p>
        @endif
        <table>
            <thead>
                <tr>
                    <th>Nome do restaurante</th>
                    <th>Ações</th>
                </tr>
            </thead>
            @foreach ($restaurants as $restaurant)
                <tr>
                    <div class="d-flex flex-row">
                        <td>
                            <h3>{{ $restaurant->name }}</h3>

                        <td>
                            <form action="{{route('restaurant.delete')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$restaurant->id}}">
                                <button type="submit">Deletar</button>
                            </form>
                        </td>
                    </div>
                </tr>
            @endforeach

            <!-- <div>
                <h1>Cadastrar restaurante</h1>

                <form action="{{route('restaurant.store')}}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Nome do restaurante">
                    <button type="submit">Criar</button>
                </form>
            </div> -->
        </table>
    </div>
</section>
@endsection

@section('style')
<style>
    main {
        background-color: #FBF7ED;
        height: 100vh;
    }

    .box-restaurant {
        padding: 120px 100px;
    }

    .box-restarant_title {
        display: flex;
        justify-content: space-between;
    }

    .box-restaurant_cadastrar {
        display: flex;
        flex-direction: column;
    }

    .box-restaurantWrapper {
        background-color: #fff;
        border: 1px solid #FF9E0B;
        padding: 30px;
        border-radius: 16px;
    }

    .box-restaurantWrapper h1 {
        font-size: 28px;
        color: #8E3F1A;
    }

    .box-restaurantWrapper table {
        /* margin: 5px; */
        width: 100%;
    }

    .box-restaurantWrapper thead {
        background-color: #FF9E0B;
    }

    .box-restaurantWrapper th {
        padding: 8px;
        color: #FBF7ED;
    }

    .box-restaurantWrapper td {
        padding: 10px;
        border-bottom: 1px solid #FF9E0B;
    }
</style>
@endsection

@section('script')
<script>
</script>
@endsection
