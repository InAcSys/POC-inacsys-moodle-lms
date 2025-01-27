import '../styles/menu.css'

const Menu = () => {
  return <header className="header">
    <a href="/" className='inacsys-name'>InAcSys</a>
    <nav className="nav">
      <a href="/users" className="nav-link">Users</a>
      <a href="/courses" className="nav-link">Courses</a>
    </nav>
  </header>;
};

export default Menu;
