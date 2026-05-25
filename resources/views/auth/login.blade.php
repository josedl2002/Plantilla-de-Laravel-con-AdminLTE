<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Inicia sesión para comenzar</p>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="fw-bold">¡Error!</div>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @session('status')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $value }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="Usuario" value="{{ old('name') }}" required autofocus autocomplete="username">
                <div class="input-group-text"><span class="bi bi-person"></span></div>
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Contraseña" required autocomplete="current-password">
                <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Recordarme</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                </div>
            </div>
        </form>

        @if (Route::has('password.request'))
            <p class="mb-0 mt-3">
                <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
            </p>
        @endif
    </div>
</div>
