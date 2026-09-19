<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Categories - Coffee Shop</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-6xl mx-auto p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    ☕ Categories
                </h1>

                <p class="text-gray-500">
                    Manage your coffee shop categories.
                </p>
            </div>

            <div class="flex gap-3">

                <a
                    href="/"
                    class="bg-gray-800 text-white px-5 py-3 rounded-lg hover:bg-gray-700">
                    Dashboard
                </a>

                <a
                    href="{{ route('categories.create') }}"
                    class="bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700">
                    + Add Category
                </a>

            </div>

        </div>


        <!-- Success Message -->
        @if (session('success'))

        <div class="bg-green-100 text-green-700 px-5 py-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>

        @endif


        <!-- Category Table -->
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="p-6 border-b">

                <h2 class="text-xl font-bold text-gray-800">
                    Category List
                </h2>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="text-left px-6 py-4">
                                ID
                            </th>

                            <th class="text-left px-6 py-4">
                                Name
                            </th>

                            <th class="text-left px-6 py-4">
                                Description
                            </th>

                            <th class="text-left px-6 py-4">
                                Created
                            </th>

                            <th class="text-left px-6 py-4">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($categories as $category)

                        <tr class="border-t">

                            <!-- ID -->
                            <td class="px-6 py-4">
                                {{ $category->id }}
                            </td>


                            <!-- Name -->
                            <td class="px-6 py-4 font-semibold">
                                {{ $category->name }}
                            </td>


                            <!-- Description -->
                            <td class="px-6 py-4 text-gray-600">
                                {{ $category->description ?? 'No description' }}
                            </td>


                            <!-- Created -->
                            <td class="px-6 py-4 text-gray-600">
                                {{ $category->created_at->format('M d, Y') }}
                            </td>


                            <!-- Actions -->
                            <td class="px-6 py-4">

                                <div class="flex gap-2">

                                    <!-- Edit -->
                                    <a
                                        href="{{ route('categories.edit', $category) }}"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                        Edit
                                    </a>


                                    <!-- Delete -->
                                    <form
                                        action="{{ route('categories.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this category?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center px-6 py-10 text-gray-500">
                                No categories found.
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>