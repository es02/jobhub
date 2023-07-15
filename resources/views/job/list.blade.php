<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jobs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @if ($role === "Employer")
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Create new Job Listing') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                    {{ __('Click Here') }}
                                </x-nav-link>
                            </p>
                        </header>
                    </section>
                    @endif    
                </div>
            </div>
        </div>
    </div>

    <div class="items-center max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if ($count === 1)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                < 1 >
            </div>
        </div>
        @elseif ($count > 10)
            < 1 2 3 4 5 6 >
        @else
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                No Jobs Available.
            </div>
        </div>
        @endif
    </div>
</x-app-layout>