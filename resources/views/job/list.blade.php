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
                            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                @csrf
                            </form>

                            <form method="post" action="{{ route('job') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('put')

                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label for="description" :value="__('Description')" />
                                    <x-text-input id="description" name="description" type="description" class="mt-1 block w-full" :value="old('description')" required  />
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>  

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                                    @if (session('status') === 'job-created')
                                        <p
                                            x-data="{ show: true }"
                                            x-show="show"
                                            x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600"
                                        >{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                            </p>
                        </header>
                    </section>
                    @endif    
                </div>
            </div>
        </div>
    </div>

    <div class="items-center max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if ($count > 0)
            @foreach ($jobs as $job)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <b>{{ $job->name }}</b> - {{ $job->description }}
                    </div>
                </div>
            @endforeach    
        @endif
        @if ($count === 1 )
        <div class="bg-white max-w-2xl overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                < 1 >
            </div>
        </div>
        @elseif ($count > 1)
            < 1 2 3 4 5 6 >
        @else
        <div class="bg-white max-w-2xl overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                < 1 >
            </div>
        </div>
        @endif
    </div>
</x-app-layout>