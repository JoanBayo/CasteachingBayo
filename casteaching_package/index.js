import axios from 'axios'
export default {
    videos: async function() {
        const response = await axios.get('http://casteachingbayo.test/api/videos')
        return response.data
    }
}
