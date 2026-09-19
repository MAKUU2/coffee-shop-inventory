<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product - Coffee Shop</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-2xl mx-auto px-6 py-10">

        <div class="bg-white rounded-xl shadow-md p-8">

            <!-- Header -->
            <div class="mb-6">

                <h1 class="text-2xl font-bold text-gray-800">
                    Add Product
                </h1>

                <p class="text-gray-500 mt-1">
                    Add a new product to your coffee shop inventory.
                </p>

            </div>


            <!-- Validation Errors -->
            @if ($errors->any())

            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">

                <ul class="list-disc list-inside">

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif


            <!-- Product Form -->
            <form
                action="{{ route('products.store') }}"
                method="POST">

                @csrf


                <!-- Category -->
                <div class="mb-5">

                    <label
                        for="category_id"
                        class="block text-sm font-medium text-gray-700 mb-2">
                        Category
                    </label>

                    <select
                        id="category_id"
                        name="category_id"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <option value="">
                            Select Category
                        </option>

                        @foreach ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>

                        @endforeach

                    </select>

                </div>


                <!-- Product Name -->
                <div class="mb-5">

                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700 mb-2">
                        Product Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Example: Iced Coffee"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>


                <!-- Description -->
                <div class="mb-5">

                    <label
                        for="description"
                        class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Enter product description..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>

                </div>


                <!-- Price -->
                <div class="mb-5">

                    <label
                        for="price"
                        class="block text-sm font-medium text-gray-700 mb-2">
                        Price
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price') }}"
                        placeholder="0.00"
                        step="0.01"
                        min="0"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>


                <!-- Stock -->
                <div class="mb-6">

                    <label
                        for="stock"
                        class="block text-sm font-medium text-gray-700 mb-2">
                        Stock
                    </label>

                    <input
                        type="number"
                        id="stock"
                        name="stock"
                        value="{{ old('stock', 0) }}"
                        min="0"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>


                <!-- Buttons -->
                <div class="flex gap-3">

                    <a
                        href="{{ route('products.index') }}"
                        class="px-5 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Save Product
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>