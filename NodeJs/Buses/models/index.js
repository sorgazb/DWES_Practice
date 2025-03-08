const {Sequelize} = require('sequelize')

// Relaciones entre los modelos
const bd = require('../config/database')

const Conductor = require('./conductor') 
const Billete = require('./billete')  
const Linea = require('./linea')

// Definir relaciones 
// Conductor.hasMany(Billete, {foreignKey: 'conductor_id'}) // Un conductor tiene muchos billetes
Billete.belongsTo(Conductor, {foreignKey: 'conductor_id'});
Billete.belongsTo(Linea, {foreignKey: 'linea_id'}) // Un billete pertenece a una Linea

module.exports = {
    bd, 
    Conductor,
    Billete,
    Linea
}