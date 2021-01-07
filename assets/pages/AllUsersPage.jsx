import React, { useEffect, useState } from 'react';
import UsersAPI from '../services/usersAPI';

const AllUsersPage = props => {

    const [users, setUsers] = useState([]);

    const fetchUsers = async () => {
        try{
            const data = await UsersAPI.findAll();
            setUsers(data);
        } catch(error) {
            console.log(error.response);
        }
    }
    useEffect(()=>{
        fetchUsers();
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