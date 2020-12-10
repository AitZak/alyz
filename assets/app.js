/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import React from 'react';
import ReactDOM from 'react-dom';
import Navbar from "./components/Navbar";
import HomePage from "./pages/HomePage";
import ContactPage from "./pages/ContactPage";
import AllUsersPage from "./pages/AllUsersPage";
import { HashRouter, Switch, Route } from 'react-router-dom';

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application




const App = () => {
    return( 
    <HashRouter>
        <Navbar />
        <main className="container pt-5">
            <Switch>
                <Route path="/contact" component={ContactPage} />
                <Route path="/users" component={AllUsersPage} /> 
                <Route path="/" component={HomePage} />          
            </Switch>
        </main>
    </HashRouter>
    );
};

const rootElement = document.querySelector('#app');
ReactDOM.render(<App />, rootElement);
