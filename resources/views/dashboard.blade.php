<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Coffee Shop Inventory</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-stone-100 min-h-screen text-gray-800 antialiased">


    <!-- ============================= -->
    <!-- MOBILE TOP BAR -->
    <!-- ============================= -->

    <header class="lg:hidden sticky top-0 z-30 bg-stone-950 text-white px-4 py-3 flex items-center justify-between shadow">

        <button
            type="button"
            id="sidebarToggle"
            aria-label="Open navigation menu"
            aria-expanded="false"
            class="p-2 rounded-lg hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-amber-500">

            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>

        </button>

        <p class="font-semibold tracking-tight">
            Coffee Shop <span class="text-amber-500">Inventory</span>
        </p>

        <span class="w-10"></span>

    </header>


    <!-- Mobile sidebar overlay -->

    <div id="sidebarOverlay" class="hidden fixed inset-0 z-30 bg-black/50 lg:hidden"></div>


    <!-- ============================= -->
    <!-- SIDEBAR -->
    <!-- ============================= -->

    <aside
        id="sidebar"
        class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full lg:translate-x-0 transition-transform duration-200 bg-stone-950 text-stone-200 flex flex-col p-6">

        <div class="flex items-center gap-3 mb-8">

            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-amber-500/15 text-amber-400 shrink-0">

                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72L4.318 3.44A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72m-13.5 8.65h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                </svg>

            </span>

            <div>

                <p class="text-lg font-bold text-white leading-tight tracking-tight">
                    Coffee Shop
                </p>

                <p class="text-xs uppercase tracking-widest text-stone-400">
                    Inventory
                </p>

            </div>

        </div>


        <!-- NAVIGATION -->

        <nav class="space-y-1 text-sm font-medium" aria-label="Main navigation">

            <a href="{{ route('dashboard') }}"
                aria-current="page"
                class="flex items-center gap-3 rounded-lg bg-white/10 px-4 py-2.5 text-white border-l-2 border-amber-500">

                <svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75" />
                </svg>

                Dashboard
            </a>

            <a href="{{ route('products.index') }}"
                class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-stone-300 hover:bg-white/5 hover:text-white transition">

                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5 15.75 3m-8.836 14.25c-.046-.058-.101-.123-.144-.184a2.544 2.544 0 0 1-.364-1.364V7.697c0-.757.728-1.3 1.452-1.068l12.024 3.85a1.224 1.224 0 0 1 .806 1.145v8.726c0 1.058-.806 1.918-1.8 1.918h-1.8a1.8 1.8 0 0 1-1.8-1.8v-1.8a1.8 1.8 0 0 1 1.8-1.8h1.454M6 15.5V9.03a.75.75 0 0 1 .75-.75h11.25" />
                </svg>

                Products
            </a>

            <a href="{{ route('categories.index') }}"
                class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-stone-300 hover:bg-white/5 hover:text-white transition">

                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>

                Categories
            </a>

            <a href="{{ route('ingredients.index') }}"
                class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-stone-300 hover:bg-white/5 hover:text-white transition">

                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 14.5M14.25 3.104c.251.023.501.05.75.082M19.8 14.5l-1.57.393A2.25 2.25 0 0 1 16.5 15.75v3.375c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125v-3.375c0-.621-.504-1.125-1.125-1.125h-2.25A2.25 2.25 0 0 1 6.622 14.5L5 14.5m0 0v5.75c0 .621.504 1.125 1.125 1.125h11.25c.621 0 1.125-.504 1.125-1.125v-5.75" />
                </svg>

                Ingredients
            </a>

            <a href="{{ route('stock-ins.index') }}"
                class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-stone-300 hover:bg-white/5 hover:text-white transition">

                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.073a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25v-4.073M12 3v12m0 0-3.75-3.75M12 15l3.75-3.75" />
                </svg>

                Stock In
            </a>

            <a href="{{ route('stock-outs.index') }}"
                class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-stone-300 hover:bg-white/5 hover:text-white transition">

                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 9.85v4.073a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25V9.85M12 15V3m0 0L8.25 6.75M12 3l3.75 3.75" />
                </svg>

                Stock Out
            </a>

            <a href="{{ route('low-stock.index') }}"
                class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-stone-300 hover:bg-white/5 hover:text-white transition">

                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>

                Low Stock

                @if($lowStockCount > 0)

                <span class="ml-auto inline-flex items-center justify-center min-w-6 h-6 px-1.5 rounded-full bg-red-500/20 text-red-300 text-xs font-bold tabular-nums">
                    {{ $lowStockCount }}
                </span>

                @endif

            </a>

        </nav>


        <!-- ============================= -->
        <!-- LOGOUT -->
        <!-- ============================= -->

        <div class="mt-auto pt-6 border-t border-white/10">

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button
                    type="submit"
                    class="flex items-center gap-3 w-full rounded-lg px-4 py-2.5 text-sm font-medium text-red-400 hover:bg-white/5 hover:text-red-300 transition">

                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>

                    Logout
                </button>

            </form>

        </div>

    </aside>


    <!-- ============================= -->
    <!-- MAIN CONTENT -->
    <!-- ============================= -->

    <main class="lg:ml-64 p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto w-full">


        <!-- HEADER -->

        <div class="mb-6 lg:mb-8">

            <div class="flex flex-col gap-4">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div>

                        <h2 class="text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight">
                            Dashboard
                        </h2>

                        <p class="text-sm text-stone-500 mt-1">
                            {{ now()->format('l, F j, Y') }} &middot; Coffee Shop Inventory overview
                        </p>

                    </div>


                    <!-- ADMIN INFO -->

                    <div class="flex items-center gap-3 bg-white rounded-xl shadow-sm border border-stone-200/70 px-4 py-2.5 w-fit">

                        <span class="flex items-center justify-center w-9 h-9 rounded-full bg-amber-100 text-amber-700 font-bold text-sm shrink-0" aria-hidden="true">
                            {{ strtoupper(substr(session('admin_name', 'A'), 0, 1)) }}
                        </span>

                        <div>

                            <p class="text-xs text-stone-500 leading-none">
                                Logged in as
                            </p>

                            <p class="text-sm font-semibold text-stone-800 mt-0.5">
                                {{ session('admin_name') }}
                            </p>

                        </div>

                    </div>

                </div>


                <!-- QUICK ACTIONS -->

                <div class="flex flex-wrap gap-2 sm:gap-3">

                    <a
                        href="{{ route('products.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-stone-900 hover:bg-stone-800 text-white text-sm font-medium px-4 py-2.5 transition shadow-sm">

                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>

                        New Product
                    </a>

                    <a
                        href="{{ route('stock-ins.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-white hover:bg-stone-50 text-stone-800 text-sm font-medium px-4 py-2.5 border border-stone-200 shadow-sm transition">

                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.073a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25v-4.073M12 3v12m0 0-3.75-3.75M12 15l3.75-3.75" />
                        </svg>

                        Record Stock In
                    </a>

                    <a
                        href="{{ route('stock-outs.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-white hover:bg-stone-50 text-stone-800 text-sm font-medium px-4 py-2.5 border border-stone-200 shadow-sm transition">

                        <svg class="w-4 h-4 text-orange-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 9.85v4.073a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25V9.85M12 15V3m0 0L8.25 6.75M12 3l3.75 3.75" />
                        </svg>

                        Record Stock Out
                    </a>

                </div>

            </div>

        </div>


        <!-- SUCCESS MESSAGE -->

        @if(session('success'))

        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm px-5 py-3.5 rounded-xl" role="status">

            {{ session('success') }}

        </div>

        @endif


        <!-- ============================= -->
        <!-- STATISTICS -->
        <!-- ============================= -->

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6">


            <!-- TOTAL PRODUCTS -->

            <div class="bg-white rounded-xl shadow-sm border border-stone-200/70 p-5 lg:p-6">

                <div class="flex items-start justify-between gap-3">

                    <div class="min-w-0">

                        <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">
                            Total Products
                        </p>

                        <p class="text-3xl font-bold text-stone-900 tabular-nums mt-2">
                            {{ $totalProducts }}
                        </p>

                    </div>

                    <span class="flex items-center justify-center w-11 h-11 rounded-xl bg-stone-900/5 text-stone-700 shrink-0" aria-hidden="true">

                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5 15.75 3m-8.836 14.25c-.046-.058-.101-.123-.144-.184a2.544 2.544 0 0 1-.364-1.364V7.697c0-.757.728-1.3 1.452-1.068l12.024 3.85a1.224 1.224 0 0 1 .806 1.145v8.726c0 1.058-.806 1.918-1.8 1.918h-1.8a1.8 1.8 0 0 1-1.8-1.8v-1.8a1.8 1.8 0 0 1 1.8-1.8h1.454M6 15.5V9.03a.75.75 0 0 1 .75-.75h11.25" />
                        </svg>

                    </span>

                </div>

            </div>


            <!-- TOTAL INGREDIENTS -->

            <div class="bg-white rounded-xl shadow-sm border border-stone-200/70 p-5 lg:p-6">

                <div class="flex items-start justify-between gap-3">

                    <div class="min-w-0">

                        <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">
                            Total Ingredients
                        </p>

                        <p class="text-3xl font-bold text-stone-900 tabular-nums mt-2">
                            {{ $totalIngredients }}
                        </p>

                    </div>

                    <span class="flex items-center justify-center w-11 h-11 rounded-xl bg-amber-500/10 text-amber-700 shrink-0" aria-hidden="true">

                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 14.5M14.25 3.104c.251.023.501.05.75.082M19.8 14.5l-1.57.393A2.25 2.25 0 0 1 16.5 15.75v3.375c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125v-3.375c0-.621-.504-1.125-1.125-1.125h-2.25A2.25 2.25 0 0 1 6.622 14.5L5 14.5m0 0v5.75c0 .621.504 1.125 1.125 1.125h11.25c.621 0 1.125-.504 1.125-1.125v-5.75" />
                        </svg>

                    </span>

                </div>

            </div>


            <!-- STOCK IN -->

            <div class="bg-white rounded-xl shadow-sm border border-stone-200/70 p-5 lg:p-6">

                <div class="flex items-start justify-between gap-3">

                    <div class="min-w-0">

                        <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">
                            Stock In Records
                        </p>

                        <p class="text-3xl font-bold text-emerald-700 tabular-nums mt-2">
                            {{ $totalStockIns }}
                        </p>

                    </div>

                    <span class="flex items-center justify-center w-11 h-11 rounded-xl bg-emerald-500/10 text-emerald-700 shrink-0" aria-hidden="true">

                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.073a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25v-4.073M12 3v12m0 0-3.75-3.75M12 15l3.75-3.75" />
                        </svg>

                    </span>

                </div>

            </div>


            <!-- STOCK OUT -->

            <div class="bg-white rounded-xl shadow-sm border border-stone-200/70 p-5 lg:p-6">

                <div class="flex items-start justify-between gap-3">

                    <div class="min-w-0">

                        <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">
                            Stock Out Records
                        </p>

                        <p class="text-3xl font-bold text-orange-700 tabular-nums mt-2">
                            {{ $totalStockOuts }}
                        </p>

                    </div>

                    <span class="flex items-center justify-center w-11 h-11 rounded-xl bg-orange-500/10 text-orange-700 shrink-0" aria-hidden="true">

                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 9.85v4.073a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25V9.85M12 15V3m0 0L8.25 6.75M12 3l3.75 3.75" />
                        </svg>

                    </span>

                </div>

            </div>


        </div>


        <!-- ============================= -->
        <!-- LOW STOCK ALERT -->
        <!-- ============================= -->

        @if($lowStockCount > 0)

        <section class="bg-red-50/60 border border-red-200 rounded-xl p-5 lg:p-6 mt-6" aria-label="Low stock alert">


            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">


                <div class="flex items-center gap-4">

                    <span class="flex items-center justify-center w-11 h-11 rounded-xl bg-red-500/10 text-red-700 shrink-0" aria-hidden="true">

                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>

                    </span>


                    <div>

                        <div class="flex flex-wrap items-center gap-2">

                            <h2 class="text-base sm:text-lg font-bold text-red-900">
                                Low Stock Alert
                            </h2>

                            <span class="inline-flex items-center rounded-full bg-red-600 text-white text-xs font-bold tabular-nums px-2.5 py-0.5">
                                {{ $lowStockCount }}
                            </span>

                        </div>


                        <p class="text-sm text-red-800 mt-1">

                            {{ $lowStockCount == 1
                                    ? '1 ingredient is'
                                    : $lowStockCount . ' ingredients are'
                                }}

                            running low on stock.

                        </p>

                    </div>

                </div>


                <a
                    href="{{ route('low-stock.index') }}"
                    class="inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 text-white text-sm px-5 py-2.5 rounded-lg font-medium text-center transition shrink-0">

                    View Low Stock

                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>

                </a>

            </div>


            <!-- LOW STOCK ITEMS -->

            <div class="mt-5 space-y-2">


                @foreach($lowStockIngredients as $ingredient)

                <div
                    class="bg-white border border-red-100 rounded-lg px-4 py-3 flex justify-between items-center gap-3">


                    <div class="min-w-0">

                        <p class="font-semibold text-stone-800 truncate">

                            {{ $ingredient->name }}

                        </p>


                        <p class="text-sm text-stone-500 tabular-nums">

                            Minimum:

                            {{ number_format(
                                        $ingredient->minimum_stock,
                                        2
                                    ) }}

                            {{ $ingredient->unit }}

                        </p>

                    </div>


                    <div class="text-right shrink-0">

                        <p class="font-bold text-red-700 tabular-nums">

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

        </section>


        @else


        <!-- NO LOW STOCK -->

        <section
            class="bg-emerald-50 border border-emerald-200 rounded-xl p-5 lg:p-6 mt-6"
            aria-label="Inventory status">

            <div class="flex items-center gap-4">

                <span class="flex items-center justify-center w-11 h-11 rounded-xl bg-emerald-500/10 text-emerald-700 shrink-0" aria-hidden="true">

                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                </span>


                <div>

                    <h2 class="text-base sm:text-lg font-bold text-emerald-900">

                        Inventory Status

                    </h2>


                    <p class="text-sm text-emerald-800 mt-0.5">

                        All ingredients have sufficient stock.

                    </p>

                </div>

            </div>

        </section>


        @endif


        <!-- ============================= -->
        <!-- RECENT PRODUCTS -->
        <!-- ============================= -->

        <section class="mt-6 lg:mt-8 bg-white rounded-xl shadow-sm border border-stone-200/70 overflow-hidden" aria-label="Recent products">


            <div class="px-5 lg:px-6 py-4 lg:py-5 border-b border-stone-200/70">

                <div class="flex items-center justify-between gap-3">

                    <div>

                        <h3 class="text-base sm:text-lg font-bold text-stone-900 tracking-tight">

                            Recent Products

                        </h3>

                        <p class="text-xs sm:text-sm text-stone-500 mt-0.5">
                            Latest items added to the catalog
                        </p>

                    </div>


                    <a
                        href="{{ route('products.index') }}"
                        class="text-sm text-amber-700 hover:text-amber-800 font-medium whitespace-nowrap">

                        View All &rarr;

                    </a>

                </div>

            </div>


            <!-- TABLE -->

            <div class="overflow-x-auto">

                <table class="w-full text-sm">


                    <thead class="bg-stone-50">

                        <tr class="text-left text-xs uppercase tracking-wider text-stone-500">

                            <th class="px-5 lg:px-6 py-3.5 font-semibold">
                                Product
                            </th>

                            <th class="px-5 lg:px-6 py-3.5 font-semibold">
                                Category
                            </th>

                            <th class="px-5 lg:px-6 py-3.5 font-semibold text-right tabular-nums">
                                Price
                            </th>

                            <th class="px-5 lg:px-6 py-3.5 font-semibold text-right tabular-nums">
                                Stock
                            </th>

                            <th class="px-5 lg:px-6 py-3.5 font-semibold">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-stone-100">


                        @php

                        $recentProducts =
                        \App\Models\Product::with('category')
                        ->latest()
                        ->take(5)
                        ->get();

                        @endphp


                        @forelse($recentProducts as $product)


                        <tr class="hover:bg-stone-50/70 transition">


                            <!-- PRODUCT -->

                            <td class="px-5 lg:px-6 py-4 font-medium text-stone-800 whitespace-nowrap">

                                {{ $product->name }}

                            </td>


                            <!-- CATEGORY -->

                            <td class="px-5 lg:px-6 py-4">

                                @if($product->category)

                                <span class="inline-flex items-center bg-stone-100 text-stone-700 px-2.5 py-1 rounded-full text-xs font-medium whitespace-nowrap">

                                    {{ $product->category->name }}

                                </span>

                                @else

                                <span class="inline-flex items-center bg-stone-100 text-stone-400 px-2.5 py-1 rounded-full text-xs font-medium whitespace-nowrap">

                                    No Category

                                </span>

                                @endif

                            </td>


                            <!-- PRICE -->

                            <td class="px-5 lg:px-6 py-4 text-right font-semibold text-stone-800 tabular-nums whitespace-nowrap">

                                &#8369;{{ number_format(
                                        $product->price,
                                        2
                                    ) }}

                            </td>


                            <!-- STOCK -->

                            <td class="px-5 lg:px-6 py-4 text-right text-stone-600 tabular-nums whitespace-nowrap">

                                {{ $product->stock }}

                            </td>


                            <!-- STATUS -->

                            <td class="px-5 lg:px-6 py-4 whitespace-nowrap">


                                @if($product->stock > 0)


                                <span
                                    class="inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 px-2.5 py-1 rounded-full text-xs font-semibold">

                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500" aria-hidden="true"></span>

                                    Available

                                </span>


                                @else


                                <span
                                    class="inline-flex items-center gap-1.5 bg-red-50 border border-red-200 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold">

                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500" aria-hidden="true"></span>

                                    Out of Stock

                                </span>


                                @endif


                            </td>


                        </tr>


                        @empty


                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-10 text-center text-stone-500 text-sm">

                                No products found.

                            </td>

                        </tr>


                        @endforelse


                    </tbody>

                </table>

            </div>

        </section>


    </main>


    <script>
        (function () {
            var toggle = document.getElementById('sidebarToggle');
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('sidebarOverlay');

            if (!toggle || !sidebar || !overlay) {
                return;
            }

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                toggle.setAttribute('aria-expanded', 'true');
            }

            function closeSidebar() {
                if (window.innerWidth >= 1024) {
                    return;
                }

                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                toggle.setAttribute('aria-expanded', 'false');
            }

            toggle.addEventListener('click', function () {
                if (sidebar.classList.contains('-translate-x-full')) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });

            overlay.addEventListener('click', closeSidebar);

            sidebar.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', closeSidebar);
            });
        })();
    </script>


</body>

</html>
