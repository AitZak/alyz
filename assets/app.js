/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import Navbar from "./components/Navbar";
import HomePage from "./pages/HomePage";
import ContactPage from "./pages/ContactPage";
import AllUsersPage from "./pages/AllUsersPage";
import LoginPage from "./pages/LoginPage";
import AuthApi from "./services/authAPI";
import AuthContext from "./contexts/AuthContext";
import { HashRouter, Switch, Route, withRouter } from 'react-router-dom';
import PrivateRoute from './components/PrivateRoute';
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';


AuthApi.setup();

const App = () => {

    const [isAuthenticated, setIsAuthenticated] = useState(AuthApi.isAuthenticated());

    const NavbarWithRouter = withRouter(Navbar);

    return(
    <AuthContext.Provider value={{
        isAuthenticated,
        setIsAuthenticated
    }}>
    <HashRouter>
        <NavbarWithRouter />
        <main className="container pt-5">
            <Switch>
                <Route path="/login" component={LoginPage} />
                <Route path="/contact" component={ContactPage} />
                <PrivateRoute path="/users" component = {AllUsersPage} />
                <Route path="/" component={HomePage} />          
            </Switch>
        </main>
    </HashRouter>
    </AuthContext.Provider> 
    );
};

const rootElement = document.querySelector('#app');
ReactDOM.render(<App />, rootElement);
