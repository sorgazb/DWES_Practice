// Extrae DataTypes del paquete sequelize
const {DataTypes} = require ('sequelize')

// Cargar la configuracion de la BD
const bd = require('../config/database')

// Definir el tabla Conductor
const Conductor = bd.define('Conductor', {
    id: {
        type : DataTypes.INTEGER,
        primaryKey : true,
        autoIncrement : true
    },
    nombreApe: {
        type : DataTypes.STRING(50),
        allowNull : false
    },
    dni : {
        type : DataTypes.STRING(9),
        allowNull : false,
        unique : true
    },
    telefono : {
        type : DataTypes.STRING(15),
        allowNull : false,
        unique : true
    },
    fechaContrato : {
        type : DataTypes.DATE,
        allowNull : false
    }
}, {
    timestamps : true,
    tableName: 'conductores'
})

module.exports = Conductor
