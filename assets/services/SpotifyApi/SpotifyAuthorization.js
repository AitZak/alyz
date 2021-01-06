import axios from 'axios';

let client_id = '';
let client_secret = '';
let redirection_uri = '';

function getUserAuthorization() {
    return axios.get('https://accounts.spotify.com/authorize?client_id=?' + client_id + 'response_type=code?redirect_uri=' + redirection_uri)
        .then(response => console.log(response))

}

function getToken() {
    return axios.post('https://accounts.spotify.com/api/token', {
        headers: {

        },
        params: {
            grant_type: "authorization_code",
            code: "code",
            client_id: client_id,
            client_secret: client_secret,
        }
    });
}

function refreshToken() {
    return axios.post('https://accounts.spotify.com/api/token', {
        headers: {

        },
        params: {
            grant_type: "authorization_code",
            code: "code",
            client_id: client_id,
            client_secret: client_secret,
        }
    })

}

export default {
    getUserAuthorization,
};