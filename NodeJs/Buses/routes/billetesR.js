// Importar Express
const express = require ('express')

// Inicializar el Sistema de ruta
const api = express.Router()

// Importar el controlador
const billetesC = require('../controllers/billetesC')

// Crear rutas
api.post('/billete', billetesC.venderBillete)
api.get('/billetes/:conductorId', billetesC.obtenerBilletesConductor)
api.get('/billete/:lineaId', billetesC.obtenerRecaudacionLinea)

module.exports = api