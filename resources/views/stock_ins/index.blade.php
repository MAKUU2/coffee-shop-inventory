<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Stock In - Coffee Shop</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Stock In
                </h1>

                <p class="text-gray-500 mt-1">
                    Record incoming ingredient stocks.
                </p>
            </div>

            <a href="{{ route('stock-ins.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium">
                + Add Stock In
            </a>

        </div>


        <!-- Success Message -->
        @if(session('success'))

        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>

        @endif


        <!-- Stock In Table -->
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
                                Quantity
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Cost / Unit
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Date
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Notes
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">

                        @forelse($stockIns as $stockIn)

                        <tr class="hover:bg-gray-50">

                            <!-- ID -->
                            <td class="px-6 py-4 text-gray-700">
                                {{ $stockIn->id }}
                            </td>


                            <!-- Ingredient -->
                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-800">
                                    {{ $stockIn->ingredient->name }}
                                </div>

                            </td>


                            <!-- Quantity -->
                            <td class="px-6 py-4 text-gray-700">

                                {{ $stockIn->quantity }}
                                {{ $stockIn->ingredient->unit }}

                            </td>


                            <!-- Cost -->
                            <td class="px-6 py-4 text-gray-700">

                                ₱{{ number_format($stockIn->cost_per_unit, 2) }}

                            </td>


                            <!-- Date -->
                            <td class="px-6 py-4 text-gray-700">

                                {{ $stockIn->stock_in_date->format('M d, Y') }}

                            </td>


                            <!-- Notes -->
                            <td class="px-6 py-4 text-gray-700">

                                @if($stockIn->notes)

                                {{ $stockIn->notes }}

                                @else

                                <span class="text-gray-400">
                                    —
                                </span>

                                @endif

                            </td>


                            <!-- Actions -->
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2">

                                    <a
                                        href="{{ route('stock-ins.edit', $stockIn) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-lg text-sm">
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route('stock-ins.destroy', $stockIn) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this Stock In record?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-sm">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-10 text-center text-gray-500">

                                No Stock In records found.

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