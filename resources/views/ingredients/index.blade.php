<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ingredients - Coffee Shop</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Ingredients
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage your coffee shop ingredients.
                </p>
            </div>

            <a href="{{ route('ingredients.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium">
                + Add Ingredient
            </a>

        </div>


        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
        @endif


        <!-- Ingredients Table -->
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50 border-b">

                        <tr>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                ID
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Ingredient
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Unit
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Stock
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Minimum Stock
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Cost / Unit
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Status
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">

                        @forelse($ingredients as $ingredient)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 text-gray-700">
                                {{ $ingredient->id }}
                            </td>


                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-800">
                                    {{ $ingredient->name }}
                                </div>

                                @if($ingredient->description)
                                <div class="text-sm text-gray-500">
                                    {{ $ingredient->description }}
                                </div>
                                @endif

                            </td>


                            <td class="px-6 py-4 text-gray-700">
                                {{ $ingredient->unit }}
                            </td>


                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $ingredient->stock }}
                                {{ $ingredient->unit }}
                            </td>


                            <td class="px-6 py-4 text-gray-700">
                                {{ $ingredient->minimum_stock }}
                                {{ $ingredient->unit }}
                            </td>


                            <td class="px-6 py-4 text-gray-700">
                                ₱{{ number_format($ingredient->cost_per_unit, 2) }}
                            </td>


                            <td class="px-6 py-4">

                                @if($ingredient->stock <= $ingredient->minimum_stock)

                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                        Low Stock
                                    </span>

                                    @else

                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        In Stock
                                    </span>

                                    @endif

                            </td>


                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2">

                                    <a href="{{ route('ingredients.edit', $ingredient) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-lg text-sm">
                                        Edit
                                    </a>


                                    <form action="{{ route('ingredients.destroy', $ingredient) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this ingredient?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-sm">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="8"
                                class="px-6 py-10 text-center text-gray-500">

                                No ingredients found.

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