import jwt from "jsonwebtoken";
import dotenv from 'dotenv';

dotenv.config({ path: 'variables.env' });

const auth = (req, res, next) => {
    const authHeader = req.get('Authorization');

    if (authHeader) {
        // Obtener token
        const token = authHeader.split(' ')[1];

        // Comprobar el JWT
        try {
            const usuario = jwt.verify(token, process.env.SECRET);
            req.usuario = usuario;
        } catch (error) {
            console.log('JWT no válido');
            console.log(error);
        }
    }

    return next();
}

export default auth;
