import React from 'react';
import "../styles/homepage.css"

const HomePage = () => {
    return (
        <div className="row padding homepage_title">
            <div className="col-8 style_font">Music Playlist</div>
            <div className="w-100"></div>
            <div className="col ">Bienvenue sur MALYZ</div>
            <div className="w-100"></div>
            <div className="col">

                <a href="#" target="_blank" className="btn-social btn-lg"><i className="fa fa-facebook"></i></a>

                <a href="#" target="_blank" className="btn-social btn-lg"><i className="fa fa-twitter"></i></a>

                <a href="#" target="_blank" className="btn-social btn-lg"><i className="fa fa-instagram"></i></a>

                <a href="#" target="_blank" className="btn-social btn-lg"><i className="fa fa-google-plus"></i></a>
            </div>
        </div>
    );
};

export default HomePage;