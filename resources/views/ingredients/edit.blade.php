<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Ingredient - Coffee Shop</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto px-6 py-8">

        <!-- Header -->
        <div class="mb-6">

            <h1 class="text-3xl font-bold text-gray-800">
                Edit Ingredient
            </h1>

            <p class="text-gray-500 mt-1">
                Update the ingredient information.
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

            <form action="{{ route('ingredients.update', $ingredient) }}" method="POST">

                @csrf
                @method('PUT')


                <!-- Ingredient Name -->
                <div class="mb-5">

                    <label for="name"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Ingredient Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $ingredient->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                </div>


                <!-- Description -->
                <div class="mb-5">

                    <label for="description"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $ingredient->description) }}</textarea>

                </div>


                <!-- Unit -->
                <div class="mb-5">

                    <label for="unit"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Unit
                    </label>

                    <select
                        id="unit"
                        name="unit"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                        <option value="">Select Unit</option>

                        <option value="kg"
                            {{ old('unit', $ingredient->unit) == 'kg' ? 'selected' : '' }}>
                            Kilogram (kg)
                        </option>

                        <option value="g"
                            {{ old('unit', $ingredient->unit) == 'g' ? 'selected' : '' }}>
                            Gram (g)
                        </option>

                        <option value="liter"
                            {{ old('unit', $ingredient->unit) == 'liter' ? 'selected' : '' }}>
                            Liter
                        </option>

                        <option value="ml"
                            {{ old('unit', $ingredient->unit) == 'ml' ? 'selected' : '' }}>
                            Milliliter (ml)
                        </option>

                        <option value="bottle"
                            {{ old('unit', $ingredient->unit) == 'bottle' ? 'selected' : '' }}>
                            Bottle
                        </option>

                        <option value="piece"
                            {{ old('unit', $ingredient->unit) == 'piece' ? 'selected' : '' }}>
                            Piece
                        </option>

                        <option value="pack"
                            {{ old('unit', $ingredient->unit) == 'pack' ? 'selected' : '' }}>
                            Pack
                        </option>

                    </select>

                </div>


                <!-- Current Stock -->
                <div class="mb-5">

                    <label for="stock"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Current Stock
                    </label>

                    <input
                        type="number"
                        id="stock"
                        name="stock"
                        value="{{ old('stock', $ingredient->stock) }}"
                        min="0"
                        step="0.01"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                </div>


                <!-- Minimum Stock -->
                <div class="mb-5">

                    <label for="minimum_stock"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Minimum Stock
                    </label>

                    <input
                        type="number"
                        id="minimum_stock"
                        name="minimum_stock"
                        value="{{ old('minimum_stock', $ingredient->minimum_stock) }}"
                        min="0"
                        step="0.01"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                    <p class="text-sm text-gray-500 mt-1">
                        The system will consider the ingredient low stock when it reaches this level.
                    </p>

                </div>


                <!-- Cost Per Unit -->
                <div class="mb-6">

                    <label for="cost_per_unit"
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
                            value="{{ old('cost_per_unit', $ingredient->cost_per_unit) }}"
                            min="0"
                            step="0.01"
                            class="w-full border border-gray-300 rounded-lg pl-9 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>

                    </div>

                </div>


                <!-- Buttons -->
                <div class="flex items-center gap-3">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium">
                        Update Ingredient
                    </button>

                    <a
                        href="{{ route('ingredients.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-lg font-medium">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>