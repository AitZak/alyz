import axios from 'axios';
import qs from 'qs';
import env from "../../env";

let client_id = env.SPOTIFY_CLIENT_ID;
let client_secret = env.SPOTIFY_CLIENT_SECRET;

let nowDate = new Date();


function getUserAuthorization() {
    return axios.get('https://accounts.spotify.com/authorize?client_id=' + client_id + '&response_type=code&redirect_uri=' + redirection_uri)
        .then(result => console.log(result.config.url))
}

function generateToken(code) {
    return axios({
        method: 'post',
        url: 'https://accounts.spotify.com/api/token',
        data: qs.stringify({
            grant_type: "authorization_code",
            code: code,
            client_id: client_id,
            client_secret: client_secret,
            redirect_uri: 'http://localhost/#/'
        }),
        headers: {
            'content-type': 'application/x-www-form-urlencoded;charset=utf-8'
        }

    }).then(response => {
        let expiration_date_token_spotify = new Date(nowDate.setSeconds(nowDate.getSeconds() + response.data.expires_in) );

        localStorage.setItem('access_token_spotify', response.data.access_token);
        localStorage.setItem('refesh_token_spotify', response.data.refresh_token);
        localStorage.setItem('expiration_date_token_spotify', expiration_date_token_spotify);
        }
    );
}

function refreshToken() {
    let refresh_token = localStorage.getItem('refresh_token_spotify');
    
    return axios.post('https://accounts.spotify.com/api/token', {
        headers: {},
        params: {
            grant_type: "refresh_token",
            refresh_token: refresh_token,
            client_id: client_id,
            client_secret: client_secret,
        }
    }).then(response => {
        let expiration_date_token_spotify = new Date(nowDate.setSeconds(nowDate.getSeconds() + response.data.expires_in) );

        localStorage.setItem('access_token_spotify', response.data.access_token);
        localStorage.setItem('expiration_date_token_spotify', expiration_date_token_spotify);
    })

}

function getToken(code) {
    let refresh_token_spotify = localStorage.getItem('refresh_token_spotify');
    if (!refresh_token_spotify) {
        generateToken(code);
    } else {
        refreshToken();
    }

    return localStorage.getItem('access_token_spotify');
}

function dateParser(strDate){
    return new Date(strDate);
}


function getUserInfo(token) {
    return axios.get('https://api.spotify.com/v1/me/playlists', {
        headers: {
            Authorization: 'Bearer ' + token
        },
    }).then(response => {
        let playlists;
        // console.log(response.data.items);
        return playlists =  response.data.items;
    })

}

export default {
    getUserAuthorization,
    getUserInfo,
    getToken,
    refreshToken,
};