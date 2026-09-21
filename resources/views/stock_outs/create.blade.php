<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock Out - Coffee Shop Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-100 min-h-screen text-gray-800 antialiased">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('stock-outs.index') }}"
                class="text-sm text-stone-500 hover:text-stone-900 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 focus-visible:rounded">
                &larr; Back to Stock Out
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight mt-4">
                Add Stock Out
            </h1>
            <p class="text-sm text-stone-500 mt-1">
                Record ingredients released from inventory.
            </p>
        </div>
        <!-- Validation Errors -->
        @if (isset($errors) && $errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 text-sm px-5 py-3.5 rounded-xl" role="alert">
            <p class="font-semibold mb-2">
                Please fix the following errors:
            </p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-stone-200/70 p-5 sm:p-6">
            <form action="{{ route('stock-outs.store') }}"
                method="POST">
                @csrf
                <!-- Ingredient -->
                <div class="mb-5">
                    <label for="ingredient_id"
                        class="block text-sm font-semibold text-stone-700 mb-2">
                        Ingredient
                    </label>
                    <select name="ingredient_id"
                        id="ingredient_id"
                        required
                        class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-stone-800 bg-white">
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
                <!-- Quantity -->
                <div class="mb-5">
                    <label for="quantity"
                        class="block text-sm font-semibold text-stone-700 mb-2">
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
                        class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-stone-800">
                    <p class="text-sm text-stone-500 mt-1">
                        Enter the amount released. Must not exceed available stock.
                    </p>
                </div>
                <!-- Date -->
                <div class="mb-5">
                    <label for="stock_out_date"
                        class="block text-sm font-semibold text-stone-700 mb-2">
                        Stock Out Date
                    </label>
                    <input type="date"
                        name="stock_out_date"
                        id="stock_out_date"
                        value="{{ old('stock_out_date', date('Y-m-d')) }}"
                        required
                        class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-stone-800">
                </div>
                <!-- Notes -->
                <div class="mb-6">
                    <label for="notes"
                        class="block text-sm font-semibold text-stone-700 mb-2">
                        Notes
                    </label>
                    <textarea name="notes"
                        id="notes"
                        rows="4"
                        placeholder="Enter notes (optional)"
                        class="w-full border border-stone-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-stone-800 focus:border-stone-800">{{ old('notes') }}</textarea>
                </div>
                <!-- Buttons -->
                <div class="flex flex-col-reverse sm:flex-row gap-3">
                    <a href="{{ route('stock-outs.index') }}"
                        class="flex-1 text-center bg-stone-200 hover:bg-stone-300 text-stone-700 px-5 py-2.5 rounded-lg font-medium transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 focus-visible:ring-offset-2">
                        Cancel
                    </a>
                    <button type="submit"
                        class="flex-1 bg-stone-900 hover:bg-stone-800 text-white px-5 py-2.5 rounded-lg font-medium transition shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:ring-offset-2 focus-visible:ring-offset-stone-100">
                        Save Stock Out
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
