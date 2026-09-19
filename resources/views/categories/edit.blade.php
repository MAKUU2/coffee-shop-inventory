<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Category</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-2xl mx-auto px-6 py-10">

        <div class="bg-white rounded-xl shadow-md p-8">

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Edit Category
                </h1>

                <p class="text-gray-500 mt-1">
                    Update the category information.
                </p>
            </div>

            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('categories.update', $category) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-5">

                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700 mb-2">
                        Category Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <div class="mb-6">

                    <label
                        for="description"
                        class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $category->description) }}</textarea>

                </div>

                <div class="flex gap-3">

                    <a
                        href="{{ route('categories.index') }}"
                        class="px-5 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Update Category
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>