import React, {useContext, useState, useEffect  } from 'react';
import SpotifyAuthorization from "../services/SpotifyApi/SpotifyAuthorization";

const SpotifyAuthorizationPage = (props) => {
    const [loggedInSpotify, setLoggedInSpotify] = useState("false");
    const [userPlaylists, setUserPlaylists] = useState([]);

    const authentication_code = window.location.search.slice(6,-23);
    const token_spotify = localStorage.getItem('access-token-spotify');


    if (!authentication_code) {
        if (loggedInSpotify === "false"){
            window.location = 'http://localhost:8888';
        }
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
            <h1 className="playlist_title">Vos Playlits Spotify</h1>
            <table>
                <tbody>
                {userPlaylists.map((user, index) => <tr key={index}>
                    <td><img alt="cover" src={user.images[0].url} width="200" height="200"/></td>
                    <td className="playlist_name text-center">{user.name}</td>
                    <br/>
                </tr>)}
                </tbody>
            </table>
        </>
    );
};

export default SpotifyAuthorizationPage;