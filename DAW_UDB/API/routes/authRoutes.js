import express from 'express';
import { check } from 'express-validator';
import { authUser, authenticatedUser } from '../controllers/authController.js';

const router = express.Router();

router.post('/', authUser);

router.get('/', authenticatedUser);

export default router;