import User from "../models/User.js";
import bcrypt from 'bcrypt';

const authUser = async (req, res, next) => {
    // Buscar si hay errores

    // Buscar el usuario par aver si esta registrado
    const { carnet, password } = req.body;
    const usuario = await User.findOne({ carnet });

    if (!usuario) {
        res.status(401).json({ msg: 'El Usuario No Existe' });
        return next();
    }

    // Verificar el password y autenticar el usuario
    if (bcrypt.compareSync(password, usuario.password)) {
        // Generar JWT
    } else {
        res.status(401).json({ msg: "Password Incorrecto" });
    }


    res.end();
}

const authenticatedUser = (req, res) => {

}

export {
    authUser,
    authenticatedUser
}