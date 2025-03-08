// Importar express
const express = require('express')

// Inicializar express
const app = express()

// Cargar rutas
const rutaLibros = require('./routes/librosR')
const rutaPrestamos = require('./routes/prestamosR')

app.use(express.json())

// Asignar rutas
app.use('/api', rutaLibros)
app.use('/api', rutaPrestamos)

module.exports = app