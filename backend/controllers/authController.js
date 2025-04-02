const db = require('../config/db');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');

exports.loginUser = (req, res) => {
    const { email, password } = req.body;

    const query = 'SELECT * FROM users WHERE email = ?';
    db.query(query, [email], async (err, results) => {
        if (err) return res.status(500).json({ error: 'Error en el servidor' });

        if (results.length === 0) return res.status(401).json({ error: 'Usuario no encontrado' });

        const user = results[0];
        const isMatch = await bcrypt.compare(password, user.password);

        if (!isMatch) return res.status(401).json({ error: 'Contraseña incorrecta' });

        const token = jwt.sign({ id: user.id }, 'secreto', { expiresIn: '1h' });

        res.json({ message: 'Inicio de sesión exitoso', token });
    });
};

exports.registerUser = async (req, res) => {
    const { email, password } = req.body;
    const hashedPassword = await bcrypt.hash(password, 10);

    const query = 'INSERT INTO users (email, password) VALUES (?, ?)';
    db.query(query, [email, hashedPassword], (err, results) => {
        if (err) return res.status(500).json({ error: 'Error en el servidor' });

        res.json({ message: 'Usuario registrado correctamente' });
    });
};
