<x-casteaching-layout>
    <div class="px-4 sm:px-6 lg:px-8 mt-10">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Videos') }}
            </h2>
        </x-slot>

        <x-status></x-status>
         @can('videos_manage_create')
            <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div>
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Vídeos</h3>
                                    <p class="mt-1 text-sm text-gray-600">Informació bàsica dels vídeos</p>
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2 md:mt-0">
                                <form data-qa="form_video_create" action="#" method="POST">
                                    @csrf
                                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                            <div>
                                                <label for="title" class="block text-sm font-medium text-gray-700">
                                                    Title
                                                </label>
                                                <div class="mt-1">
                                                    <input id="title" type="text" name="title" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Titol de exemple">
                                                </div>
                                                <p class="mt-2 text-sm text-gray-500">
                                                    Introduce a good title for your video
                                                </p>
                                            </div>

                                            <div>
                                                <label for="description" class="block text-sm font-medium text-gray-700">
                                                    Description
                                                </label>
                                                <div class="mt-1">
                                                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Description of the video"></textarea>
                                                </div>
                                                <p class="mt-2 text-sm text-gray-500">
                                                    Enter a good description so people know what the video is about.</p>
                                            </div>
                                            <div class="grid grid-cols-3 gap-6">
                                                <div class="col-span-3 sm:col-span-2">
                                                    <label for="url" class="block text-sm font-medium text-gray-700">
                                                        URL
                                                    </label>
                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">
                                            http://
                                        </span>
                                                        <input type="url" name="url" id="url" class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="www.example.com">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                Crear
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan


        <div id="vueapp">
            <videos-list></videos-list>
        </div>

    </div>
</x-casteaching-layout>
