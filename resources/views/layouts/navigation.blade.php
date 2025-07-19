<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Main Navigation Modules -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">

                    @php
                        $modules = [
                            [
                                'label' => 'Liquidation Module',
                                'submenu' => [
                                    'label' => 'Liquidation Report',
                                    'routes' => [
                                        ['label' => 'Add', 'route' => 'liquidation.create'],
                                        ['label' => 'View', 'route' => 'liquidation.index'],
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
                                        ['label' => 'Add', 'route' => 'sdo.cash_advance.create'],
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
                                            ['label' => 'Add', 'route' => 'sdo.bonded.create'],
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
                                            ['label' => 'Add', 'route' => 'sdo.compliance.create'],
                                            ['label' => 'View', 'route' => 'sdo.compliance.index'],
                                        ]
                                    ],
                                    [
                                        'label' => 'Documents',
                                        'routes' => [
                                            ['label' => 'Add', 'route' => 'pdf.upload'],
                                            ['label' => 'View', 'route' => 'documents.index'],
                                        ]
                                    ]
                                ]
                            ]
                        ];
                    @endphp

                    @foreach ($modules as $mod)
                        @php $modOpen = Str::slug($mod['label']) @endphp
                        <div x-data="{ open: false, submenuOpen: '' }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                            <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 cursor-pointer">
                                <span>{{ __($mod['label']) }}</span>
                                <svg :class="{ 'rotate-180': open }" class="ml-1 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </div>

                            <div x-show="open" x-cloak x-transition class="absolute left-0 top-full mt-0 w-56 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50">
                                @if (isset($mod['submenu']))
                                    <div @mouseenter="submenuOpen = '{{ $modOpen }}'" @mouseleave="submenuOpen = ''" class="relative">
                                        <div class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <span>{{ __($mod['submenu']['label']) }}</span>
                                            <svg :class="{ 'rotate-180': submenuOpen === '{{ $modOpen }}' }" class="ml-2 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div x-show="submenuOpen === '{{ $modOpen }}'" x-cloak class="absolute top-0 left-full w-40 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50">
                                            @foreach ($mod['submenu']['routes'] as $link)
                                                <a href="{{ route($link['route']) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    {{ __($link['label']) }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif (isset($mod['submenus']))
                                    @foreach ($mod['submenus'] as $index => $sub)
                                        @php $subKey = $modOpen . $index @endphp
                                        <div @mouseenter="submenuOpen = '{{ $subKey }}'" @mouseleave="submenuOpen = ''" class="relative">
                                            <div class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <span>{{ __($sub['label']) }}</span>
                                                <svg :class="{ 'rotate-180': submenuOpen === '{{ $subKey }}' }" class="ml-2 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div x-show="submenuOpen === '{{ $subKey }}'" x-cloak class="absolute top-0 left-full w-40 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50">
                                                @foreach ($sub['routes'] as $link)
                                                    <a href="{{ route($link['route']) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
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
                        <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 cursor-pointer">
                            <span>{{ __('Settings') }}</span>
                            <svg :class="{ 'rotate-180': open }" class="ml-1 h-4 w-4 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.18l3.71-3.95a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div x-show="open" x-cloak x-transition class="absolute left-0 top-full mt-0 w-56 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50">
                            <a href="{{ route('users.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">{{ __('Users') }}</a>
                            <a href="{{ route('pap.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">{{ __('PAP') }}</a>
                            <a href="{{ route('pre-auditors.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">{{ __('Pre-Auditors') }}</a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Auth Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
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
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
