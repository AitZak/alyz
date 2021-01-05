import React, {useState} from 'react';
import "../styles/register.css"
import { Link } from 'react-router-dom';
import Field from '../components/forms/Field';
import usersAPI from '../services/usersAPI';

const RegisterPage = (props) => {

    const [user, setUser] = useState({
        email:"",
        lastname:"",
        firstname:"",
        password:"",
        passwordConfirm:""
    });

    const [errors, setErrors] = useState({
        email:"",
        lastname:"",
        firstname:"",
        password:"",
        passwordConfirm:""
    });

    const handleChange = ({currentTarget}) => {
        const { name, value } = currentTarget;
        setUser({...user, [name]: value});
    };

    const handleSubmit = async event => {
        event.preventDefault();
        const apiErrors = {};
        if(user.password !== user.passwordConfirm) {
            apiErrors.passwordConfirm = "Votre confirmation de mot de passe n'est pas identique à l'original";
            setErrors(apiErrors);
            return;
        }
        try {
            await usersAPI.register(user);
            setErrors({});
            props.history.replace("/login");

        }catch({ response }) {
            const { violations } = response.data;
            if(violations) {
                const apiErrors={};
                violations.map(({propertyPath, message}) => {
                    apiErrors[propertyPath] = message;
                });
                setErrors(apiErrors);
            }
        }
    };

    return (
    <>
        <div className="page-wrapper p-b-100s">
            <div className="wrapper wrapper--w680 login">
                <div className="card-4">
                    <div className="card-body">
                        <h1>Rejoignez la plateforme MALYZ</h1>
                        <form onSubmit={handleSubmit}>
                            <Field name="email" label="Email" placeholder="Saisissez votre adresse mail" type="email" value={user.email} onChange={handleChange} error={errors.email}/>
                            <Field name="lastname" label="Nom" placeholder="Saisissez votre nom de famille" value={user.lastname} onChange={handleChange} error={errors.lastname}/>
                            <Field name="firstname" label="Prénom" placeholder="Saisissez votre prénom" value={user.firstname} onChange={handleChange}error={errors.firstname}/>
                            <Field name="password" label="Mot de Passe" placeholder="Saisissez votre mot de passe" type="password" value={user.password} onChange={handleChange}error={errors.password}/>
                            <Field name="passwordConfirm" label="Confirmation de mot de passe" placeholder="Confirmez votre mot de passe" type="password" value={user.passwordConfirm} onChange={handleChange}error={errors.passwordConfirm}/>
                            <div className="form-group mr-auto align-item text-center">
                                <button type="submit" className="btn button_custum">S'inscrire</button>
                            </div>
                            <a className="text-color-form" ><Link className="link_color" to="/login">J'ai déjà un compte</Link></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </>
    );
};

export default RegisterPage;
