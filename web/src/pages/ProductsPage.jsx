// web/src/pages/ProductsPage.jsx
import React, { useState, useEffect } from 'react';
import api from '../api'; // Usamos nuestra instancia de Axios

function ProductsPage() {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        // La llamada ahora es más simple
        const response = await api.get('/api/products');
        setProducts(response.data);
      } catch (err) {
        setError('No se pudieron obtener los productos. Es posible que no estés autenticado.');
        console.error(err);
      } finally {
        setLoading(false);
      }
    };
    fetchProducts();
  }, []);

  // El resto del componente sigue igual...
  if (loading) return <p>Cargando productos...</p>;
  if (error) return <p className="text-red-500">{error}</p>;

  return (
    <div>
      <h1 className="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
        Gestión de Productos
      </h1>
      <div className="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" className="py-3 px-6">ID</th>
              <th scope="col" className="py-3 px-6">Nombre</th>
              <th scope="col" className="py-3 px-6">Precio</th>
              <th scope="col" className="py-3 px-6">Stock</th>
            </tr>
          </thead>
          <tbody>
            {products.length > 0 ? (
              products.map((product) => (
                <tr key={product.id} className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td className="py-4 px-6">{product.id}</td>
                  <td className="py-4 px-6 font-medium">{product.name}</td>
                  <td className="py-4 px-6">${product.price}</td>
                  <td className="py-4 px-6">{product.stock || 0}</td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="4" className="text-center py-4">No se encontraron productos.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}
export default ProductsPage;