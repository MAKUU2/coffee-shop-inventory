<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100 min-h-screen flex items-center justify-center">


    <div class="w-full max-w-md">


        <!-- LOGIN CARD -->

        <div class="bg-white rounded-2xl shadow-lg p-8">


            <!-- HEADER -->

            <div class="text-center mb-8">

                <div class="text-5xl mb-4">
                    ☕
                </div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Coffee Shop
                </h1>

                <p class="text-gray-500 mt-2">
                    Admin Login
                </p>

            </div>


            <!-- SUCCESS MESSAGE -->

            @if(session('success'))

            <div class="mb-5 bg-green-50 border border-green-200
                            text-green-700 px-4 py-3 rounded-lg">

                {{ session('success') }}

            </div>

            @endif


            <!-- ERROR MESSAGE -->

            @if(session('error'))

            <div class="mb-5 bg-red-50 border border-red-200
                            text-red-700 px-4 py-3 rounded-lg">

                {{ session('error') }}

            </div>

            @endif


            <!-- LOGIN FORM -->

            <form
                action="{{ route('login.process') }}"
                method="POST"
                class="space-y-5">

                @csrf


                <!-- USERNAME -->

                <div>

                    <label
                        for="username"
                        class="block text-sm font-medium text-gray-700 mb-2">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        required
                        autofocus
                        class="w-full border border-gray-300
                               rounded-lg px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-gray-800"
                        placeholder="Enter your username">

                    @error('username')

                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>

                    @enderror

                </div>


                <!-- PASSWORD -->

                <div>

                    <label
                        for="password"
                        class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full border border-gray-300
                               rounded-lg px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-gray-800"
                        placeholder="Enter your password">

                    @error('password')

                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>

                    @enderror

                </div>


                <!-- LOGIN BUTTON -->

                <button
                    type="submit"
                    class="w-full bg-gray-900
                           hover:bg-gray-800
                           text-white
                           font-semibold
                           py-3
                           rounded-lg
                           transition">

                    Login

                </button>

            </form>


            <!-- REGISTER -->

            <div class="text-center mt-6">

                <p class="text-gray-500 text-sm">

                    Don't have an admin account?

                    <a
                        href="{{ route('register') }}"
                        class="text-blue-600
                               hover:text-blue-800
                               font-medium">
                        Register
                    </a>

                </p>

            </div>


        </div>


    </div>


</body>

</html>