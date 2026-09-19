<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Products - Coffee Shop</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    ☕ Products
                </h1>

                <p class="text-gray-500">
                    Manage your coffee shop products.
                </p>

            </div>

            <div class="flex gap-3">

                <a
                    href="/"
                    class="bg-gray-800 text-white px-5 py-3 rounded-lg hover:bg-gray-700">
                    Dashboard
                </a>

                <a
                    href="{{ route('products.create') }}"
                    class="bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700">
                    + Add Product
                </a>

            </div>

        </div>


        <!-- Success Message -->
        @if (session('success'))

        <div class="bg-green-100 text-green-700 px-5 py-4 rounded-lg mb-6">

            {{ session('success') }}

        </div>

        @endif


        <!-- Product Table -->
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="p-6 border-b">

                <h2 class="text-xl font-bold text-gray-800">
                    Product List
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
                                Product
                            </th>

                            <th class="text-left px-6 py-4">
                                Category
                            </th>

                            <th class="text-left px-6 py-4">
                                Price
                            </th>

                            <th class="text-left px-6 py-4">
                                Stock
                            </th>

                            <th class="text-left px-6 py-4">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($products as $product)

                        <tr class="border-t">

                            <!-- ID -->
                            <td class="px-6 py-4">
                                {{ $product->id }}
                            </td>


                            <!-- Product -->
                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-800">
                                    {{ $product->name }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ $product->description ?? 'No description' }}
                                </div>

                            </td>


                            <!-- Category -->
                            <td class="px-6 py-4">

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                    {{ $product->category->name }}

                                </span>

                            </td>


                            <!-- Price -->
                            <td class="px-6 py-4 font-semibold">

                                ₱{{ number_format($product->price, 2) }}

                            </td>


                            <!-- Stock -->
                            <td class="px-6 py-4">

                                @if ($product->stock == 0)

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                    Out of Stock
                                </span>

                                @elseif ($product->stock <= 5)

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                    Low Stock ({{ $product->stock }})
                                    </span>

                                    @else

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        {{ $product->stock }}
                                    </span>

                                    @endif

                            </td>


                            <!-- Actions -->
                            <td class="px-6 py-4">

                                <div class="flex gap-2">

                                    <!-- Edit -->
                                    <a
                                        href="{{ route('products.edit', $product) }}"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                        Edit
                                    </a>


                                    <!-- Delete -->
                                    <form
                                        action="{{ route('products.destroy', $product) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');">

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
                                colspan="6"
                                class="text-center px-6 py-10 text-gray-500">
                                No products found.
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