<x-app-layout :title="$title">
    <x-tinymce.config />

    <div>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Visi Misi') }}
        </h2>
    </div>

    {{-- alert success --}}
    @if (session('success'))
        <x-alert :type="__('danger')">{{ session('success') }}</x-alert>
    @endif

    <div class="py-4">
        <div class="max-w-7xl mx-auto space-y-6">
            <form method="post" action="{{ route('vision-mision.upsert') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="content" :value="__('Content')" />
                    <x-tinymce.editor class="mt-1 block w-full" :value="__($content)" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
