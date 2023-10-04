import express from 'express';
import { check } from 'express-validator';
import { formularioRegistro } from '../controllers/userController.js';

const router = express.Router();

// Routing
router.post('/',
    // Reglas de validación para esta ruta
    [
        check('nombre', 'El nombre es Obligatorio').notEmpty(),
        check('carnet', 'El carnet no es válido').isLength(
            { min: 8, max: 8 }
        ),
        check('password', 'El password debe ser de al menos 4 carácteres').isLength(
            { min: 4 }
        ),
    ],
    formularioRegistro
);


/*
Aquí te proporcionaré ejemplos de endpoints que podrías implementar en tu API para gestionar la información de los pensum de las carreras de Técnico en Ingeniería en Computación y de Ingeniería en Computación de la UDB, siguiendo los requisitos mencionados:

Consulta de Prerrequisitos de una Materia por Código:

Método: GET
Endpoint: /api/prerrequisitos/:codigo
Descripción: Permite a los usuarios consultar los prerrequisitos de una materia específica identificada por su código.
Consulta de Materias por Ciclo:

Método: GET
Endpoint: /api/materias/:carrera/:ciclo
Descripción: Permite a los usuarios consultar las materias disponibles en un ciclo académico específico para una carrera determinada.
Inscripción de Materias:

Método: POST
Endpoint: /api/inscripcion/:carrera
Descripción: Permite a los usuarios inscribirse en materias de una carrera seleccionada. Los datos de las materias a inscribir se envían en el cuerpo de la solicitud.
Eliminación de Inscripciones de Materias:

Método: DELETE
Endpoint: /api/inscripcion/:id
Descripción: Permite a los usuarios eliminar sus inscripciones de materias. El id podría ser el identificador único de la inscripción.
*/

export default router;