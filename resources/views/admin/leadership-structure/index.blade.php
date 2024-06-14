<x-app-layout>
    <x-tinymce.config />

    <div>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Struktur Kepemimpinan') }}
        </h2>
    </div>

    {{-- alert success --}}
    @if (session('success'))
        <x-alert :type="__('success')">{{ session('success') }}</x-alert>
    @endif

    <div class="py-4">
        <div class="max-w-7xl mx-auto space-y-6">
            <form method="post" action="{{ route('leadership-structure.upsert') }}" class="mt-6 space-y-6"
                enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="w-96 h-96 mb-3 mx-auto">
                    <img src="{{ asset('storage/' . $leadership_structure->image) }}" alt="" class="h-full">
                </div>

                <div class="mb-3">
                    <x-input-label for="image" :value="__('Upload Gambar Baru')" />
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="file_input" type="file" name="image">
                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                </div>

                <div>
                    <x-input-label for="content" :value="__('Deskripsi')" />
                    <x-tinymce.editor :name="__('description')" class="mt-1 block w-full" :value="__($leadership_structure->description)" />
                    <x-input-error class="mt-2" :messages="$errors->get('content')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
