<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin - Coffee Shop Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-100 min-h-screen text-gray-800 antialiased">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('admins.index') }}"
                class="text-sm text-stone-500 hover:text-stone-900 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 focus-visible:rounded">
                &larr; Back to Manage Accounts
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight mt-4">
                Add Admin
            </h1>
            <p class="text-sm text-stone-500 mt-1">
                Create another administrator account.
            </p>
        </div>
        <!-- Validation Errors -->
        @if (isset($errors) && $errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 text-sm px-5 py-3.5 rounded-xl" role="alert">
            <p class="font-semibold mb-2">
                Please fix the following errors:
            </p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-stone-200/70 p-5 sm:p-6">
            <form action="{{ route('admins.store') }}" method="POST">
                @csrf
                <!-- Name -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">
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
                <!-- Buttons -->
                <div class="flex flex-col-reverse sm:flex-row gap-3">
                    <a
                        href="{{ route('admins.index') }}"
                        class="flex-1 text-center bg-stone-200 hover:bg-stone-300 text-stone-700 px-5 py-2.5 rounded-lg font-medium transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 focus-visible:ring-offset-2">
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="flex-1 bg-stone-900 hover:bg-stone-800 text-white px-5 py-2.5 rounded-lg font-medium transition shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:ring-offset-2 focus-visible:ring-offset-stone-100">
                        Create Admin Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
