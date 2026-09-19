<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Coffee Shop Inventory</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100 min-h-screen">


    <!-- ============================= -->
    <!-- SIDEBAR -->
    <!-- ============================= -->

    <aside class="fixed left-0 top-0 h-screen w-64 bg-gray-900 text-white p-6">

        <h1 class="text-2xl font-bold mb-8">
            ☕ Coffee Shop
        </h1>


        <!-- NAVIGATION -->

        <nav class="space-y-3">

            <a href="{{ route('dashboard') }}"
                class="block rounded-lg bg-gray-700 px-4 py-3">
                Dashboard
            </a>

            <a href="{{ route('products.index') }}"
                class="block rounded-lg px-4 py-3 hover:bg-gray-700">
                Products
            </a>

            <a href="{{ route('categories.index') }}"
                class="block rounded-lg px-4 py-3 hover:bg-gray-700">
                Categories
            </a>

            <a href="{{ route('ingredients.index') }}"
                class="block rounded-lg px-4 py-3 hover:bg-gray-700">
                Ingredients
            </a>

            <a href="{{ route('stock-ins.index') }}"
                class="block rounded-lg px-4 py-3 hover:bg-gray-700">
                Stock In
            </a>

            <a href="{{ route('stock-outs.index') }}"
                class="block rounded-lg px-4 py-3 hover:bg-gray-700">
                Stock Out
            </a>

            <a href="{{ route('low-stock.index') }}"
                class="block rounded-lg px-4 py-3 hover:bg-gray-700">
                ⚠ Low Stock
            </a>

        </nav>


        <!-- ============================= -->
        <!-- LOGOUT -->
        <!-- ============================= -->

        <div class="mt-8 pt-6 border-t border-gray-700">

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button
                    type="submit"
                    class="w-full text-left
                           rounded-lg
                           px-4
                           py-3
                           text-red-400
                           hover:bg-gray-700
                           hover:text-red-300
                           transition">
                    🚪 Logout
                </button>

            </form>

        </div>

    </aside>


    <!-- ============================= -->
    <!-- MAIN CONTENT -->
    <!-- ============================= -->

    <main class="ml-64 p-8">


        <!-- HEADER -->

        <div class="mb-8">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-3xl font-bold text-gray-800">
                        Dashboard
                    </h2>

                    <p class="text-gray-500">
                        Welcome to your Coffee Shop Inventory System.
                    </p>

                </div>


                <!-- ADMIN INFO -->

                <div class="bg-white rounded-lg shadow px-5 py-3">

                    <p class="text-xs text-gray-500">
                        Logged in as
                    </p>

                    <p class="font-semibold text-gray-800">
                        {{ session('admin_name') }}
                    </p>

                </div>

            </div>

        </div>


        <!-- SUCCESS MESSAGE -->

        @if(session('success'))

        <div class="mb-6 bg-green-50
                        border border-green-200
                        text-green-700
                        px-5 py-4
                        rounded-lg">

            {{ session('success') }}

        </div>

        @endif


        <!-- ============================= -->
        <!-- STATISTICS -->
        <!-- ============================= -->

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">


            <!-- TOTAL PRODUCTS -->

            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-500">
                            Total Products
                        </p>

                        <h3 class="text-4xl font-bold text-gray-800 mt-2">
                            {{ $totalProducts }}
                        </h3>

                    </div>

                    <div class="text-4xl">
                        📦
                    </div>

                </div>

            </div>


            <!-- TOTAL INGREDIENTS -->

            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-500">
                            Total Ingredients
                        </p>

                        <h3 class="text-4xl font-bold text-gray-800 mt-2">
                            {{ $totalIngredients }}
                        </h3>

                    </div>

                    <div class="text-4xl">
                        🧂
                    </div>

                </div>

            </div>


            <!-- STOCK IN -->

            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-500">
                            Stock In Records
                        </p>

                        <h3 class="text-4xl font-bold text-green-600 mt-2">
                            {{ $totalStockIns }}
                        </h3>

                    </div>

                    <div class="text-4xl">
                        📥
                    </div>

                </div>

            </div>


            <!-- STOCK OUT -->

            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-500">
                            Stock Out Records
                        </p>

                        <h3 class="text-4xl font-bold text-orange-600 mt-2">
                            {{ $totalStockOuts }}
                        </h3>

                    </div>

                    <div class="text-4xl">
                        📤
                    </div>

                </div>

            </div>

        </div>


        <!-- ============================= -->
        <!-- LOW STOCK STATISTIC -->
        <!-- ============================= -->

        <div class="mt-6">

            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-500">
                            Low Stock Items
                        </p>

                        <h3
                            class="text-4xl font-bold
                            {{ $lowStockCount > 0
                                ? 'text-red-500'
                                : 'text-green-500'
                            }}
                            mt-2">

                            {{ $lowStockCount }}

                        </h3>

                    </div>

                    <div class="text-4xl">

                        {{ $lowStockCount > 0 ? '⚠️' : '✅' }}

                    </div>

                </div>


                <div class="mt-4">

                    <a
                        href="{{ route('low-stock.index') }}"
                        class="text-sm
                               text-red-600
                               hover:text-red-800
                               font-medium">

                        View Low Stock Items →

                    </a>

                </div>

            </div>

        </div>


        <!-- ============================= -->
        <!-- LOW STOCK ALERT -->
        <!-- ============================= -->

        @if($lowStockCount > 0)

        <div class="bg-red-50
                        border border-red-200
                        rounded-xl
                        p-5
                        mt-8">


            <div class="flex flex-col
                            md:flex-row
                            md:items-center
                            md:justify-between
                            gap-4">


                <div class="flex items-center gap-4">

                    <div class="text-3xl">
                        ⚠️
                    </div>


                    <div>

                        <h2 class="text-lg font-bold text-red-800">
                            Low Stock Alert
                        </h2>


                        <p class="text-red-700">

                            {{ $lowStockCount }}

                            {{ $lowStockCount == 1
                                    ? 'ingredient is'
                                    : 'ingredients are'
                                }}

                            running low on stock.

                        </p>

                    </div>

                </div>


                <a
                    href="{{ route('low-stock.index') }}"
                    class="inline-block
                               bg-red-600
                               hover:bg-red-700
                               text-white
                               px-5
                               py-3
                               rounded-lg
                               font-medium
                               text-center">

                    View Low Stock

                </a>

            </div>


            <!-- LOW STOCK ITEMS -->

            <div class="mt-5 space-y-2">


                @foreach($lowStockIngredients as $ingredient)

                <div
                    class="bg-white
                                   border
                                   border-red-100
                                   rounded-lg
                                   px-4
                                   py-3
                                   flex
                                   justify-between
                                   items-center">


                    <div>

                        <p class="font-semibold text-gray-800">

                            {{ $ingredient->name }}

                        </p>


                        <p class="text-sm text-gray-500">

                            Minimum:

                            {{ number_format(
                                        $ingredient->minimum_stock,
                                        2
                                    ) }}

                            {{ $ingredient->unit }}

                        </p>

                    </div>


                    <div class="text-right">

                        <p class="font-bold text-red-600">

                            {{ number_format(
                                        $ingredient->stock,
                                        2
                                    ) }}

                            {{ $ingredient->unit }}

                        </p>


                        <p class="text-xs text-red-500">
                            Current Stock
                        </p>

                    </div>


                </div>

                @endforeach


            </div>

        </div>


        @else


        <!-- NO LOW STOCK -->

        <div
            class="bg-green-50
                       border
                       border-green-200
                       rounded-xl
                       p-5
                       mt-8">

            <div class="flex items-center gap-4">

                <div class="text-3xl">
                    ✅
                </div>


                <div>

                    <h2 class="text-lg font-bold text-green-800">

                        Inventory Status

                    </h2>


                    <p class="text-green-700">

                        All ingredients have sufficient stock.

                    </p>

                </div>

            </div>

        </div>


        @endif


        <!-- ============================= -->
        <!-- RECENT PRODUCTS -->
        <!-- ============================= -->

        <div class="mt-8 bg-white rounded-xl shadow">


            <div class="p-6 border-b">

                <div class="flex items-center justify-between">

                    <h3 class="text-xl font-bold text-gray-800">

                        Recent Products

                    </h3>


                    <a
                        href="{{ route('products.index') }}"
                        class="text-sm
                               text-blue-600
                               hover:text-blue-800">

                        View All →

                    </a>

                </div>

            </div>


            <!-- TABLE -->

            <div class="overflow-x-auto">

                <table class="w-full">


                    <thead class="bg-gray-50">

                        <tr>

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
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @php

                        $recentProducts =
                        \App\Models\Product::with('category')
                        ->latest()
                        ->take(5)
                        ->get();

                        @endphp


                        @forelse($recentProducts as $product)


                        <tr class="border-t hover:bg-gray-50">


                            <!-- PRODUCT -->

                            <td class="px-6 py-4 font-medium text-gray-800">

                                {{ $product->name }}

                            </td>


                            <!-- CATEGORY -->

                            <td class="px-6 py-4 text-gray-600">

                                {{ $product->category->name ?? 'No Category' }}

                            </td>


                            <!-- PRICE -->

                            <td class="px-6 py-4 text-gray-600">

                                ₱{{ number_format(
                                        $product->price,
                                        2
                                    ) }}

                            </td>


                            <!-- STOCK -->

                            <td class="px-6 py-4 text-gray-600">

                                {{ $product->stock }}

                            </td>


                            <!-- STATUS -->

                            <td class="px-6 py-4">


                                @if($product->stock > 0)


                                <span
                                    class="bg-green-100
                                                   text-green-700
                                                   px-3
                                                   py-1
                                                   rounded-full
                                                   text-sm">

                                    Available

                                </span>


                                @else


                                <span
                                    class="bg-red-100
                                                   text-red-700
                                                   px-3
                                                   py-1
                                                   rounded-full
                                                   text-sm">

                                    Out of Stock

                                </span>


                                @endif


                            </td>


                        </tr>


                        @empty


                        <tr>

                            <td
                                colspan="5"
                                class="px-6
                                           py-10
                                           text-center
                                           text-gray-500">

                                No products found.

                            </td>

                        </tr>


                        @endforelse


                    </tbody>

                </table>

            </div>

        </div>


    </main>


</body>

</html>