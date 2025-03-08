// Importar el Modelo Conductor
const { Billete, Linea } = require('../models')

async function crearLinea(req,res) {
    try{
        // Recuperamos los parametros
        const {nombre, origen, destino} = req.body
        if(!nombre || !origen || !destino){
            throw {textoError : 'Todos los campos son obligatorios'}
        }
        const linea = await Linea.findOne({where:{nombre:nombre}})
        if(linea){
            throw {textoError : 'Ya existe una Linea con ese nombre'}
        }
        const nuevaLinea = await Linea.create({nombre, origen, destino})
        res.status(201).send(nuevaLinea)
    }catch(error){
        res.status(500).send({mensaje: 'Error al crear la linea', error})
    }
}

async function borrarLinea(req,res) {
    try{
        const {id} = req.params

        if(!id){
            throw {textoError : 'Debes indicar el id de la linea'}
        }

        const linea = await Linea.findByPk(id)
        if(linea){

            const billetes = await Billete.findAll({
                where: { linea_id: id }
            });
    
            if (billetes.length > 0) {
                await Billete.destroy({
                    where: { linea_id: id }
                });
            }

            await linea.destroy()
            res.status(200).send({mensaje : 'Linea eliminada'})
        }else{
            throw {textoError : 'No se ha encontrado la linea'}
        }
    }catch(error){
        res.status(500).send({mensaje: 'Error al borrar la linea', error})
    }
}

module.exports = {
    crearLinea,
    borrarLinea
}