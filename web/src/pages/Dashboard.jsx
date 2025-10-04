// web/src/Dashboard.jsx

import React from 'react';

function Dashboard() {
  return (
    <div className="min-h-screen flex flex-col items-center justify-center p-4 text-center">
      <h1 className="text-3xl font-bold text-gray-800 dark:text-white">
        ¡Bienvenido al Dashboard!
      </h1>
      <p className="text-gray-600 dark:text-gray-300 mt-2">
        Has iniciado sesión correctamente.
      </p>
    </div>
  );
}

export default Dashboard;