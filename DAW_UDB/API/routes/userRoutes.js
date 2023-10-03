import express from 'express';

const router = express.Router();

// Routing
router.get('/', function (req, res) {
    res.json({ msg: 'Hola Mundo en express' });
})

router.post('/', function (req, res) {
    res.json({ msg: 'Respuesta tipo post' });
})

export default router;