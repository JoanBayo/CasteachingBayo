<x-casteaching-layout>
    <div class="px-4 sm:px-6 lg:px-8 mt-10">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Videos') }}
            </h2>
        </x-slot>
        <status></status>
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
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Videos</h3>
                        </div>
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">TITLE</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">DESCRIPTION</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">URL</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">ACTIONS</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($videos as $video)
                                @if($loop->odd)
                                    <tr class="bg-white">
                                @else
                                    <tr class="bg-gray-50">
                                @endif
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $video->id }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $video->title }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $video->description }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $video->url }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="/videos/{{$video->id}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Show</a>
                                       <a href="/manage/videos/{{$video->id}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form class="inline" action = "/manage/videos/{{$video->id}}" method = "POST">
                                            @csrf
                                            @method('DELETE')

                                            <a href="/videos/{{$video->id}}" class="text-indigo-600 hover:text-indigo-900"
                                               onclick="event.preventDefault();
                                               this.closest('form').submit();">
                                                Delete</a>
                                        </form>
                                    </td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-casteaching-layout>
