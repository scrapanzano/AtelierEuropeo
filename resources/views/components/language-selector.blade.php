<div class="language-selector" x-data="{ open: false }">
    <div class="relative">
        <!-- Trigger Button -->
        <button 
            @click="open = !open" 
            class="flex items-center space-x-2 px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 rounded-md"
            aria-expanded="false"
        >
            <!-- Flag icon or language code -->
            <span class="flex items-center">
                @if($currentLocale === 'it')
                    <span class="fi fi-it mr-2 text-lg"></span>
                @else
                    <span class="fi fi-gb mr-2 text-lg"></span>
                @endif
                <span class="hidden sm:inline">{{ $availableLocales[$currentLocale] }}</span>
                <span class="sm:hidden">{{ strtoupper($currentLocale) }}</span>
            </span>
            <!-- Dropdown arrow -->
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <!-- Dropdown Menu -->
        <div 
            x-show="open" 
            @click.away="open = false"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50"
            style="display: none;"
        >
            <div class="py-1">
                @foreach($availableLocales as $locale => $name)
                    <a 
                        href="{{ route('lang.switch', $locale) }}" 
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $currentLocale === $locale ? 'bg-gray-50 font-medium' : '' }}"
                        @click="open = false"
                    >
                        @if($locale === 'it')
                            <span class="fi fi-it mr-3 text-lg"></span>
                        @else
                            <span class="fi fi-gb mr-3 text-lg"></span>
                        @endif
                        {{ $name }}
                        @if($currentLocale === $locale)
                            <svg class="w-4 h-4 ml-auto text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Simple version without flags (fallback) -->
<div class="language-selector-simple hidden">
    <div class="relative" x-data="{ open: false }">
        <button 
            @click="open = !open" 
            class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
            {{ strtoupper($currentLocale) }} ▼
        </button>
        
        <div 
            x-show="open" 
            @click.away="open = false"
            class="absolute right-0 mt-1 w-20 bg-white border border-gray-200 rounded-md shadow-lg z-50"
            style="display: none;"
        >
            @foreach($availableLocales as $locale => $name)
                @if($locale !== $currentLocale)
                    <a 
                        href="{{ route('lang.switch', $locale) }}" 
                        class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 text-center"
                        @click="open = false"
                    >
                        {{ strtoupper($locale) }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>

<style>
    /* Flag icons from flag-icons library (optional) */
    .fi {
        width: 1.5em;
        height: 1.125em;
        display: inline-block;
        background-size: cover;
        background-position: center;
        border-radius: 2px;
    }
    
    .fi-it {
        background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iOTAwIiBoZWlnaHQ9IjYwMCIgdmlld0JveD0iMCAwIDkwMCA2MDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIzMDAiIGhlaWdodD0iNjAwIiBmaWxsPSIjMDA5MjQ2Ii8+CjxyZWN0IHg9IjMwMCIgd2lkdGg9IjMwMCIgaGVpZ2h0PSI2MDAiIGZpbGw9IiNmZmZmZmYiLz4KPHJlY3QgeD0iNjAwIiB3aWR0aD0iMzAwIiBoZWlnaHQ9IjYwMCIgZmlsbD0iI2NlMmIzNyIvPgo8L3N2Zz4=');
    }
    
    .fi-gb {
        background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwMCIgaGVpZ2h0PSI2MDAiIHZpZXdCb3g9IjAgMCAxMjAwIDYwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjEyMDAiIGhlaWdodD0iNjAwIiBmaWxsPSIjMDEyMTY5Ii8+CjxwYXRoIGQ9Im0wLDBsNDAwLDIwMGw0MDAtMjAwbTQwMCwyMDBsNDAwLDIwMGwtNDAwLTIwMG0tODAwLDQwMGw0MDAtMjAwbTQwMCwyMDBsNDAwLTIwMCIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utd2lkdGg9IjY2Ii8+CjxwYXRoIGQ9Im0wLDBsNDAwLDIwMG00MDAtMjAwbDQwMCwyMDBtLTgwMCw0MDBsNDAwLTIwMG00MDAtMjAwbDQwMCwyMDAiIHN0cm9rZT0iI2MxMGEyNyIgc3Ryb2tlLXdpZHRoPSI0NCIvPgo8cGF0aCBkPSJtNjAwLDBsMCw2MDBtLTYwMC0zMDBsMTIwMCwwIiBzdHJva2U9IiNmZmYiIHN0cm9rZS13aWR0aD0iMTAwIi8+CjxwYXRoIGQ9Im02MDAsNDBsMCw1MjBtLTU2MC0yNjBsMTEyMCwwIiBzdHJva2U9IiNjMTBhMjciIHN0cm9rZS13aWR0aD0iNjAiLz4KPC9zdmc+');
    }
</style>