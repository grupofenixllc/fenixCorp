// web/src/App.jsx
import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from './AuthContext'; // Importamos nuestro hook
import logo from './assets/logo.webp';

function App() {
  const navigate = useNavigate();
  const { login } = useAuth(); // Usamos la función login del contexto
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  const handleLoginSubmit = async (event) => {
    event.preventDefault();
    setLoading(true);
    setError('');

    const email = event.target.email.value;
    const password = event.target.password.value;

    try {
      await login(email, password); // Llamamos a la función del contexto
      navigate('/panel/dashboard');
    } catch (err) {
      setError(err.response?.data?.message || 'Error al iniciar sesión.');
    } finally {
      setLoading(false);
    }
  };

  // El resto del componente (el return con el form) sigue igual...
  return (
    <div className="min-h-screen flex flex-col items-center justify-center p-4">
      <img src={logo} alt="FenixCorp Logo" className="w-32 mb-4" />
      <form onSubmit={handleLoginSubmit} className="w-full max-w-sm p-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 className="text-2xl font-bold text-center text-gray-900 dark:text-white mb-6">Iniciar Sesión</h2>
        <div className="mb-4">
          <label htmlFor="email" className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
          <input type="email" name="email" id="email" className="w-full px-3 py-2 border border-gray-300 rounded-md" required />
        </div>
        <div className="mb-6">
          <label htmlFor="password" className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Contraseña</label>
          <input type="password" name="password" id="password" className="w-full px-3 py-2 border border-gray-300 rounded-md" required />
        </div>
        {error && <p className="text-red-500 text-sm text-center mb-4">{error}</p>}
        <button type="submit" disabled={loading} className="w-full px-6 py-2 bg-primary text-white rounded hover:bg-blue-700 disabled:bg-gray-400">
          {loading ? 'Ingresando...' : 'Ingresar'}
        </button>
      </form>
    </div>
  );
}
export default App;