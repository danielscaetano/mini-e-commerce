<x-layout>
    <x-slot:title>
        Login
    </x-slot:title>

    <div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 200px);">
        <div class="card shadow" style="width: 400px;">
            <div class="card-body">

                <h1 class="h4 text-center mb-4">Acesse sua conta</h1>

                <form method="POST" action="{{ route('login.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="mail@example.com"
                            required>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="••••••••"
                            required>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">
                            Lembrar de mim
                        </label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Entrar
                        </button>
                    </div>
                </form>

                <hr>

                <p class="text-center mb-0">
                    Não tem uma conta?
                    <a href="/cadastro">Cadastre-se</a>
                </p>

            </div>
        </div>
    </div>
</x-layout>
