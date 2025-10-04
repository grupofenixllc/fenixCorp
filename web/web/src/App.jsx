import React from 'react';
import logo from './assets/logo.webp';

function App() {
  return (
    <div className="min-h-screen flex flex-col items-center justify-center p-4 text-center">
      <img src={logo} alt="FenixCorp Logo" className="w-48 mb-4" />
      <h1 className="text-3xl font-bold text-primary dark:text-white mb-2">Bienvenido a FenixCorp POS</h1>
      <p className="text-gray-600 dark:text-gray-300 mb-6">
        Sistema de ventas, stock e importación de listas.
      </p>
      <button className="px-6 py-2 bg-primary text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
        Iniciar sesión
      </button>
    </div>
  );
}

export default App;