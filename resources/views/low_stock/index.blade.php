<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Low Stock - Coffee Shop Inventory</title>
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
            class="p-2 rounded-lg hover:bg-white/10 focus:outline-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500">
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
                class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-stone-300 hover:bg-white/5 hover:text-white transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('products.index') }}"
                class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-stone-300 hover:bg-white/5 hover:text-white transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5 15.75 3m-8.836 14.25c-.046-.058-.101-.123-.144-.184a2.544 2.544 0 0 1-.364-1.364V7.697c0-.757.728-1.3 1.452-1.068l12.024 3.85a1.224 1.224 0 0 1 .806 1.145v8.726c0 1.058-.806 1.918-1.8 1.918h-1.8a1.8 1.8 0 0 1-1.8-1.8v-1.8a1.8 1.8 0 0 1 1.8-1.8h1.454M6 15.5V9.03a.75.75 0 0 1 .75-.75h11.25" />
                </svg>
                Products
            </a>
            <a href="{{ route('categories.index') }}"
                class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-stone-300 hover:bg-white/5 hover:text-white transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>
                Categories
            </a>
            <a href="{{ route('ingredients.index') }}"
                class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-stone-300 hover:bg-white/5 hover:text-white transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 14.5M14.25 3.104c.251.023.501.05.75.082M19.8 14.5l-1.57.393A2.25 2.25 0 0 1 16.5 15.75v3.375c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125v-3.375c0-.621-.504-1.125-1.125-1.125h-2.25A2.25 2.25 0 0 1 6.622 14.5L5 14.5m0 0v5.75c0 .621.504 1.125 1.125 1.125h11.25c.621 0 1.125-.504 1.125-1.125v-5.75" />
                </svg>
                Ingredients
            </a>
            <a href="{{ route('stock-ins.index') }}"
                class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-stone-300 hover:bg-white/5 hover:text-white transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.073a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25v-4.073M12 3v12m0 0-3.75-3.75M12 15l3.75-3.75" />
                </svg>
                Stock In
            </a>
            <a href="{{ route('stock-outs.index') }}"
                class="flex items-center gap-3 rounded-lg px-4 py-2.5 text-stone-300 hover:bg-white/5 hover:text-white transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 9.85v4.073a2.25 2.25 0 0 1-2.25 2.25h-12a2.25 2.25 0 0 1-2.25-2.25V9.85M12 15V3m0 0L8.25 6.75M12 3l3.75 3.75" />
                </svg>
                Stock Out
            </a>
            <a href="{{ route('low-stock.index') }}"
                aria-current="page"
                class="flex items-center gap-3 rounded-lg bg-white/10 px-4 py-2.5 text-white border-l-2 border-amber-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500">
                <svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                Low Stock
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
                    class="flex items-center gap-3 w-full rounded-lg px-4 py-2.5 text-sm font-medium text-red-400 hover:bg-white/5 hover:text-red-300 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-400">
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
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 lg:mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight">
                    Low Stock
                </h1>
                <p class="text-sm text-stone-500 mt-1 tabular-nums">
                    {{ $lowStockIngredients->count() }} {{ $lowStockIngredients->count() == 1 ? 'ingredient needs' : 'ingredients need' }} restocking
                </p>
            </div>
            <div class="flex gap-2 sm:gap-3">
                <a
                    href="{{ route('ingredients.create') }}"
                    class="inline-flex items-center gap-2 bg-stone-900 hover:bg-stone-800 text-white text-sm font-medium px-4 sm:px-5 py-2.5 rounded-lg transition shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:ring-offset-2 focus-visible:ring-offset-stone-100">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add Ingredient
                </a>
            </div>
        </div>
        <!-- Alert Summary -->
        <div class="bg-red-50/60 border border-red-200 rounded-xl px-5 py-4 mb-6 flex items-center gap-3" role="status">
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-red-500/10 text-red-700 shrink-0" aria-hidden="true">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </span>
            <div>
                <h2 class="text-sm sm:text-base font-bold text-red-900">
                    Low Stock Warning
                </h2>
                <p class="text-xs sm:text-sm text-red-800 tabular-nums">
                    {{ $lowStockIngredients->count() }}
                    {{ $lowStockIngredients->count() == 1 ? 'ingredient needs' : 'ingredients need' }}
                    to be restocked.
                </p>
            </div>
        </div>
        <!-- Table -->
        <section class="bg-white rounded-xl shadow-sm border border-stone-200/70 overflow-hidden" aria-label="Low stock ingredients">
            <div class="px-5 lg:px-6 py-4 lg:py-5 border-b border-stone-200/70">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <h2 class="text-base sm:text-lg font-bold text-stone-900 tracking-tight">
                            Restock List
                        </h2>
                        <p class="text-xs sm:text-sm text-stone-500 mt-0.5">
                            Ingredients at or below their minimum stock level
                        </p>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-stone-50">
                        <tr class="text-left text-xs uppercase tracking-wider text-stone-500">
                            <th class="px-5 lg:px-6 py-3.5 font-semibold tabular-nums">
                                ID
                            </th>
                            <th class="px-5 lg:px-6 py-3.5 font-semibold">
                                Ingredient
                            </th>
                            <th class="px-5 lg:px-6 py-3.5 font-semibold text-right tabular-nums">
                                Current Stock
                            </th>
                            <th class="px-5 lg:px-6 py-3.5 font-semibold text-right tabular-nums">
                                Minimum Stock
                            </th>
                            <th class="px-5 lg:px-6 py-3.5 font-semibold">
                                Unit
                            </th>
                            <th class="px-5 lg:px-6 py-3.5 font-semibold">
                                Status
                            </th>
                            <th class="px-5 lg:px-6 py-3.5 font-semibold">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse($lowStockIngredients as $ingredient)
                        <tr class="hover:bg-red-50/50 transition">
                            <!-- ID -->
                            <td class="px-5 lg:px-6 py-4 text-xs text-stone-400 tabular-nums whitespace-nowrap">
                                #{{ $ingredient->id }}
                            </td>
                            <!-- Ingredient -->
                            <td class="px-5 lg:px-6 py-4 min-w-44">
                                <div class="font-semibold text-stone-800">
                                    {{ $ingredient->name }}
                                </div>
                                @if($ingredient->description)
                                <div class="text-xs sm:text-sm text-stone-500 truncate max-w-56">
                                    {{ $ingredient->description }}
                                </div>
                                @endif
                            </td>
                            <!-- Current Stock -->
                            <td class="px-5 lg:px-6 py-4 text-right font-bold text-red-700 tabular-nums whitespace-nowrap">
                                {{ number_format($ingredient->stock, 2) }}
                            </td>
                            <!-- Minimum Stock -->
                            <td class="px-5 lg:px-6 py-4 text-right text-stone-600 tabular-nums whitespace-nowrap">
                                {{ number_format($ingredient->minimum_stock, 2) }}
                            </td>
                            <!-- Unit -->
                            <td class="px-5 lg:px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center bg-stone-100 text-stone-600 px-2.5 py-1 rounded-full text-xs font-medium whitespace-nowrap">
                                    {{ $ingredient->unit }}
                                </span>
                            </td>
                            <!-- Status -->
                            <td class="px-5 lg:px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 bg-red-50 border border-red-200 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500" aria-hidden="true"></span>
                                    Low Stock
                                </span>
                            </td>
                            <!-- Action -->
                            <td class="px-5 lg:px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('ingredients.edit', $ingredient) }}"
                                    aria-label="Edit {{ $ingredient->name }}"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-stone-200 bg-white hover:bg-stone-50 text-stone-700 text-xs sm:text-sm font-medium px-3 py-2 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-600 focus-visible:ring-offset-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                    </svg>
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td
                                colspan="7"
                                class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <span class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-600" aria-hidden="true">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="font-semibold text-stone-800">
                                            No Low Stock Ingredients
                                        </p>
                                        <p class="text-sm text-stone-500 mt-1">
                                            All ingredients are currently above their minimum stock level.
                                        </p>
                                    </div>
                                </div>
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
