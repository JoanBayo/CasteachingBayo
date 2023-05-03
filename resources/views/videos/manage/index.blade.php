<x-casteaching-layout>
<<<<<<< HEAD
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
=======
>>>>>>> main

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Videos') }}
        </h2>
    </x-slot>

    <div class="flex flex-col mt-10">

        <div class="mx-auto sm:px-6 lg:px-8 w-full max-w-7xl">
            <x-status></x-status>

            @can('videos_manage_create')
                <x-jet-form-section data-qa="form_video_create">
                    <x-slot name="title">
                        {{ __('Vídeos') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Informació bàsica del vídeo') }}
                    </x-slot>

                    <x-slot name="actions">
                        <x-jet-button>
                            {{ __('Save') }}
                        </x-jet-button>
                    </x-slot>

                    <x-slot name="form">
                        @csrf
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="title" value="{{ __('Title') }}" />
                            <x-jet-input id="title" name="title" type="text" class="mt-1 block w-full" autocomplete="name" required/>
                            <x-jet-input-error for="title" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="description" value="{{ __('Description') }}" />
                            <textarea required id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Description"></textarea>
                            <x-jet-input-error for="description" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="url" value="{{ __('URL') }}" />

                            <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    http://
                                    </span>
                                <input required type="url" name="url" id="url" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block  rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="youtube.com/">
                            </div>
                            <x-jet-input-error for="url" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="serie" value="{{ __('Serie') }}" />
                            <select id="serie" name="serie_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">-- Escolliu una serie --</option>
                                @foreach (App\Models\Serie::all() as $serie)
                                    <option value="{{ $serie->id }}"> {{ $serie->title }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="serie" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="user" value="{{ __('User') }}" />
                            <select id="user" name="user_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">-- Escolliu un usuari --</option>
                                @foreach (App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}"> {{ $user->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="user" class="mt-2" />
                        </div>




                        {{--                            <div class="px-4 py-5 space-y-6 sm:p-6">--}}

                        {{--                                <div>--}}
                        {{--                                    <label for="title" class="block text-sm font-medium text-gray-700">--}}
                        {{--                                        Title--}}
                        {{--                                    </label>--}}
                        {{--                                    <div class="mt-1">--}}
                        {{--                                        <input required type="text" id="title" name="title" rows="3" class="shadow-sm mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2" placeholder="Titol del vídeo"></input>--}}
                        {{--                                    </div>--}}
                        {{--                                    <p class="mt-2 text-sm text-gray-500">--}}
                        {{--                                        Titol curt del vídeo--}}
                        {{--                                    </p>--}}
                        {{--                                </div>--}}

                        {{--                                <div>--}}
                        {{--                                    <label for="description" class="block text-sm font-medium text-gray-700">--}}
                        {{--                                        Description--}}
                        {{--                                    </label>--}}
                        {{--                                    <div class="mt-1">--}}
                        {{--                                        <textarea required id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Description"></textarea>--}}
                        {{--                                    </div>--}}
                        {{--                                    <p class="mt-2 text-sm text-gray-500">--}}
                        {{--                                        Breu descripció del vídeo--}}
                        {{--                                    </p>--}}
                        {{--                                </div>--}}

                        {{--                                <div class="grid grid-cols-3 gap-6">--}}
                        {{--                                    <div class="col-span-3">--}}
                        {{--                                        <label for="url" class="block text-sm font-medium text-gray-700">--}}
                        {{--                                            URL--}}
                        {{--                                        </label>--}}
                        {{--                                        <div class="mt-1 flex rounded-md shadow-sm">--}}
                        {{--                                                      <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">--}}
                        {{--                                                        http://--}}
                        {{--                                                      </span>--}}
                        {{--                                            <input required type="url" name="url" id="url" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block  rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="youtube.com/">--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}


                        {{--                                <div class="grid grid-cols-3 gap-6">--}}
                        {{--                                    <div class="col-span-3">--}}
                        {{--                                        <label for="serie" class="block text-sm font-medium text-gray-700">--}}
                        {{--                                            Serie--}}
                        {{--                                        </label>--}}
                        {{--                                        <select id="serie" name="serie_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">--}}
                        {{--                                            <option value="">-- Escolliu una serie --</option>--}}
                        {{--                                            @foreach (App\Models\Serie::all() as $serie)--}}
                        {{--                                                <option value="{{ $serie->id }}"> {{ $serie->title }}</option>--}}
                        {{--                                            @endforeach--}}
                        {{--                                        </select>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}

                        {{--                                <div class="grid grid-cols-3 gap-6">--}}
                        {{--                                    <div class="col-span-3">--}}
                        {{--                                        <label for="user" class="block text-sm font-medium text-gray-700">--}}
                        {{--                                            User--}}
                        {{--                                        </label>--}}
                        {{--                                        <select id="user" name="user_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">--}}
                        {{--                                            <option value="">-- Escolliu un usuari --</option>--}}
                        {{--                                            @foreach (App\Models\User::all() as $user)--}}
                        {{--                                                <option value="{{ $user->id }}"> {{ $user->name }}</option>--}}
                        {{--                                            @endforeach--}}
                        {{--                                        </select>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}

                        {{--                            </div>--}}
                    </x-slot>
                </x-jet-form-section>


            @endcan

            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 mt-4">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Videos
                            </h3>
                        </div>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    URL
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Serie
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Usuari
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Odd row -->
                            @foreach($videos as $video)
                                @if($loop->odd)
                                    <tr class="bg-white">
                                @else
                                    <tr class="bg-gray-50">
<<<<<<< HEAD
                                @endif
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $video->id }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $video->title }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $video->description }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $video->url }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="/videos/{{$video->id}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Show</a>
                                       <a href="/manage/videos/{{$video->id}}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form class="inline" action = "/manage/videos/{{$video->id}}" method = "POST">
                                            @csrf
                                            @method('DELETE')
=======
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $video->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $video->title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $video->description }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $video->url }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ optional($video->serie)->title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ optional($video->user)->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="/videos/{{$video->id}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Show</a>
                                            <a href="/manage/videos/{{$video->id}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form class="inline" action="/manage/videos/{{$video->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
>>>>>>> main

                                                <a href="/videos/{{$video->id}}" class="text-indigo-600 hover:text-indigo-900"
                                                   onclick="event.preventDefault();
                                        this.closest('form').submit();">Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-casteaching-layout>
