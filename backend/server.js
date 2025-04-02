const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const dotenv = require('dotenv');
const userRoutes = require('./routes/userRoutes');
require('./config/db'); 

dotenv.config();

const app = express();
const PORT = process.env.PORT || 3000;


app.use(cors());
app.use(bodyParser.json());


app.use('/api/usuarios', userRoutes);

app.get('/', (req, res) => {
    res.send('Mi Primer API - Refactorizado');
});

app.listen(PORT, () => {
    console.log(` Servidor corriendo en http://localhost:${PORT}`);
});
