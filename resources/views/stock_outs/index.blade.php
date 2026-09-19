<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Stock Out</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Stock Out
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage ingredients released from inventory.
                </p>
            </div>

            <a href="{{ route('stock-outs.create') }}"
                class="inline-block bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-lg font-medium transition">

                + Add Stock Out

            </a>

        </div>


        <!-- SUCCESS MESSAGE -->
        @if(session('success'))

        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">

            {{ session('success') }}

        </div>

        @endif


        <!-- STOCK OUT TABLE -->
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
                                Quantity
                            </th>

                            <th class="px-6 py-4 text-left">
                                Date
                            </th>

                            <th class="px-6 py-4 text-left">
                                Notes
                            </th>

                            <th class="px-6 py-4 text-center">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200">

                        @forelse($stockOuts as $stockOut)

                        <tr class="hover:bg-gray-50">

                            <!-- ID -->
                            <td class="px-6 py-4 text-gray-700">
                                {{ $stockOut->id }}
                            </td>


                            <!-- INGREDIENT -->
                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-800">
                                    {{ $stockOut->ingredient->name }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    Current Stock:
                                    {{ number_format($stockOut->ingredient->stock, 2) }}
                                    {{ $stockOut->ingredient->unit }}
                                </div>

                            </td>


                            <!-- QUANTITY -->
                            <td class="px-6 py-4">

                                <span class="font-semibold text-red-600">

                                    -{{ number_format($stockOut->quantity, 2) }}

                                    {{ $stockOut->ingredient->unit }}

                                </span>

                            </td>


                            <!-- DATE -->
                            <td class="px-6 py-4 text-gray-700">

                                {{ $stockOut->stock_out_date->format('M d, Y') }}

                            </td>


                            <!-- NOTES -->
                            <td class="px-6 py-4 text-gray-600">

                                {{ $stockOut->notes ?? 'No notes' }}

                            </td>


                            <!-- ACTIONS -->
                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <!-- EDIT -->
                                    <a href="{{ route('stock-outs.edit', $stockOut) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm">

                                        Edit

                                    </a>


                                    <!-- DELETE -->
                                    <form action="{{ route('stock-outs.destroy', $stockOut) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this Stock Out record?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6"
                                class="px-6 py-12 text-center text-gray-500">

                                <div class="text-lg font-medium">
                                    No Stock Out records found.
                                </div>

                                <p class="text-sm mt-1">
                                    Start by adding your first Stock Out.
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