// web/src/main.jsx

import React from 'react';
import ReactDOM from 'react-dom/client';
import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import { AuthProvider } from './AuthContext';

import App from './App.jsx'; // Sigue siendo nuestra página de Login
import Layout from './Layout.jsx'; // Nuestro nuevo layout principal
import Dashboard from './pages/Dashboard.jsx'; // La página de inicio del panel
import ProductsPage from './pages/ProductsPage.jsx'; // La nueva página de productos

import './index.css';

const router = createBrowserRouter([
  {
    path: '/', // La ruta raíz sigue siendo el Login
    element: <App />,
  },
  {
    path: '/panel', // Una nueva ruta "padre" para todo el panel
    element: <Layout />,
    children: [ // Las páginas que se mostrarán DENTRO del Layout
      {
        path: 'dashboard', // se accede con /panel/dashboard
        element: <Dashboard />,
      },
      {
        path: 'products', // se accede con /panel/products
        element: <ProductsPage />,
      },
    ],
  },
]);

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    {/* 2. Envolvemos el RouterProvider con AuthProvider */}
    <AuthProvider>
      <RouterProvider router={router} />
    </AuthProvider>
  </React.StrictMode>
);