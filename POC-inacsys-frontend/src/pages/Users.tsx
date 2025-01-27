import { FormEvent, useState } from "react";
import Input from "../components/Input";
import "../styles/users.css";

export default function Users() {
  const [username, setUsername] = useState("");
  const [firstname, setFirstname] = useState("");
  const [lastname, setLastname] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const createUser = async (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault(); // Evita la recarga de página
  
    const response = await fetch('http://127.0.0.1:8000/api/user', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        username,
        firstname,
        lastname,
        email,
        password
      })
    });
  
    if (response.ok) {
      alert('User created!!! :D');
      // Opcional: Limpia los campos después de la creación
      setUsername('');
      setFirstname('');
      setLastname('');
      setEmail('');
      setPassword('');
    } else {
      const errorData = await response.json();
      alert(`Error: ${errorData.message || 'Something went wrong'}`);
    }
  };
  

  return (
    <div className="users-container">
      <h1>Create Users</h1>
      <form className="users-form" onSubmit={createUser}>
        <Input
          inputName="username"
          labelText="Username"
          id="input-username"
          type="text"
          changeValue={setUsername}
          value={username}
        />
        <Input
          inputName="firstname"
          labelText="Firstname"
          id="input-firstname"
          type="text"
          changeValue={setFirstname}
          value={firstname}
        />
        <Input
          inputName="lastname"
          labelText="Lastname"
          id="input-lastname"
          type="text"
          changeValue={setLastname}
          value={lastname}
        />
        <Input
          inputName="email"
          labelText="E-mail"
          id="email"
          type="email"
          changeValue={setEmail}
          value={email}
        />
        <Input
          inputName="password"
          labelText="Password"
          id="password"
          type="password"
          changeValue={setPassword}
          value={password}
        />

        <button type="submit" className="submit-button">Create user</button>
      </form>
    </div>
  );
}
