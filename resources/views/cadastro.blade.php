<x-layout>
    <x-slot:title>
        Cadastre-Se
    </x-slot:title>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 200px);">
        <div class="card shadow-sm w-100" style="max-width: 420px;">
            <div class="card-body p-4">

                <h1 class="text-center mb-4 fw-bold">Crie sua conta</h1>

                <form method="POST" action="{{ route('cadastro.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Jorgw"
                            required>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="mail@example.com"
                            required>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            required>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirme a senha</label>
                        <input type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="••••••••"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-2">
                        Cadastrar-se
                    </button>
                </form>

                <hr class="my-4">

                <p class="text-center mb-0">
                    Já tem uma conta?
                    <a href="{{ route('login.index') }}" class="text-decoration-none">
                        Logar-se
                    </a>
                </p>

            </div>
        </div>
    </div>
</x-layout>