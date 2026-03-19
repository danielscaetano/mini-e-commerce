<x-layout>
    <x-slot:title>
        Login    
    </x-slot:title>

    <div class="hero min-h-[calc(100vh-16rem)]">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-3xl font-bold text-center mb-6">Acesse sua conta</h1>

                    <form method="POST" action="{{ route('login.store') }}">
                        @csrf

                        <label class="floating-label mb-6">
                            <input type="email"
                                   name="email"
                                   placeholder="mail@example.com"
                                   value="{{ old('email') }}"
                                   class="input input-bordered @error('email') input-error @enderror"
                                   required>
                            <span>Email</span>
                        </label>
                        @error('email')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <label class="floating-label mb-6">
                            <input type="password"
                                   name="password"
                                   placeholder="••••••••"
                                   class="input input-bordered @error('password') input-error @enderror"
                                   required>
                            <span>Senha</span>
                        </label>
                        @error('password')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <div class="form-control mb-4">
                            <label class="cursor-pointer label justify-start gap-2">
                                <input type="checkbox" name="remember" class="checkbox checkbox-sm">
                                <span class="label-text">Lembrar de mim</span>
                            </label>
                        </div>

                        <div class="form-control mt-4">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                Entrar
                            </button>
                        </div>
                    </form>

                    <div class="divider">OU</div>
                    <p class="text-center text-sm">
                        Não tem uma conta?
                        <a href="/cadastro" class="link link-primary">Cadastre-se</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>