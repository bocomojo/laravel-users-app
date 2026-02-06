<nav x-data="{ open: false }" class="bg-[#F58B1F] dark:bg-gray-800 border-b border-[#D97A1B] dark:border-gray-700 text-white">

    @php
        $modules = [
            [
                'label' => 'Liquidation Module',
                'submenu' => [
                    'label' => 'Liquidation Report',
                    'routes' => [
                        ['label' => 'Add', 'route' => 'liquidation.create'],
                        ['label' => 'View', 'route' => 'liquidation.index'],
                        ['label' => 'For Transmittal', 'route' => 'liquidation.for-transmittal'],
                    ]
                ]
            ],
            [
                'label' => 'Cash Advance Module',
                'submenu' => [
                    'label' => 'Cash Advance',
                    'routes' => [
                        ['label' => 'Add Cash Advance', 'route' => 'sdo.cash_advance.create'],
                        ['label' => 'View SDO', 'route' => 'sdo.cash_advance.index'],
                        ['label' => 'View Cash Advance', 'route' => 'sdo.cash_advance.cash_advances'],
                    ]
                ]
            ],
            [
                'label' => 'Pre-Auditor Module',
                'submenu' => [
                    'label' => 'Pre-Auditor',
                    'routes' => [
                        ['label' => 'Dashboard', 'route' => 'preaudit.dashboard'],
                        ['label' => 'View', 'route' => 'pre-auditors.index'],
                    ]
                ]
            ],
            [
                'label' => 'SDO Module',
                'submenus' => [
                    [
                        'label' => 'SDO Database',
                        'routes' => [
                            ['label' => 'Add', 'route' => 'sdo.create'],
                            ['label' => 'View', 'route' => 'sdo.index'],
                        ]
                    ],
                    [
                        'label' => 'Bonded Officials',
                        'routes' => [
                            ['label' => 'View', 'route' => 'sdo.bonded.index'],
                        ]
                    ]
                ]
            ],
            [
                'label' => 'Audit Findings',
                'submenus' => [
                    [
                        'label' => 'Compliance Tracking',
                        'routes' => [
                            ['label' => 'View', 'route' => 'sdo.compliance.index'],
                        ]
                    ],
                    [
                        'label' => 'Sent Items',
                        'routes' => [
                            ['label' => 'View', 'route' => 'gmail.sent'],
                        ]
                    ]
                ]
            ]
        ];
    @endphp

    <!-- Mobile Menu -->
    <div x-show="open" x-transition x-cloak class="sm:hidden bg-[#F58B1F] dark:bg-gray-800 border-t border-[#D97A1B] dark:border-gray-700">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700">
                Dashboard
            </a>

            @foreach ($modules as $mod)
                <div x-data="{ submenuOpen: false }">
                    <button @click="submenuOpen = !submenuOpen"
                        class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700">
                        {{ $mod['label'] }}
                        <svg :class="{ 'rotate-180': submenuOpen }"
                             class="ml-2 h-4 w-4 transition-transform duration-200"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="submenuOpen" x-transition x-cloak class="pl-4 space-y-1">
                        @if(isset($mod['submenu']))
                            @foreach ($mod['submenu']['routes'] as $link)
                                <a href="{{ route($link['route']) }}" class="block px-3 py-2 rounded-md text-sm text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700">
                                    {{ $link['label'] }}
                                </a>
                            @endforeach
                        @elseif(isset($mod['submenus']))
                            @foreach ($mod['submenus'] as $sub)
                                <span class="block px-3 py-2 font-medium text-white dark:text-gray-200">{{ $sub['label'] }}</span>
                                @foreach ($sub['routes'] as $link)
                                    <a href="{{ route($link['route']) }}" class="block pl-6 px-3 py-1 rounded-md text-sm text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700">
                                        {{ $link['label'] }}
                                    </a>
                                @endforeach
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach

            <!-- Settings -->
            <div x-data="{ submenuOpen: false }">
                <button @click="submenuOpen = !submenuOpen"
                        class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700">
                    {{ __('Settings') }}
                    <svg :class="{ 'rotate-180': submenuOpen }"
                        class="ml-2 h-4 w-4 transition-transform duration-200"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="submenuOpen" x-transition x-cloak class="pl-4 space-y-1">
                    <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded-md text-sm text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700">
                        {{ __('Users') }}
                    </a>
                    <a href="{{ route('pap.index') }}" class="block px-3 py-2 rounded-md text-sm text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700">
                        {{ __('PAP') }}
                    </a>
                </div>
            </div>

            <!-- Account -->
            <div class="border-t border-[#D97A1B] dark:border-gray-700 pt-4">
                <div class="px-3">
                    <div class="font-medium text-base text-white dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-white dark:text-gray-400">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-base font-medium text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700">
                        {{ __('Profile') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 text-base font-medium text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-white dark:text-gray-200" />
                    </a>
                </div>

                <!-- Main Navigation -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @foreach ($modules as $mod)
                        @php $modOpen = Str::slug($mod['label']) @endphp
                        <div x-data="{ open: false, submenuOpen: '' }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                            <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-white dark:text-gray-200 bg-[#F58B1F] dark:bg-gray-800 hover:bg-[#D97A1B] dark:hover:bg-gray-700 cursor-pointer rounded-md">
                                <span>{{ __($mod['label']) }}</span>
                                <svg :class="{ 'rotate-180': open }" class="ml-1 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </div>

                            <!-- Dropdowns -->
                            <div x-show="open" x-cloak x-transition class="absolute left-0 top-full mt-0 w-56 bg-[#F58B1F] dark:bg-gray-800 rounded-md shadow-lg z-50">
                                @if (isset($mod['submenu']))
                                    <div @mouseenter="submenuOpen = '{{ $modOpen }}'" @mouseleave="submenuOpen = ''" class="relative">
                                        <div class="flex items-center justify-between px-4 py-2 text-sm text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700 cursor-pointer">
                                            <span>{{ __($mod['submenu']['label']) }}</span>
                                            <svg :class="{ 'rotate-180': submenuOpen === '{{ $modOpen }}' }" class="ml-2 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div x-show="submenuOpen === '{{ $modOpen }}'" x-cloak class="absolute top-0 left-full w-40 bg-[#F58B1F] dark:bg-gray-800 rounded-md shadow-lg z-50">
                                            @foreach ($mod['submenu']['routes'] as $link)
                                                <a href="{{ route($link['route']) }}" class="block px-4 py-2 text-sm text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700 rounded">
                                                    {{ __($link['label']) }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif (isset($mod['submenus']))
                                    @foreach ($mod['submenus'] as $index => $sub)
                                        @php $subKey = $modOpen . $index @endphp
                                        <div @mouseenter="submenuOpen = '{{ $subKey }}'" @mouseleave="submenuOpen = ''" class="relative">
                                            <div class="flex items-center justify-between px-4 py-2 text-sm text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700 cursor-pointer">
                                                <span>{{ __($sub['label']) }}</span>
                                                <svg :class="{ 'rotate-180': submenuOpen === '{{ $subKey }}' }" class="ml-2 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div x-show="submenuOpen === '{{ $subKey }}'" x-cloak class="absolute top-0 left-full w-40 bg-[#F58B1F] dark:bg-gray-800 rounded-md shadow-lg z-50">
                                                @foreach ($sub['routes'] as $link)
                                                    <a href="{{ route($link['route']) }}" class="block px-4 py-2 text-sm text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700 rounded">
                                                        {{ __($link['label']) }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <!-- Settings -->
                    <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                        <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-white dark:text-gray-200 bg-[#F58B1F] dark:bg-gray-800 hover:bg-[#D97A1B] dark:hover:bg-gray-700 cursor-pointer rounded-md">
                            <span>{{ __('Settings') }}</span>
                            <svg :class="{ 'rotate-180': open }" class="ml-1 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div x-show="open" x-cloak x-transition class="absolute left-0 top-full mt-0 w-56 bg-[#F58B1F] dark:bg-gray-800 rounded-md shadow-lg z-50">
                            <a href="{{ route('users.index') }}" class="block px-4 py-2 text-sm text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700 rounded">{{ __('Users') }}</a>
                            <a href="{{ route('pap.index') }}" class="block px-4 py-2 text-sm text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700 rounded">{{ __('PAP') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Auth Dropdown (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-white dark:text-gray-200 bg-[#F58B1F] dark:bg-gray-800 hover:bg-[#D97A1B] dark:hover:bg-gray-700 cursor-pointer rounded-md">
                    <span>{{ Auth::user()->name }}</span>
                    <svg :class="{ 'rotate-180': open }" class="ml-1 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </div>

                <div x-show="open" x-cloak x-transition
                    class="absolute top-full right-0 mt-0 w-48 bg-[#F58B1F] dark:bg-gray-800 rounded-md shadow-lg z-50 py-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700 rounded">
                        {{ __('Profile') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-white dark:text-gray-200 hover:bg-[#D97A1B] dark:hover:bg-gray-700 rounded">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-[#D97A1B] dark:hover:bg-gray-700 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
