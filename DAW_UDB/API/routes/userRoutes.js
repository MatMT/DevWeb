import express from 'express';
import { formularioLogin } from '../controllers/userController.js';

const router = express.Router();

// Routing
router.get('/login', formularioLogin)
router.get('/registro', formularioRegistro)

export default router;