<x-casteaching-layout>
    <div class="px-4 sm:px-6 lg:px-8 mt-10">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Videos') }}
            </h2>
        </x-slot>

        <div id="vueapp">
            <status></status>

            <div id="app">
                @can('videos_manage_create')
                    <video-form></video-form>
                @endcan

                    <videos-list></videos-list>
            </div>
        </div>
    </div>
</x-casteaching-layout>

