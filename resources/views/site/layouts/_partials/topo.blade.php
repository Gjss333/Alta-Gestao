<div class="topo">

    <div class="logo">
        <a href="{{ route('site.index') }}">
            <img src="{{ asset('img/logo.png') }}">
        </a>
    </div>

    <div class="menu">
        <ul>
            <li><a href="{{ route('site.index') }}">Principal</a></li>
            <li><a href="{{ route('site.sobrenos') }}">Sobre Nós</a></li>
            <li><a href="{{ route('site.contato') }}">Contato</a></li>
            <li><a id="teste" href="{{ route('site.login') }}">Entrar</a></li>
        </ul>
    </div>
</div>