// Libreria Variables de entorno
const dotenv = require('dotenv')
dotenv.config()

// Libreria ORM Sequelize
const Sequelize = require('sequelize')

// Configuaracion de la conexion a la base de datos
const configDB = new Sequelize(process.env.DB_NAME,
    process.env.DB_USER,
    process.env.DB_PASSWORD, {
        host : process.env.DB_HOST,
        dialect : process.env.DB_DIALECT,
        dialectModule : require('mysql2'),
    }
)

module.exports = configDB