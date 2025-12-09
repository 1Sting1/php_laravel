<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('form.show') }}">
        <img src="{{ asset('images/cat.png') }}" width="60" height="60" alt="Логотип">
        Веб-приложение на Laravel
    </a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('form.show') }}">Форма</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('feedback.index') }}">Данные</a>
            </li>
        </ul>
    </div>
</nav>
