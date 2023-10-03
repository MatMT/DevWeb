import express from 'express';
// import userRoutes from './routes/userRoutes.js';
import conectarDB from './config/db.js';

// Crear la app =====================
const server = express();

// Conectar a la base de datos
conectarDB();

// Routing ==========================
// get = ruta especifica | use = rutas con una diagonal
// server.use('/', userRoutes);

// Definimos un puerto para arrancar el servidor
const port = process.env.PORT || 4000;
server.listen(port, '0.0.0.0', () => {
    console.log(`El servidor esta funcionando en el puerto ${port}`);
});

