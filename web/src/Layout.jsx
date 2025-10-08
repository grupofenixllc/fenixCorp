// web/src/Layout.jsx
import React from 'react';
import { Outlet, Link, useNavigate } from 'react-router-dom';
import { Home, Package, ShoppingCart, Users, Truck, LogOut } from 'lucide-react';
import { useAuth } from './AuthContext'; // Importamos nuestro hook

function Layout() {
  const { user, logout } = useAuth(); // Obtenemos el usuario y la función logout
  const navigate = useNavigate();

  const handleLogout = async () => {
    await logout();
    navigate('/'); // Redirigimos al login después de cerrar sesión
  };

  // Si todavía está cargando o no hay usuario, muestra un mensaje
  if (!user) {
    return <p>Cargando o no autenticado...</p>;
  }

  // El resto del código del Layout sigue igual...
  const navItems = [
    { name: 'Dashboard', href: '/panel/dashboard', icon: Home },
    { name: 'Productos', href: '/panel/products', icon: Package },
    { name: 'Ventas', href: '#', icon: ShoppingCart },
    { name: 'Proveedores', href: '/panel/providers', icon: Truck },
    { name: 'Usuarios', href: '#', icon: Users },
  ];

  return (
    <div className="flex h-screen bg-gray-100 dark:bg-gray-900">
      <aside className="w-64 flex-shrink-0 bg-white dark:bg-gray-800 border-r dark:border-gray-700 flex flex-col">
        <div className="h-16 flex items-center justify-center border-b dark:border-gray-700">
          <h1 className="text-xl font-bold text-primary dark:text-white">FenixCorp POS</h1>
        </div>
        <nav className="p-4 flex-1">
          <ul>
            {navItems.map((item) => (
              <li key={item.name}><Link to={item.href} className="flex items-center p-3 my-1 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700"><item.icon className="w-5 h-5 mr-3" />{item.name}</Link></li>
            ))}
          </ul>
        </nav>
        {/* Sección del Usuario al final de la barra lateral */}
        <div className="p-4 border-t dark:border-gray-700">
          <p className="text-sm text-gray-800 dark:text-white font-semibold">{user.name}</p>
          <p className="text-xs text-gray-500 dark:text-gray-400">{user.email}</p>
          <button onClick={handleLogout} className="w-full mt-4 flex items-center justify-center p-2 text-sm text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 dark:hover:bg-red-900">
            <LogOut className="w-4 h-4 mr-2" />
            Cerrar Sesión
          </button>
        </div>
      </aside>

      <main className="flex-1 p-8 overflow-y-auto">
        <Outlet />
      </main>
    </div>
  );
}

export default Layout;