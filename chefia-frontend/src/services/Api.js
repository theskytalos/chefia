import axios from 'axios';

export default() => {
    return axios.create({
        baseURL: 'http://chefia.darlinton.net/chefia-api/view/',
        withCredentials: false,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    });
}