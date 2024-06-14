<x-app-layout>
    <x-tinymce.config />

    <div>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Kerja Sama') }}
        </h2>
    </div>

    {{-- alert success --}}
    @if (session('success'))
        <x-alert :type="__('success')">{{ session('success') }}</x-alert>
    @endif

    <div class="py-4">
        <div class="max-w-7xl mx-auto space-y-6">
            <form method="post" action="{{ route('cooperation.update', $cooperation->id) }}" class="mt-6 space-y-6"
                enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="w-96 h-96 mb-3 mx-auto">
                    <img src="{{ asset('storage/' . $cooperation->image) }}" alt="" class="h-full">
                    <input type="hidden" name="oldImage" value="{{ $cooperation->image }}">
                </div>

                <div class="mb-3">
                    <x-input-label for="image" :value="__('Upload Gambar')" />
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="file_input" type="file" name="image">
                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                </div>

                <div>
                    <x-input-label for="content" :value="__('Content')" />
                    <x-tinymce.editor class="mt-1 block w-full" :value="$cooperation->content" />
                    <x-input-error class="mt-2" :messages="$errors->get('content')" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
