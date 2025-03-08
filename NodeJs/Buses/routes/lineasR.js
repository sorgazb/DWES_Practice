// Importar Express
const express = require ('express')

// Inicializar el Sistema de ruta
const api = express.Router()

// Importar el controlador
const lineasC = require('../controllers/lineasC')

// Crear rutas
api.post('/linea', lineasC.crearLinea)
api.delete('/linea/:id', lineasC.borrarLinea)

module.exports = api