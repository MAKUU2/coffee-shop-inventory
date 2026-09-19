<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Stock Out</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto px-6 py-10">

        <!-- HEADER -->
        <div class="mb-8">

            <a href="{{ route('stock-outs.index') }}"
                class="text-gray-600 hover:text-gray-900 text-sm">

                ← Back to Stock Out

            </a>

            <h1 class="text-3xl font-bold text-gray-800 mt-4">
                Add Stock Out
            </h1>

            <p class="text-gray-500 mt-1">
                Record ingredients released from inventory.
            </p>

        </div>


        <!-- VALIDATION ERRORS -->
        @if($errors->any())

        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">

            <p class="font-semibold mb-2">
                Please fix the following errors:
            </p>

            <ul class="list-disc list-inside text-sm">

                @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif


        <!-- FORM -->
        <div class="bg-white rounded-xl shadow p-6">

            <form action="{{ route('stock-outs.store') }}"
                method="POST">

                @csrf


                <!-- INGREDIENT -->
                <div class="mb-5">

                    <label for="ingredient_id"
                        class="block text-sm font-medium text-gray-700 mb-2">

                        Ingredient

                    </label>

                    <select name="ingredient_id"
                        id="ingredient_id"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500">

                        <option value="">
                            Select Ingredient
                        </option>

                        @foreach($ingredients as $ingredient)

                        <option value="{{ $ingredient->id }}"
                            {{ old('ingredient_id') == $ingredient->id ? 'selected' : '' }}>

                            {{ $ingredient->name }}
                            -
                            Current Stock:
                            {{ number_format($ingredient->stock, 2) }}
                            {{ $ingredient->unit }}

                        </option>

                        @endforeach

                    </select>

                </div>


                <!-- QUANTITY -->
                <div class="mb-5">

                    <label for="quantity"
                        class="block text-sm font-medium text-gray-700 mb-2">

                        Quantity

                    </label>

                    <input type="number"
                        name="quantity"
                        id="quantity"
                        value="{{ old('quantity') }}"
                        min="0.01"
                        step="0.01"
                        required
                        placeholder="Enter quantity"

                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500">

                </div>


                <!-- DATE -->
                <div class="mb-5">

                    <label for="stock_out_date"
                        class="block text-sm font-medium text-gray-700 mb-2">

                        Stock Out Date

                    </label>

                    <input type="date"
                        name="stock_out_date"
                        id="stock_out_date"

                        value="{{ old('stock_out_date', date('Y-m-d')) }}"

                        required

                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500">

                </div>


                <!-- NOTES -->
                <div class="mb-6">

                    <label for="notes"
                        class="block text-sm font-medium text-gray-700 mb-2">

                        Notes

                    </label>

                    <textarea name="notes"
                        id="notes"
                        rows="4"
                        placeholder="Enter notes (optional)"

                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ old('notes') }}</textarea>

                </div>


                <!-- BUTTONS -->
                <div class="flex gap-3">

                    <a href="{{ route('stock-outs.index') }}"
                        class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3 rounded-lg font-medium">

                        Cancel

                    </a>


                    <button type="submit"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-lg font-medium">

                        Save Stock Out

                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>