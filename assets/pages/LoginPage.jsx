import React, {useContext, useState} from 'react';
import  '../styles/login.css';
import AuthAPI from '../services/authAPI';
import AuthContext from '../contexts/AuthContext';
import Field from '../components/forms/Field';
import { Link } from "react-router-dom";
const LoginPage = ({history}) => {

    const {setIsAuthenticated} = useContext(AuthContext);

    const [credentials, setCredentials] = useState({
        username:"",
        password:""
    });

    const [error, setError] = useState("");

    const handleChange = ({currentTarget}) => {
        const {value, name} = currentTarget;
        setCredentials({ ...credentials, [name]: value});
    };

    const handleSubmit = async event => {
        event.preventDefault();
    try{
        await AuthAPI.authenticate(credentials);
        setIsAuthenticated(true);
        history.replace("/");
        } catch(error) {
            setError("Les informations sont invalides");
        }
    };

    return (
    <>
        <div className="page-wrapper p-t-100 p-b-100s">
            <div className="wrapper wrapper--w680 login">
                <div className="card-4">
                    <div className="card-body">




        <form onSubmit={handleSubmit} className="form_custum">
            <Field label="Adresse Email" name="username" value={credentials.username} onChange={handleChange}
            placeholder="Entrez votre adresse email" error={error} />
            <Field name="password" label="Mot de Passe" placeholder="Saisissez votre mot de passe" value={credentials.password} onChange={handleChange} type="password" error="" />
            <div className="form-group mr-auto align-item text-center">
                <button type="submit" className="btn button_custum">Connexion</button>
            </div>
            <a className="text-color-form" ><Link to="/register" className="link_color">Vous n'avez pas de Compte? Créez-en un sans plus tarder!</Link></a>
        </form>


                    </div>
                </div>
            </div>
        </div>
    </>
    );
}

export default LoginPage;
