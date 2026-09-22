<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - Coffee Shop Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-100 min-h-screen text-gray-800 antialiased flex items-center justify-center px-4 sm:px-6 py-8">
    <div class="w-full max-w-2xl">
        <!-- Brand -->
        <div class="text-center mb-6">
            <span class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-stone-950 text-amber-400 shadow-sm" aria-hidden="true">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72L4.318 3.44A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72m-13.5 8.65h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                </svg>
            </span>
            <h1 class="text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight mt-4">
                Coffee Shop Inventory
            </h1>
            <p class="text-sm text-stone-500 mt-1">
                Create the administrator account.
            </p>
        </div>
        <!-- Registration Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-stone-200/70 p-6 sm:p-8">
            <h2 class="text-base sm:text-lg font-bold text-stone-900 tracking-tight">
                Create Admin Account
            </h2>
            <p class="text-xs sm:text-sm text-stone-500 mt-0.5 mb-6">
                Register a new administrator.
            </p>
            <!-- Validation Errors -->
            @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 text-sm rounded-xl px-4 py-3 mb-6" role="alert">
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Register Form -->
            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <!-- Name -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">
                    <!-- First Name -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">
                            First Name
                        </label>
                        <input
                            type="text"
                            name="first_name"
                            value="{{ old('first_name') }}"
                            required
                            class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 focus-visible:outline-none"
                            placeholder="First Name">
                    </div>
                    <!-- Middle Name -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">
                            Middle Name
                        </label>
                        <input
                            type="text"
                            name="middle_name"
                            value="{{ old('middle_name') }}"
                            class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 focus-visible:outline-none"
                            placeholder="Middle Name (optional)">
                    </div>
                    <!-- Last Name -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">
                            Last Name
                        </label>
                        <input
                            type="text"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            required
                            class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 focus-visible:outline-none"
                            placeholder="Last Name">
                    </div>
                </div>
                <!-- Username -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-stone-700 mb-2">
                        Username
                    </label>
                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        required
                        autocomplete="username"
                        class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 focus-visible:outline-none"
                        placeholder="Enter username">
                </div>
                <!-- Password -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-stone-700 mb-2">
                        Password
                    </label>
                    <input
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 focus-visible:outline-none"
                        placeholder="Enter password">
                    <p class="text-xs text-stone-500 mt-2">
                        Password must be at least 6 characters.
                    </p>
                </div>
                <!-- Confirm Password -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-stone-700 mb-2">
                        Confirm Password
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 focus-visible:outline-none"
                        placeholder="Confirm password">
                </div>
                <!-- Register Button -->
                <button
                    type="submit"
                    class="w-full bg-stone-900 hover:bg-stone-800 text-white font-semibold py-2.5 rounded-lg transition shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:ring-offset-2">
                    Create Admin Account
                </button>
            </form>
            <!-- Login Link -->
            <div class="text-center mt-6 pt-6 border-t border-stone-200/70">
                <p class="text-stone-500 text-sm">
                    Already have an account?
                    <a
                        href="{{ route('login') }}"
                        class="text-amber-700 hover:text-amber-800 font-semibold focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 focus-visible:rounded">
                        Login
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
