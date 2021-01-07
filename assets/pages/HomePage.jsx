import React from 'react';
import {Helmet} from "react-helmet";
import "../styles/homepage.css"

const HomePage = () => {
    return (

<div >
    <Helmet>
        <title>Musicalyz - Regroupez toutes vos playlists </title>
        <meta name="description" content="Centraliser et transférer vos playlists d’une plateforme musicale à une autre ! Musicalyz facilite le transfert de vos playlists favorites Spotify et Deezer." />
        <link rel="image_src" type="image/png" href="/images/banner1.png" />
        <meta name="author" content="Musicalyz" />
        <meta name="keywords" content="Musicalyz, Plateforme, Musicalys,musique, music, playlist, Centraliser ces playlists, Importer ses playlists,partager ses playlists, Spotify, Deezer" />
        <meta name="robots" content="all" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

    </Helmet>
        <div className="row padding homepage_title">

            <div className="col-8 style_font">Music Playlist</div>
            <div className="w-100"></div>
            <div className="col "><h1>Musicalyz - plateforme de playlist</h1></div>
            <div className="w-100"></div>
            <div className="col">

                <a href="https://www.facebook.com/Musicalyz-100135015386624" target="_blank" className="btn-social btn-lg"><i className="fa fa-facebook"></i></a>

                <a href="https://twitter.com/Musicalyz1" target="_blank" className="btn-social btn-lg"><i className="fa fa-twitter"></i></a>

                <a href="https://t.co/grdkuKQF92?amp=1" target="_blank" className="btn-social btn-lg"><i className="fa fa-instagram"></i></a>

                <a href="https://www.youtube.com/channel/UCMZO36-OoRl4xEdLQ27XrNA/featured" target="_blank" className="btn-social btn-lg"><i className="fa fa-youtube"></i></a>
            </div>
        </div>
</div>
    );
};

export default HomePage;
