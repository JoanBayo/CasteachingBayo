import axios from 'axios'

// TOKEN 4dtQl58nAQ6ciWW04BHdQCav2WbMnspuJnHjGYrO
const apiClinet = axios.create({
    baseURL: 'http://casteachingbayo.test/api',
    withCredentials : true,
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        Authorization: 'Bearer 4dtQl58nAQ6ciWW04BHdQCav2WbMnspuJnHjGYrO'
    }
})



export default {
    videos: async function() {
        const response = await apiClinet.get(' /videos')
        return response.data
    },
    video: {
        show: async function(id) {
            const response = await apiClinet.get(' /videos/' + id)
            return response.data
        },
        create: async function(data) {
            const response = await apiClinet.post(' /videos',data)
            return response.data
        },
        update: async function(id, data) {
            const response = await apiClinet.put(' /videos/'+ id,data)
            return response.data
        },
        destroy: async function(id) {
            const response = await apiClinet.delete(' /videos/' + id)
            return response.data
        },
    }
}
