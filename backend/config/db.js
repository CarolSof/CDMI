const mysql = require('mysql');
const dotenv = require('dotenv');

dotenv.config(); 

const conexion = mysql.createConnection({
    host: process.env.DB_HOST,
    database: process.env.DB_NAME,
    user: process.env.DB_USER,
    password: process.env.DB_PASS
});

conexion.connect(error => {
    if (error) {
        console.error('Error de conexión a MySQL:', error);
        throw error;
    }
    console.log(" Conexión exitosa a MySQL");
});

module.exports = conexion;

module.exports = db;
