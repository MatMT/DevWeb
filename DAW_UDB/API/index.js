import express from 'express';
import userRoutes from './routes/userRoutes.js';
import conectarDB from './config/db.js';

// Crear la app =====================
const server = express();

// Conectar a la base de datos
conectarDB();

// Definimos un puerto para arrancar el servidor
const port = process.env.PORT || 4000;

// Habilitar lectura de valores
server.use(express.json());

// Routing ==========================
// get = ruta especifica | use = rutas con una diagonal
server.use('/api/usuarios', userRoutes);

// Arrancar el servidor
server.listen(port, '0.0.0.0', () => {
    console.log(`El servidor esta funcionando en el puerto ${port}`);
});

