// Importar Express
const express = require ('express')

// Inicializar el Sistema de ruta
const api = express.Router()

// Importar el controlador
const prestamosC = require('../controllers/prestamosC')

// Crear rutas
api.post('/prestamo', prestamosC.crearPrestamo)
api.get('/prestamo/:id', prestamosC.obtenerPrestamosNoDevueltos);
api.put('/prestamo/:id', prestamosC.devolverPrestamo);


module.exports = api