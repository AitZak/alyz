import axios from 'axios';
import jwtDecode from 'jwt-decode';

function authenticate(credentials)
{
    return axios.post('http://localhost:80/api/login_check', credentials).then(response => response.data.token)
    .then(token => {
        window.localStorage.setItem("authToken", token);
        setToken(token);
    });
}

function logout()
{
    window.localStorage.removeItem("authToken");
    delete axios.defaults.headers["Authorization"];
}
function setToken(token) 
{
    axios.defaults.headers["Authorization"] = "Bearer " + token;
}
function setup()
{
    const token = window.localStorage.getItem("authToken");
    if(token) {
        const {exp : expiration} =jwtDecode(token);
        if (expiration * 1000 > new Date().getTime()) {
            setToken(token);
        }
    }
}

function isAuthenticated()
{
    const token = window.localStorage.getItem("authToken");
    if(token) {
        const {exp : expiration} =jwtDecode(token);
        if (expiration * 1000 > new Date().getTime()) {
            return true;
        }
        return false;
    }
    return false;
}

export default {
    authenticate,
    logout,
    setup,
    isAuthenticated
};