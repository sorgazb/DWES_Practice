const app = require('./app')

const puerto = 3000

const {bd, Libro, Prestamo} = require('./models')

bd.sync({force : false})
    .then(()=>{
        app.listen(puerto, ()=>{
            console.log('Servidor Iniciado http://localhost:3000')
        })
    })
    .catch((error) => {
        console.log('Error al sincronizar la base de datos: ',error)
    })

