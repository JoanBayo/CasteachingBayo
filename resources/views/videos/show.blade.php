<x-casteaching-layout>
    <div class="flex flex-col h-screen">
        <iframe
            class="md:p-3 lg:p-5 xl:px-10 xl:py-5 2xl:px-20 2xl:p-10 h-4/5"
            src="https://www.youtube.com/embed/6O4mPpj6rI8"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>

        <div class="p-4 lg:p-5 xl:px-10 xl:py-5 2xl:px-20 xl:py-20">
            {{ $video->title }}
        </div>
        <div class="p-4 lg:p-5 xl:p-10 xl:py-5 2xl:px-20 xl:py-20">
            {{ $video->description }}
        </div>
    </div>
</x-casteaching-layout>


