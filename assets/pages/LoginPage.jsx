import React, {useContext, useState} from 'react';
import AuthAPI from '../services/authAPI';
import AuthContext from '../contexts/AuthContext';

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
        <h1>Connexion A ALYZ</h1>

        <form onSubmit={handleSubmit}>
            <div className="form-group">
                <label htmlFor="username">Adresse Email</label>
                <input value={credentials.username} onChange={handleChange} type="email" placeholder="Entrez votre adresse email" name="username" id="username" className={"form-control" + (error && " is-invalid")}/>
    {error && <p className="invalid-feedback">{error}</p>}
            </div>
            <div className="form-group">
                <label htmlFor="password"></label>Mot de Passe
                <input value={credentials.password} onChange={handleChange} type="password" placeholder="Saisissez votre mot de passe" name="password" id="password" className="form-control"/>
            </div>
            <div className="form-group">
                <button type="submit" className="btn btn-success">Connexion</button>
            </div>
        </form>
    </>
    );
}

export default LoginPage;