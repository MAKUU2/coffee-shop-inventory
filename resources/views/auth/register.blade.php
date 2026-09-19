<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Registration</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">


    <div class="w-full max-w-2xl">


        <!-- Registration Card -->

        <div class="bg-white rounded-2xl shadow-lg p-8">


            <!-- Header -->

            <div class="text-center mb-8">

                <div class="text-5xl mb-3">
                    ☕
                </div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Create Admin Account
                </h1>

                <p class="text-gray-500 mt-2">
                    Register a new administrator.
                </p>

            </div>


            <!-- Validation Errors -->

            @if ($errors->any())

            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6">

                <ul class="list-disc list-inside space-y-1">

                    @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                    @endforeach

                </ul>

            </div>

            @endif


            <!-- Register Form -->

            <form action="{{ route('register') }}" method="POST">

                @csrf


                <!-- Name -->

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">


                    <!-- First Name -->

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            First Name
                        </label>

                        <input
                            type="text"
                            name="first_name"
                            value="{{ old('first_name') }}"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="First Name">

                    </div>


                    <!-- Middle Name -->

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Middle Name
                        </label>

                        <input
                            type="text"
                            name="middle_name"
                            value="{{ old('middle_name') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Middle Name">

                    </div>


                    <!-- Last Name -->

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Last Name
                        </label>

                        <input
                            type="text"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Last Name">

                    </div>

                </div>


                <!-- Username -->

                <div class="mb-5">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        required
                        autocomplete="username"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Enter username">

                </div>


                <!-- Password -->

                <div class="mb-5">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Enter password">

                    <p class="text-xs text-gray-500 mt-2">
                        Password must be at least 6 characters.
                    </p>

                </div>


                <!-- Confirm Password -->

                <div class="mb-6">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Confirm password">

                </div>


                <!-- Register Button -->

                <button
                    type="submit"
                    class="w-full bg-gray-900 hover:bg-gray-800 text-white font-semibold py-3 rounded-lg transition">

                    Create Admin Account

                </button>

            </form>


            <!-- Login Link -->

            <div class="text-center mt-6">

                <p class="text-gray-500 text-sm">

                    Already have an account?

                    <a
                        href="{{ route('login') }}"
                        class="text-blue-600 hover:text-blue-800 font-semibold">
                        Login
                    </a>

                </p>

            </div>


        </div>


    </div>


</body>

</html>