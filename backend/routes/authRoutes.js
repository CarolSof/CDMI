const express = require('express');
const { listarUsuarios, obtenerUsuario, agregarUsuario, eliminarUsuario, editarUsuario } = require('../controllers/userController');

const router = express.Router();

router.get('/listar', listarUsuarios);
router.get('/:id', obtenerUsuario);
router.post('/agregar', agregarUsuario);
router.delete('/eliminar/:id', eliminarUsuario);
router.put('/editar/:id', editarUsuario);

module.exports = router;
