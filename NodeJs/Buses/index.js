// Importar app.js
const app = require('./app')

// Configurar puerto (3000 -> node)
const puerto = 3000

// Cargar Conexion y Modelos
const {bd, Conductor, Billete, Linea} = require('./models')

// Conectar con la BD
bd.sync({force : false})
    .then(()=>{
        console.log('Base de Datos Sincronizada')
        // Levantar el servidor
        app.listen(puerto, ()=>{
            console.log('Servidor Iniciado http://localhost:3000')
        })
    })
    .catch((error) => {
        console.log('Error al sincronizar la base de datos: ',error)
    })

module.exports = bd


