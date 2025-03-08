// Importar Express
const express = require ('express')

// Inicializar el Sistema de ruta
const api = express.Router()

// Importar el controlador
const librosC = require('../controllers/librosC')

// Crear rutas
api.post('/libro', librosC.crearLibro)

module.exports = api