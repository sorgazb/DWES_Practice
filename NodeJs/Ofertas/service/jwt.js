// Imporat libreria jwt
const jwt = require('jsonwebtoken')
// Importar dotenv
const dotenv = require('dotenv')
dotenv.config()

// Funcion crear Token
function crearToken(usuario,caducidad){
    try{
        // Obtener datos que van en el token
        // Esto es payload
        const {id,email} = usuario;

        // Crear el payload
        const payload = {id,email}

        // Generar y devolver el token
        return jwt.sign(payload, process.env.CLAVE_JWT,{expiresIn:caducidad})
    }catch(error){
        throw 'Error al generar el token'
    }
}

// Funcion verificar token
// Verfica la firma y la caducidad
function verificarToken  (token) {
    try{
        const datosVerificacion = jwt.verify(token,process.env.CLAVE_JWT)
        return datosVerificacion
    }catch(error){
        throw 'Error al verificar el token'
    }
}

module.exports = {
    crearToken,
    verificarToken
}