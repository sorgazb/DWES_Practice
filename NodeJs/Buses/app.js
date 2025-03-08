// Importar express
const express = require('express')

// Inicializar express
const app = express()

// Cargar rutas
const rutaBilletes = require('./routes/billetesR')
const rutaLineas = require('./routes/lineasR')
const rutaCondcutors = require('./routes/conductorsR')

app.use(express.json())

// Asignar rutas
app.use('/api', rutaBilletes)
app.use('/api', rutaLineas)
app.use('/api', rutaCondcutors)

module.exports = app