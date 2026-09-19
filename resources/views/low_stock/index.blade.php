<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Low Stock Alert</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>

                <a href="{{ url('/') }}"
                    class="text-gray-600 hover:text-gray-900 text-sm">

                    ← Back to Dashboard

                </a>

                <h1 class="text-3xl font-bold text-gray-800 mt-4">
                    Low Stock Alert
                </h1>

                <p class="text-gray-500 mt-1">
                    Ingredients that need to be restocked.
                </p>

            </div>

            <a href="{{ route('ingredients.create') }}"
                class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-lg font-medium">

                + Add Ingredient

            </a>

        </div>


        <!-- ALERT SUMMARY -->
        <div class="bg-red-50 border border-red-200 rounded-xl p-5 mb-8">

            <div class="flex items-center gap-3">

                <div class="text-3xl">
                    ⚠️
                </div>

                <div>

                    <h2 class="text-lg font-bold text-red-800">
                        Low Stock Warning
                    </h2>

                    <p class="text-red-700">

                        {{ $lowStockIngredients->count() }}

                        {{ $lowStockIngredients->count() == 1 ? 'ingredient needs' : 'ingredients need' }}

                        to be restocked.

                    </p>

                </div>

            </div>

        </div>


        <!-- TABLE -->
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-800 text-white">

                        <tr>

                            <th class="px-6 py-4 text-left">
                                ID
                            </th>

                            <th class="px-6 py-4 text-left">
                                Ingredient
                            </th>

                            <th class="px-6 py-4 text-left">
                                Current Stock
                            </th>

                            <th class="px-6 py-4 text-left">
                                Minimum Stock
                            </th>

                            <th class="px-6 py-4 text-left">
                                Unit
                            </th>

                            <th class="px-6 py-4 text-center">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200">

                        @forelse($lowStockIngredients as $ingredient)

                        <tr class="hover:bg-red-50">

                            <!-- ID -->
                            <td class="px-6 py-4 text-gray-700">
                                {{ $ingredient->id }}
                            </td>


                            <!-- INGREDIENT -->
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


                            <!-- CURRENT STOCK -->
                            <td class="px-6 py-4">

                                <span class="font-bold text-red-600">

                                    {{ number_format($ingredient->stock, 2) }}

                                </span>

                            </td>


                            <!-- MINIMUM STOCK -->
                            <td class="px-6 py-4 text-gray-700">

                                {{ number_format($ingredient->minimum_stock, 2) }}

                            </td>


                            <!-- UNIT -->
                            <td class="px-6 py-4 text-gray-700">

                                {{ $ingredient->unit }}

                            </td>


                            <!-- STATUS -->
                            <td class="px-6 py-4 text-center">

                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">

                                    ⚠ Low Stock

                                </span>

                            </td>


                            <!-- ACTION -->
                            <td class="px-6 py-4 text-center">

                                <a href="{{ route('ingredients.edit', $ingredient) }}"
                                    class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm">

                                    Edit

                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7"
                                class="px-6 py-12 text-center">

                                <div class="text-4xl mb-3">
                                    ✅
                                </div>

                                <div class="text-lg font-semibold text-green-700">
                                    No Low Stock Ingredients
                                </div>

                                <p class="text-gray-500 mt-1">
                                    All ingredients have sufficient stock.
                                </p>

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