// Extrae DataTypes del paquete sequelize
const {DataTypes} = require ('sequelize')

// Cargar la configuracion de la BD
const bd = require('../config/database')

// Definir el tabla Prestamo
const Prestamo = bd.define('Prestamo', {
    id: {
        type : DataTypes.INTEGER,
        primaryKey : true,
        autoIncrement : true
    },
    fecha : {
        type : DataTypes.DATE,
        allowNull : false
    },
    libro_id:{
        type : DataTypes.INTEGER,
        allowNull : false,
        references : {
            model : 'libros', // Nombre de la tabla
            key : 'id'
        },
        onDelete : 'RESTRICT',
        onUpdate : 'CASCADE'
    },
    nombreCliente:{
        type:DataTypes.STRING(255),
        allowNull:false,
    },
    fechaDevolucion : {
        type : DataTypes.DATE
    }
}, {
    timestamps : true,
    tableName: 'prestamos'
})

module.exports = Prestamo