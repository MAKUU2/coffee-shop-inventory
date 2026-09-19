<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Stock In - Coffee Shop</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto px-6 py-8">

        <!-- Header -->
        <div class="mb-6">

            <a href="{{ route('stock-ins.index') }}"
                class="text-gray-600 hover:text-gray-900 text-sm">

                ← Back to Stock In

            </a>

            <h1 class="text-3xl font-bold text-gray-800 mt-4">
                Edit Stock In
            </h1>

            <p class="text-gray-500 mt-1">
                Update the Stock In record.
            </p>

        </div>


        <!-- Validation Errors -->
        @if ($errors->any())

        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">

            <p class="font-semibold mb-2">
                Please fix the following errors:
            </p>

            <ul class="list-disc list-inside">

                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

        @endif


        <!-- Form -->
        <div class="bg-white rounded-xl shadow p-6">

            <form action="{{ route('stock-ins.update', $stockIn) }}" method="POST">

                @csrf
                @method('PUT')


                <!-- Ingredient -->
                <div class="mb-5">

                    <label
                        for="ingredient_id"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Ingredient
                    </label>

                    <select
                        id="ingredient_id"
                        name="ingredient_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                        <option value="">
                            Select Ingredient
                        </option>

                        @foreach($ingredients as $ingredient)

                        <option
                            value="{{ $ingredient->id }}"
                            {{ old('ingredient_id', $stockIn->ingredient_id) == $ingredient->id ? 'selected' : '' }}>

                            {{ $ingredient->name }}
                            (Current: {{ $ingredient->stock }} {{ $ingredient->unit }})

                        </option>

                        @endforeach

                    </select>

                </div>


                <!-- Quantity -->
                <div class="mb-5">

                    <label
                        for="quantity"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Quantity
                    </label>

                    <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        value="{{ old('quantity', $stockIn->quantity) }}"
                        min="0.01"
                        step="0.01"
                        placeholder="Example: 5"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                    <p class="text-sm text-gray-500 mt-1">
                        Enter the amount of stock received.
                    </p>

                </div>


                <!-- Cost Per Unit -->
                <div class="mb-5">

                    <label
                        for="cost_per_unit"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Cost Per Unit
                    </label>

                    <div class="relative">

                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                            ₱
                        </span>

                        <input
                            type="number"
                            id="cost_per_unit"
                            name="cost_per_unit"
                            value="{{ old('cost_per_unit', $stockIn->cost_per_unit) }}"
                            min="0"
                            step="0.01"
                            placeholder="Example: 450.00"
                            class="w-full border border-gray-300 rounded-lg pl-9 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>

                    </div>

                </div>


                <!-- Stock In Date -->
                <div class="mb-5">

                    <label
                        for="stock_in_date"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Stock In Date
                    </label>

                    <input
                        type="date"
                        id="stock_in_date"
                        name="stock_in_date"
                        value="{{ old('stock_in_date', $stockIn->stock_in_date->format('Y-m-d')) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                </div>


                <!-- Notes -->
                <div class="mb-6">

                    <label
                        for="notes"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Notes
                    </label>

                    <textarea
                        id="notes"
                        name="notes"
                        rows="4"
                        placeholder="Example: New supplier delivery"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('notes', $stockIn->notes) }}</textarea>

                </div>


                <!-- Buttons -->
                <div class="flex items-center gap-3">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium">
                        Update Stock In
                    </button>

                    <a
                        href="{{ route('stock-ins.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-lg font-medium">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>
