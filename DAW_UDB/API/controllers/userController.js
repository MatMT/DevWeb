import { validationResult } from "express-validator";
import User from "../models/User.js";
import bcrypt from 'bcrypt';

const formularioLogin = (req, res) => {
    res.render('auth/login', {
    })
}

const formularioRegistro = async (req, res) => {
    // Mensajes de error de Express Validator
    const errores = validationResult(req);
    if (!errores.isEmpty()) {
        return res.status(400).json({ errores: errores.array() });
    }

    // Verificar si el usuario ya esta registrado
    const { carnet } = req.body;
    const { password } = req.body;

    let existUser = await User.findOne({ carnet });
    if (existUser) {
        return res.status(400).json({ msg: 'El usuario ya esta registrado' });
    }

    // Encaje de datos según el modelo
    const usuario = new User(req.body);

    // Hasear el password
    usuario.password = await bcrypt.hashSync(password, 10)

    try {
        await usuario.save();
        res.json({ msg: 'Usuario Creado Correctamente' });
    } catch (error) {
        console.log(error);
    }

    res.end();
}

export {
    formularioLogin,
    formularioRegistro
}