// Extrae DataTypes del paquete sequelize
const {DataTypes} = require ('sequelize')

// Cargar la configuracion de la BD
const bd = require('../config/database')

// Definir el tabla Linea
const Linea = bd.define('Linea', {
    id: {
        type : DataTypes.INTEGER,
        primaryKey : true,
        autoIncrement : true
    },
    nombre: {
        type : DataTypes.STRING(50),
        allowNull : false
    },
    origen : {
        type : DataTypes.STRING(50),
        allowNull : false
    },
    destino : {
        type : DataTypes.STRING(50),
        allowNull : false
    }
}, {
    timestamps : true,
    tableName: 'lineas'
})

module.exports = Linea