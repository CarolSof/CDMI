const conexion = require('../config/db');

exports.listarUsuarios = (req, res) => {
    const sql = 'SELECT * FROM usuarios_';
    conexion.query(sql, (error, resultado) => {
        if (error) return res.status(500).json({ error: "Error al obtener usuarios" });
        res.json(resultado.length > 0 ? resultado : { message: "No hay registros" });
    });
};


exports.obtenerUsuario = (req, res) => {
    const { id } = req.params;
    const sql = 'SELECT * FROM usuarios_ WHERE id_usuario = ?';
    
    conexion.query(sql, [id], (error, resultado) => {
        if (error) return res.status(500).json({ error: "Error al obtener usuario" });
        res.json(resultado.length > 0 ? resultado[0] : { message: "Usuario no encontrado" });
    });
};

exports.agregarUsuario = (req, res) => {
    const { nombre, correo, clave } = req.body;
    
    if (!nombre || !correo || !clave) {
        return res.status(400).json({ error: "Todos los campos son obligatorios" });
    }

    const sql = 'INSERT INTO usuarios_ (nombre, correo, clave) VALUES (?, ?, ?)';
    conexion.query(sql, [nombre, correo, clave], (error, result) => {
        if (error) {
            if (error.code === 'ER_DUP_ENTRY') {
                return res.status(400).json({ error: "El correo ya está registrado" });
            }
            return res.status(500).json({ error: "Error al insertar usuario" });
        }
        res.status(201).json({ message: "Usuario agregado", id: result.insertId });
    });
};


exports.eliminarUsuario = (req, res) => {
    const { id } = req.params;
    const sql = 'DELETE FROM usuarios_ WHERE id_usuario = ?';

    conexion.query(sql, [id], (error, result) => {
        if (error) return res.status(500).json({ error: "Error al eliminar usuario" });
        if (result.affectedRows === 0) return res.status(404).json({ message: "Usuario no encontrado" });

        res.json({ message: "Usuario eliminado" });
    });
};


exports.editarUsuario = (req, res) => {
    const { id } = req.params;
    const { nombre, correo, clave } = req.body;

    if (!nombre || !correo) {
        return res.status(400).json({ error: "Nombre y correo son obligatorios" });
    }

    let sql = 'UPDATE usuarios_ SET nombre = ?, correo = ?';
    let values = [nombre, correo];

    if (clave) {
        sql += ', clave = ?';
        values.push(clave);
    }

    sql += ' WHERE id_usuario = ?';
    values.push(id);

    conexion.query(sql, values, (error, result) => {
        if (error) return res.status(500).json({ error: "Error al actualizar usuario" });
        if (result.affectedRows === 0) return res.status(404).json({ message: "Usuario no encontrado" });

        res.json({ message: "Usuario actualizado" });
    });
};
