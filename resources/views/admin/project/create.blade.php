<x-app-layout :title="$title">
    <x-tinymce.config />

    <div class="mb-10">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Project') }}
        </h2>
    </div>

    <div>
        <form class="mx-auto" method="POST" action="{{ route('project.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="title" id="title"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " />
                <label for="title"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div class="mb-3">
                <x-input-label for="image" :value="__('Upload Gambar')" />
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="file_input" type="file" name="image">
            </div>

            <div class="mb-3">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe
                    Project</label>
                <select id="countries" name="type"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Pilih tipe</option>
                    <option value="ukm">UKM</option>
                    <option value="devisi">Devisi</option>
                </select>
            </div>

            <div class="mb-3">
                <x-input-label for="content" :value="__('Deskripsi')" class="mb-2" />
                <x-tinymce.editor :name="__('description')" class="mt-1 block w-full" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Simpan') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
