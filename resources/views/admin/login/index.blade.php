<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="/admins/login" id="login-form">
        @csrf

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            {{-- <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button> --}}
        </div>

        <button type="submit">Login</button>
    </form>
    <div id="error-messages"></div>

    {{-- <script>
        document.getElementById('login-form').onsubmit = function(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            fetch('/api/users/login', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': form._token.value
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.data?.remember_token) {
                        localStorage.setItem('Authorization', data.remember_token);
                        window.location.href = '/dashboard/admin'; // Arahkan ke dashboard
                    } else {
                        console.log(data.errors)
                        document.getElementById('error-messages').innerText = data.errors;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        };
    </script> --}}
</x-guest-layout>
