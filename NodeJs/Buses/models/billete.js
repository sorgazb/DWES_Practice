// Extrae DataTypes del paquete sequelize
const {DataTypes} = require ('sequelize')

// Cargar la configuracion de la BD
const bd = require('../config/database')

// Definir el tabla Conductor
const Billete = bd.define('Billete', {
    id: {
        type : DataTypes.INTEGER,
        primaryKey : true,
        autoIncrement : true
    },
    conductor_id:{
        type : DataTypes.INTEGER,
        allowNull : false,
        references : {
            model : 'conductores', // Nombre de la tabla
            key : 'id'
        },
        onDelete : 'CASCADE',
        onUpdate : 'CASCADE'
    },
    linea_id:{
        type : DataTypes.INTEGER,
        allowNull : false,
        references : {
            model : 'lineas', // Nombre de la tabla
            key : 'id'
        },
        onDelete : 'CASCADE',
        onUpdate : 'CASCADE'
    },
    fecha : {
        type : DataTypes.DATE,
        allowNull : false
    },
    hora: {
        type : DataTypes.TIME,
        allowNull : false
    },
    tipo : {
        type : DataTypes.ENUM('Media-Distancia', 'Larga-Distancia'),
        allowNull : false
    },
    precio : {
        type : DataTypes.FLOAT,
        allowNull : false,
    }
}, {
    timestamps : true,
    tableName: 'billetes'
})

module.exports = Billete