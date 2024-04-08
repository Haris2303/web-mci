<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Background') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="post" action="{{ route('background.store') }}" class="mt-6 space-y-6">
                @csrf

                <div>
                    <x-input-label for="update_password_password" :value="__('Content')" />
                    <x-text-input id="update_password_password" name="user_id" type="text" class="mt-1 block w-full"
                        autocomplete="new-password" value="{{ auth()->user()->id }}" />
                </div>

                <div>
                    <x-input-label for="update_password_password" :value="__('Content')" />
                    <x-text-input id="update_password_password" name="content" type="text" class="mt-1 block w-full"
                        autocomplete="new-password" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
