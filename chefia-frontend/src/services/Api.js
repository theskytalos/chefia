import axios from 'axios';

export default() => {
    return axios.create({
        baseURL: 'http://esaojoao.com.br/chefia-api-v2/view/',
        withCredentials: false,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    });
}