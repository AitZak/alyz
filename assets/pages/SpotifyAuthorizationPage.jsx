import React, {useContext, useState, useEffect  } from 'react';
import SpotifyAuthorization from "../services/SpotifyApi/SpotifyAuthorization";
import SpotifyWebApi from "spotify-web-api-js";
import UsersAPI from "../services/usersAPI";

const SpotifyAuthorizationPage = (props) => {
    const [loggedInSpotify, setLoggedInSpotify] = useState(false);
    const [userPlaylists, setUserPlaylists] = useState([]);

    const authentication_code = window.location.search.slice(6,-23);
    const token_spotify = localStorage.getItem('access-token-spotify');

    if (token_spotify) {
        setLoggedInSpotify(true);
    }

    if (!authentication_code) {
        window.location = 'http://localhost:8888';
    } else {
        getUserPlaylists();
    }

    async function getUserPlaylists () {
        try{
            const data_token = await SpotifyAuthorization.getToken(authentication_code);
            const data = await SpotifyAuthorization.getUserInfo(data_token);
            setUserPlaylists(data);
        } catch(error) {
            console.log(error.response);
        }
    }

    return (
        <>
            <h3>Connexion à spotify</h3>
            <a href='http://localhost:8888'>
                <button>Connexion</button>
            </a>

            <table>
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Nombre de music</th>
                </tr>
                </thead>
                <tbody>
                {userPlaylists.map((user, index) => <tr key={index}>
                    <td>{user.name}</td>
                    <td>{user.tracks.total}</td>
                </tr>)}
                </tbody>
            </table>

            {!loggedInSpotify && <>
                <p> vous n'etes pas connecté</p>
            </>||(
                <p> vous etes connecté</p>
                )}
        </>
    );
};

export default SpotifyAuthorizationPage;