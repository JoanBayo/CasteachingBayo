<template>
    <div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                 Videos
                                <button @click="refresh" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Refresh
                                </button>
                            </h3>
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
                            <tr class="bg-white" v-for="video in videos">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ video.id }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ video.title }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ video.description }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ video.url }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <video-show-link :video="video"></video-show-link>
                                    <video-edit-link :video="video"></video-edit-link>
                                    <video-destroy-link :video="video" @removed="refresh()"></video-destroy-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import VideoShowLink from "./VideoShowLink.vue";
import VideoEditLink from "./VideoEditLink.vue";
import VideoDestroyLink from "./VideoDestroyLink.vue";
import bus from '../bus.js'
export default {
    name: "VideosList",
    components: {
        'video-show-link': VideoShowLink,
        'video-edit-link': VideoEditLink,
        'video-destroy-link': VideoDestroyLink
    },
    data() {
        return {
            videos: []
        }
    },
    async created() {
        await this.getVideos()
        bus.$on('created', async () => {
            await this.refresh()
        });
        await this.getVideos()
        bus.$on('updated', async () => {
            await this.refresh()
        });
    },
    methods: {
        async getVideos(){
            this.videos = await window.api.videos()

        },
        async refresh(){
            await this.getVideos()
        }
    }

}
</script>

<style scoped>

</style>
