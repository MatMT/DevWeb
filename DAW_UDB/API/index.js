import express from 'express';
import userRoutes from './routes/userRoutes.js';

// Crear la app =====================
const server = express();

// Routing ==========================
// get = ruta especifica | use = rutas con una diagonal
server.use('/', userRoutes);

// Definimos un puerto para arrancar el servidor
const port = 3000;
server.listen(port, () => {
    console.log(`El servidor esta funcionando en el puerto ${port}`);
});

