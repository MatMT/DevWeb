import User from "../models/User.js";
import bcrypt from 'bcrypt';
import { validationResult } from "express-validator";

const authUser = async (req, res, next) => {
    // Mensajes de error de Express Validator
    const errores = validationResult(req);
    if (!errores.isEmpty()) {
        return res.status(400).json({ errores: errores.array() });
    }

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
        const token = jwt.sign({
            id: usuario._id,
            nombre: usuario.nombre,
            carnet: usuario.carnet,
        }, process.env.SECRET, {
            expiresIn: '8h'
        });

        res.json({ token });
    } else {
        res.status(401).json({ msg: "Password Incorrecto" });
    }

    res.end();
}

const authenticatedUser = (req, res, next) => {
    res.json({ usuario: req.usuario });
}

export {
    authUser,
    authenticatedUser
}