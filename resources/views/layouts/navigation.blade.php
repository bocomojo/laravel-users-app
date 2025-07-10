    <nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6 mt-1">
                        <div x-data="{ open: false, submenuOpen: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                            <!-- Main Dropdown Trigger -->
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                            >
                                {{ __('Liquidation Module') }}
                                <svg :class="{ 'rotate-180': open }" class="ml-1 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Main Dropdown Content -->
                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute mt-2 w-56 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50"
                            >
                                <!-- Submenu Trigger -->
                                <div
                                    class="relative flex items-center justify-between px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                    @mouseenter="submenuOpen = true"
                                    @mouseleave="submenuOpen = false"
                                >
                                    <span>{{ __('Liquidation Report') }}</span>
                                    <svg :class="{ 'rotate-180': submenuOpen }" class="ml-2 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>

                                    <!-- Submenu Content -->
                                    <div
                                        x-show="submenuOpen"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute top-0 left-full w-40 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50"
                                    >
                                        <a href="{{ route('sdo.cash_advance.create') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            {{ __('Add') }}
                                        </a>
                                        <a href="{{ route('sdo.cash_advance.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            {{ __('View') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div x-data="{ open: false, submenuOpen: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                            <!-- Main Dropdown Trigger -->
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                            >
                                {{ __('Cash Advance Module') }}
                                <svg :class="{ 'rotate-180': open }" class="ml-1 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Main Dropdown Content -->
                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute mt-2 w-56 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50"
                            >
                                <!-- Submenu Trigger -->
                                <div
                                    class="relative flex items-center justify-between px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                    @mouseenter="submenuOpen = true"
                                    @mouseleave="submenuOpen = false"
                                >
                                    <span>{{ __('Cash Advance') }}</span>
                                    <svg :class="{ 'rotate-180': submenuOpen }" class="ml-2 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>

                                    <!-- Submenu Content -->
                                    <div
                                        x-show="submenuOpen"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute top-0 left-full w-40 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50"
                                    >
                                        <a href="{{ route('sdo.cash_advance.create') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            {{ __('Add') }}
                                        </a>
                                        <a href="{{ route('sdo.cash_advance.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            {{ __('View') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div x-data="{ open: false, submenuOpen: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                            <!-- Main Dropdown Trigger -->
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                            >
                                {{ __('SDO Module') }}
                                <svg :class="{ 'rotate-180': open }" class="ml-1 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Main Dropdown Content -->
                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute mt-2 w-56 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50"
                            >
                                <!-- Submenu Trigger -->
                                <div
                                    class="relative flex items-center justify-between px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                    @mouseenter="submenuOpen = true"
                                    @mouseleave="submenuOpen = false"
                                >
                                    <span>{{ __('SDO Database') }}</span>
                                    <svg :class="{ 'rotate-180': submenuOpen }" class="ml-2 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>

                                    <!-- Submenu Content -->
                                    <div
                                        x-show="submenuOpen"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute top-0 left-full w-40 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50"
                                    >
                                        <a href="{{ route('sdo.cash_advance.create') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            {{ __('Add') }}
                                        </a>
                                        <a href="{{ route('sdo.cash_advance.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            {{ __('View') }}
                                        </a>
                                    </div>
                                </div>
                                <div
                                    class="relative flex items-center justify-between px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                    @mouseenter="submenuOpen = true"
                                    @mouseleave="submenuOpen = false"
                                >
                                    <span>{{ __('Bonded Officials') }}</span>
                                    <svg :class="{ 'rotate-180': submenuOpen }" class="ml-2 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>

                                    <!-- Submenu Content -->
                                    <div
                                        x-show="submenuOpen"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute top-0 left-full w-40 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50"
                                    >
                                        <a href="{{ route('sdo.cash_advance.create') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            {{ __('Add') }}
                                        </a>
                                        <a href="{{ route('sdo.cash_advance.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            {{ __('View') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div x-data="{ open: false, submenuOpen: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                            <!-- Main Dropdown Trigger -->
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                            >
                                {{ __('Audit Findings') }}
                                <svg :class="{ 'rotate-180': open }" class="ml-1 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Main Dropdown Content -->
                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute mt-2 w-56 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50"
                            >
                                <!-- Submenu Trigger -->
                                <div
                                    class="relative flex items-center justify-between px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                    @mouseenter="submenuOpen = true"
                                    @mouseleave="submenuOpen = false"
                                >
                                    <span>{{ __('Compliance Tracking') }}</span>
                                    <svg :class="{ 'rotate-180': submenuOpen }" class="ml-2 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>

                                    <!-- Submenu Content -->
                                    <div
                                        x-show="submenuOpen"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute top-0 left-full w-40 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50"
                                    >
                                        <a href="{{ route('sdo.cash_advance.create') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            {{ __('Add') }}
                                        </a>
                                        <a href="{{ route('sdo.cash_advance.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            {{ __('View') }}
                                        </a>
                                    </div>
                                </div>
                                <div
                                    class="relative flex items-center justify-between px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                    @mouseenter="submenuOpen = true"
                                    @mouseleave="submenuOpen = false"
                                >
                                    <span>{{ __('Documents') }}</span>
                                    <svg :class="{ 'rotate-180': submenuOpen }" class="ml-2 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>

                                    <!-- Submenu Content -->
                                    <div
                                        x-show="submenuOpen"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute top-0 left-full w-40 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50"
                                    >
                                        <a href="{{ route('sdo.cash_advance.create') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            {{ __('Add') }}
                                        </a>
                                        <a href="{{ route('sdo.cash_advance.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            {{ __('View') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Settings Dropdown -->
                    <!-- <div class="hidden sm:flex sm:items-center sm:ms-6 mt-1"> -->
                        <x-dropdown align="left">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    {{ __('Settings') }}
                                    <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('users.index')">
                                    {{ __('Users') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('pap.index')">
                                    {{ __('PAP') }}
                                </x-dropdown-link>
                                    <!-- <x-dropdown-link :href="route('documents.index')">
                                        {{ __('Transaction Type') }}
                                    </x-dropdown-link> -->
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48             ">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <!-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link> -->
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    {{ __('Users') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user_files')" :active="request()->routeIs('user_files')">
                    {{ __('Audit Findings') }}  
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('liquidation.index')" :active="request()->routeIs('liquidation.index')">
                    {{ __('Liquidations') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sdo.index')" :active="request()->routeIs('sdo.*')">
                    {{ __('Cash Advance') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sdo.index')" :active="request()->routeIs('sdo.*')">
                    {{ __('SDO Database') }}
                </x-responsive-nav-link>
                <x-dropdown-link :href="route('sdo.bonded.index')" :active="request()->routeIs('sdo.*')">
                    {{ __('Bonded Officials') }}
                </x-dropdown-link>
                <x-responsive-nav-link :href="route('sdo.compliance.index')" :active="request()->routeIs('sdo.*')">
                    {{ __('Compliance Tracking') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pdf.upload')">
                    {{ __('Upload File') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('documents.index')">
                    {{ __('View File Records') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
