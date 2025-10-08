// web/src/pages/ProvidersPage.jsx

import React, { useState, useEffect } from 'react';
import api from '../api';

function ProvidersPage() {
  const [providers, setProviders] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    const fetchProviders = async () => {
      try {
        const response = await api.get('/api/providers');
        setProviders(response.data);
      } catch (err) {
        setError('No se pudieron obtener los proveedores.');
        console.error(err);
      } finally {
        setLoading(false);
      }
    };
    fetchProviders();
  }, []);

  if (loading) return <p>Cargando proveedores...</p>;
  if (error) return <p className="text-red-500">{error}</p>;

  return (
    <div>
      <h1 className="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
        Gestión de Proveedores
      </h1>

      <div className="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" className="py-3 px-6">ID</th>
              <th scope="col" className="py-3 px-6">Nombre</th>
              <th scope="col" className="py-3 px-6">Contacto</th>
              <th scope="col" className="py-3 px-6">Teléfono</th>
              <th scope="col" className="py-3 px-6">Email</th>
            </tr>
          </thead>
          <tbody>
            {providers.length > 0 ? (
              providers.map((provider) => (
                <tr key={provider.id} className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td className="py-4 px-6">{provider.id}</td>
                  <td className="py-4 px-6 font-medium">{provider.name}</td>
                  <td className="py-4 px-6">{provider.contact_name || 'N/A'}</td>
                  <td className="py-4 px-6">{provider.phone || 'N/A'}</td>
                  <td className="py-4 px-6">{provider.email || 'N/A'}</td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="5" className="text-center py-4">No se encontraron proveedores.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}

export default ProvidersPage;