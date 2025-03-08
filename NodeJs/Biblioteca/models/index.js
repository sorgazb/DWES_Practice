const {Sequelize} = require('sequelize')

const bd = require('../config/database')

const Libro = require('./libro') 
const Prestamo = require('./prestamo')  

// Definir relaciones 
Prestamo.belongsTo(Libro, {foreignKey: 'libro_id'});

module.exports = {
    bd, 
    Libro,
    Prestamo
}