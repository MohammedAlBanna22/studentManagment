<!DOCTYPE html>
<html lang="en" x-data="{ dark: localStorage.theme === 'dark' }" :class="{ 'dark': dark }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SchoolMS</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine (for toggle) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
</head>

<body class="bg-gray-100 dark:bg-[#0a0a0f] min-h-screen flex items-center justify-center transition">

    <!-- Toggle Button -->
    <button
        @click="dark = !dark; localStorage.theme = dark ? 'dark' : 'light'"
        class="absolute top-5 right-5 px-4 py-2 text-sm rounded-lg bg-indigo-600 text-white shadow">
        Light/Dark Mood

    </button>

    <!-- Card -->
    <div class="w-full max-w-md p-8 rounded-2xl shadow-xl
                bg-white dark:bg-[#111118] border border-gray-200 dark:border-gray-800">

        <!-- Logo / Title -->
        <h2 class="text-2xl font-bold text-center mb-6
                   text-gray-800 dark:text-white">
            Welcome Back 👋
        </h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus
                    class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-[#1a1a24] dark:text-white focus:ring-indigo-500"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-[#1a1a24] dark:text-white focus:ring-indigo-500"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <input type="checkbox" name="remember"
                        class="mr-2 rounded border-gray-300 dark:border-gray-600">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-indigo-600 hover:underline">
                        Forgot?
                    </a>
                @endif
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full py-2.5 rounded-lg bg-indigo-600 text-white font-semibold
                       hover:bg-indigo-700 transition shadow-lg">
                Log in
            </button>
        </form>

        <!-- Footer -->
        <p class="text-center text-xs text-gray-500 dark:text-gray-400 mt-6">
            © {{ date('Y') }} SchoolMS
        </p>
    </div>

</body>
</html>
