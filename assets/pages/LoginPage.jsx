import React, {useContext, useState} from 'react';
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
        <div className="d-flex justify-content-between align-items-center"></div>
        <h1>Connexion A ALYZ</h1>
        <Link to="/register">Vous n'avez pas de Compte? Créez-en un sans plus tarder!</Link>
        <form onSubmit={handleSubmit}>
            <Field label="Adresse Email" name="username" value={credentials.username} onChange={handleChange}
            placeholder="Entrez votre adresse email" error={error} />
            <Field name="password" label="Mot de Passe" placeholder="Saisissez votre mot de passe" value={credentials.password} onChange={handleChange} type="password" error="" />
            <div className="form-group">
                <button type="submit" className="btn btn-success">Connexion</button>
            </div>
        </form>
    </>
    );
}

export default LoginPage;