<style>
    header {
        border-bottom: 0.8px solid #FF9E0B;
        box-shadow: 0 4px 8px rgb(227 124 31 / 10%);
    }
    .header {
        background-color: #FBF7ED;
        color: #fff;
        display: flex;
        padding: 10px;
        justify-content: space-between;
        align-items: center;
    }
    .search-container {
        position: relative;
        display: flex;
        align-items: center;
        width: 200px;
        gap: 20px;
    }
    .search-input {
        width: 120px;
        padding: 0px 10px 0px 40px;
        border: 1px solid #FF9E0B;
        border-radius: 30px;
        background-color: #FBF7ED;
    }
    .search-input:focus {
        border-color: #FF9E0B;
        box-shadow: 0 0 5px rgb(227 124 31 / 10%);
        outline: none;
        font-size: 0.8rem;
    }
    .search-icon {
        position: absolute;
        left: 10px;
        font-size: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #FF9E0B;
    }
    .search-icon--menu {
        font-size: 20px;
        color: #FBF7ED;
        background-color: #FF9E0B;
        padding: 10px;
        border-radius: 20px;
    }
    #menuToggle {
        display: block;
        position: relative;
        /* top: 50px;
        left: 50px; */
        z-index: 1;
    }
    #menuToggle a {
        text-decoration: none;
        color: #FBF7ED;
        transition: color 0.3s ease;
    }
    #menuToggle a:hover {
        color: #8E3F1A;
    }
    #menuToggle input {
        display: block;
        width: 40px;
        height: 32px;
        position: absolute;
        top: -7px;
        left: -5px;
        cursor: pointer;
        opacity: 0;
        z-index: 2;
    }
    #menuToggle span {
        display: block;
        width: 33px;
        height: 4px;
        margin-bottom: 5px;
        position: relative;
        background: #FF9E0B;
        border-radius: 3px;
        z-index: 1;
        transform-origin: 4px 0px;
        transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0),background 0.5s cubic-bezier(0.77,0.2,0.05,1.0), opacity 0.55s ease;
    }
    #menuToggle span:first-child {
        transform-origin: 0% 0%;
    }
    #menuToggle span:nth-last-child(2) {
        transform-origin: 0% 100%;
    }
    #menuToggle input:checked ~ span {
        opacity: 1;
        transform: rotate(45deg) translate(-2px, -1px);
        background: #FBF7ED;
    }
    #menuToggle input:checked ~ span:nth-last-child(3) {
        opacity: 0;
        transform: rotate(0deg) scale(0.2, 0.2);
    }
    #menuToggle input:checked ~ span:nth-last-child(2) {
        transform: rotate(-45deg) translate(0, -1px);
    }
    #menu {
        position: absolute;
        width: 300px;
        margin: -50px 0 0 -40px;
        padding: 50px;
        padding-top: 125px;
        background: #FF9E0B;
        list-style-type: none;
        -webkit-font-smoothing: antialiased;
        transform-origin: 0% 0%;
        transform: translate(-100%, 0);
        transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0);
        height: 100vh;
        min-height: 100%;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 100vh;
    }
    #menu li {
        padding: 10px 0;
        font-size: 22px;
    }
    #menuToggle input:checked ~ ul {
        transform: none;
    }
    .custom-button {
        /* Remover estilos padrões */
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        border: none;
        background: none;
        padding: 0;
        margin: 0;
        outline: none;
        color: #FBF7ED;
        padding: 10px 8px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .custom-button:hover {
        background-color: #0056b3;
    }

</style>
<header class="header">
    <nav role="navigation">
        <div id="menuToggle">
            <input type="checkbox" />

            <span></span>
            <span></span>
            <span></span>

            <ul id="menu">
                <div>
                    <a href="{{route('book.index')}}"><li>Livros</li></a>
                    <a href="{{route('recipe.index')}}"><li>Receitas</li></a>

                    @can('manageCategories', Auth::user())
                        <a href="{{ route('category.index') }}"><li>Categorias</li></a>
                    @endcan

                    @can('manageMeasures', Auth::user())
                        <a href="{{ route('measure.index') }}"><li>Medidas</li></a>
                    @endcan

                    @can('manageIngredients', Auth::user())
                        <a href="{{ route('ingredient.index') }}"><li>Ingredientes</li></a>
                    @endcan

                    @can('manageRestaurants', Auth::user())
                        <a href="{{ route('restaurant.index') }}"><li>Restaurantes</li></a>
                    @endcan

                    @can('viewUsers', Auth::user())
                        <a href="{{ route('user.index') }}"><li>Usuários</li></a>
                    @endcan

                    @can('viewRoles', Auth::user())
                        <a href="{{ route('role.index') }}"><li>Cargos</li></a>
                    @endcan
                </div>
                <div>
                <li>
                    {{-- logout button --}}
                    <form method="POST" action="{{ route('logout') }}" style="display: flex; align-items: center;">
                        @csrf
                        <i class="ri-logout-box-line"></i><button type="submit" class="custom-button">Sair</button>
                    </form>
                </li>
                </div>
            </ul>

        </div>
    </nav>
    <div>
        <img src="{{ asset('logo-header.png') }}" alt="Logo" width="150" style="margin-left: 180px;">
    </div>
    <div class="search-container">
        <i class="ri-search-line search-icon"></i>
        <input type="text" class="search-input">
        <div>
            <a href="{{ route('profile.show', Auth::user()->id) }}" style="text-decoration: none;"><i class="ri-user-line search-icon--menu"></i></a>
        </div>
    </div>
</header>
