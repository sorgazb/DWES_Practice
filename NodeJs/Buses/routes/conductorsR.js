// Importar Express
const express = require ('express')

// Inicializar el Sistema de ruta
const api = express.Router()

// Importar el controlador
const conductorsC = require('../controllers/conductorsC')

// Crear rutas
api.post('/conductor', conductorsC.crearConductor)

module.exports = api