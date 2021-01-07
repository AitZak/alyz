import React, { useContext } from 'react';
import { NavLink } from 'react-router-dom';
import AuthAPI from '../services/authAPI';
import AuthContext from '../contexts/AuthContext';

const Navbar = ({ history}) => {

  const { isAuthenticated, setIsAuthenticated } = useContext(AuthContext);
  const handleLogout = () => {
    AuthAPI.logout();
    setIsAuthenticated(false);
    history.push("/login");
  }

    return (<nav className="navbar navbar-expand-lg navbar-light bg-light">
    <NavLink className="navbar-brand navbar_title" to="/">MUSICALYZ  </NavLink>
    <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span className="navbar-toggler-icon"></span>
    </button>
  
    <div className="collapse navbar-collapse" id="navbarColor03">
      <ul className="navbar-nav mr-nav">
        <li className="nav-item active">
          <NavLink className="nav-link" to="/">Home
            <span className="sr-only">(current)</span>
          </NavLink>
        </li>
        <li className="nav-item">
          <NavLink className="nav-link" to="/spotify_authorization">Vos Playlists Spotify</NavLink>
        </li>
        <li className="nav-item">
            <NavLink className="nav-link" to="/charts_spotify">Les tendances Spotify</NavLink>
        </li>
        <li className="nav-item">
          <NavLink className="nav-link" to="/charts_deezer">Les tendances Deezer</NavLink>
        </li>
        <li className="nav-item">
          <NavLink className="nav-link" to="/contact">Contact</NavLink>
        </li>
      </ul>
      <ul className="navbar-nav mr-nav space">
        {!isAuthenticated && <>
          <li className="nav-item">
              <NavLink to="/register" className="btn btn-default button_custum">Inscription</NavLink>
          </li>
          <li className="nav-item">
              <NavLink to="/login" className="btn btn-default button_custum">Connexion</NavLink>
          </li>
        </> || (
          <li className="nav-item">
              <button onClick={handleLogout} className="btn btn-default button_custum">Déconnexion</button>
          </li>
        )}
      </ul>
    </div>
  </nav> );
}

export default Navbar;
