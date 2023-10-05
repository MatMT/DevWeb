import express from 'express';
import auth from '../middleware/auth.js';
import { check } from 'express-validator';
import { authUser, authenticatedUser } from '../controllers/authController.js';

const router = express.Router();

router.post('/',
    [
        check('carnet', 'Agrega un carnet válido').isString(),
        check('password', 'El Password es obligatorio').notEmpty()
    ]
    , authUser);

router.get('/',
    auth,
    authenticatedUser
);


export default router;