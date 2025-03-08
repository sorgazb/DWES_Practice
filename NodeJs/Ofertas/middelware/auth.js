const servicioJWT = require('../service/jwt');

function comprobarAuth(req, res, next) {
    try {
        if(!req.headers.authorization){
            return res.status(403).send('No se ha enviado token');
        }
        const resultado = servicioJWT.verificarToken(req.headers.authorization);
         console.log(resultado)
         req.datosUs = resultado
         next()
    } catch (error) {
        return res.status(500).send({ textoError: 'No tienes permiso para acceder a esta ruta' });
    }
  }
module.exports = {comprobarAuth};