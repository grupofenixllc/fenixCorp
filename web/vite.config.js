import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

// Configuración de Vite para el frontend de FenixCorp
export default defineConfig({
  plugins: [react()],
  build: {
    outDir: 'dist'
  },
  server: {
    port: 5173,
    open: true
  }
});