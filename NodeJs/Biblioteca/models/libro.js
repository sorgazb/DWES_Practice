// Extrae DataTypes del paquete sequelize
const {DataTypes} = require ('sequelize')

// Cargar la configuracion de la BD
const bd = require('../config/database')

// Definir el tabla Libro
const Libro = bd.define('Libro', {
    id: {
        type : DataTypes.INTEGER,
        primaryKey : true,
        autoIncrement : true
    },
    titulo: {
        type : DataTypes.STRING(255),
        allowNull : false,
        unique : true
    },
    numEjemplares : {
        type : DataTypes.INTEGER,
        allowNull : false
    }
}, {
    timestamps : true,
    tableName: 'libros'
})

module.exports = Libro