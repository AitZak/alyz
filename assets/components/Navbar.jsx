import React from 'react';

const Navbar = (props) => {
    return (<nav className="navbar navbar-expand-lg navbar-light bg-light">
    <a className="navbar-brand" href="#">ALYZ</a>
    <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span className="navbar-toggler-icon"></span>
    </button>
  
    <div className="collapse navbar-collapse" id="navbarColor03">
      <ul className="navbar-nav mr-auto">
        <li className="nav-item active">
          <a className="nav-link" href="#">Home
            <span className="sr-only">(current)</span>
          </a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#">Les tendances Spotify</a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#">Les tendances Deezer</a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#">Les tendances YouTube</a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#">Liste des Utilisateurs</a>
        </li>
        <li className="nav-item">
          <a className="nav-link" href="#">Contact</a>
        </li>
      </ul>
      <ul className="navbar-nav ml-auto">
          <li className="nav-item">
              <a href="#" className="btn btn-default">Connexion</a>
          </li>      
          <li className="nav-item">
              <a href="#" className="btn btn-default">Inscription</a>
          </li>
      </ul>
    </div>
  </nav> );
}

export default Navbar;