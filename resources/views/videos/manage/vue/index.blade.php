<x-casteaching-layout>
    <div class="px-4 sm:px-6 lg:px-8 mt-10">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Videos') }}
            </h2>
        </x-slot>

        <div class="flex flex-col mt-10 " id="vueapp">
            <div class="mx-auto sm:px-6 lg:px-8 w-full max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                <status></status>
            @can('videos_manage_create')
                    <video-form></video-form>
                @endcan

                    <videos-list></videos-list>
                </div>
             </div>
        </div>
    </div>
</x-casteaching-layout>

