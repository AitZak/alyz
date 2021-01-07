import React, {useEffect, useState} from 'react'
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom'
import { useOAuth2Token, OAuthCallback } from 'react-oauth2-hook'
import env from "../env";

// in this example, we get a Spotify OAuth
// token and use it to show a user's saved
// tracks.

export default () => <Router>
    <Switch>
        <Route path="/callback" component={OAuthCallback}/>
        <Route component={SavedPlaylists}/>
    </Switch>
</Router>

const SavedPlaylists = () => {
    const [token, getToken] = useOAuth2Token({
        authorizeUrl: "https://accounts.spotify.com/authorize",
        scope: ["user-library-read"],
        clientID: env.SPOTIFY_CLIENT_ID,
        redirectUri: env.SPOTIFY_REDIRECT_URI
    })

    const [tracks, setTracks] = React.useState();
    const [error, setError] = React.useState();

    // query spotify when we get a token
    React.useEffect(() => {
        fetch(
            'https://api.spotify.com/v1/me/tracks?limit=50'
        ).then(response => response.json()).then(
            data => setTracks(data)
        ).catch(error => setError(error))
    }, [token])

    return <div>
        {error && `Error occurred: ${error}`}
        {(!token || !savedPlaylists) && <div
            onClick={getToken}>
            login with Spotify
        </div>}
        {savedPlaylists && `
      Your Saved Tracks: ${JSON.stringify(savedPlaylists)}
    `}
    </div>
}