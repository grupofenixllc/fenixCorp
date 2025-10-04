import axios from 'axios';

/**
 * Instancia principal de Axios para las llamadas a la API de FenixCorp POS.
 * Configurada con una URL base y cabeceras por defecto.
 */
const api = axios.create({
  // Utiliza la variable de entorno para la URL de la API, con un fallback para desarrollo.
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000',

  // Necesario para que el backend (Laravel) pueda manejar sesiones/cookies si se usan.
  withCredentials: true,

  // Cabeceras por defecto que se enviarán en cada petición.
  headers: {
    'Accept': 'application/json', // Indica que esperamos una respuesta en formato JSON.
    'Content-Type': 'application/json', // Indica que enviamos datos en formato JSON.
  }
});

/**
 * INTERCEPTOR DE PETICIÓN (REQUEST)
 *
 * Esta función se ejecuta ANTES de que cada petición sea enviada.
 * Su propósito es inyectar dinámicamente el token de autenticación en las cabeceras.
 */
api.interceptors.request.use(config => {
  const token = localStorage.getItem('authToken');
  if (token) {
    // Si encontramos un token, lo añadimos a la cabecera 'Authorization'.
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config; // Devolvemos la configuración para que la petición continúe.
}, error => {
  // En caso de un error al configurar la petición, lo rechazamos.
  return Promise.reject(error);
});


/**
 * INTERCEPTOR DE RESPUESTA (RESPONSE) - LA GRAN MEJORA
 *
 * Esta función se ejecuta DESPUÉS de recibir una respuesta del servidor.
 * Nos permite manejar errores globales en un único lugar.
 */
api.interceptors.response.use(
  // Si la respuesta es exitosa (status 2xx), simplemente la devolvemos.
  response => response,

  // Si la respuesta contiene un error...
  error => {
    // Verificamos si el error es una respuesta 401 Unauthorized.
    if (error.response && error.response.status === 401) {
      // Un error 401 significa que el token no es válido o ha expirado.
      // Es la señal para desloguear al usuario.

      // 1. Limpiamos el token del almacenamiento local.
      localStorage.removeItem('authToken');

      // 2. Redirigimos al usuario a la página de login.
      // Usamos window.location para una redirección completa, limpiando cualquier estado residual.
      window.location.href = '/';

      // Opcional: Podrías mostrar una notificación (toast) al usuario.
      // alert('Tu sesión ha expirado. Por favor, inicia sesión de nuevo.');
    }

    // Para cualquier otro error, simplemente lo propagamos para que pueda ser
    // manejado por el bloque .catch() de la llamada original.
    return Promise.reject(error);
  }
);

export default api;