import React, { useEffect, useState } from 'react';
import axios from 'axios';
const AllUsersPage = props => {

    const [users, setUsers] = useState([]);
    useEffect(()=>{
        axios.get("http://localhost:80/api/users")
        .then(response => response.data['hydra:member'])
        .then(data => setUsers(data));
    }, []);

    return (
    <>
        <h1>Liste des utilisateurs</h1>

        <table className="table table-hover">
        <thead>
            <tr>
                <th>Email</th>
                <th>Role</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Inscription</th>
            </tr>
        </thead>
        <tbody>
            {users.map((user, index) => <tr key={index}>
                <td>{user.email}</td>
                <td>{user.roles}</td>
                <td>{user.lastname}</td>
                <td>{user.firstname}</td>
                <td>{user.created_at}</td>
            </tr>)}
        </tbody>
        </table>
    </>
    );
    
};

export default AllUsersPage;