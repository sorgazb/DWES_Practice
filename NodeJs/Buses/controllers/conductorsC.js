// Importar el Modelo Conductor
const {Conductor} = require('../models')

async function crearConductor(req,res) {
    try{
        // Recuperamos los parametros
        const {nombreApe, dni, telefono, fechaContrato} = req.body
        if(!nombreApe || !dni || !telefono || !fechaContrato){
            throw {textoError : 'Todos los campos son obligatorios'}
        }
        const conductor = await Conductor.findOne({where:{dni:dni}})
        if(conductor){
            throw {textoError : 'Ya existe un conductor con ese DNI'}
        }
        const nuevoConductor = await Conductor.create({nombreApe, dni, telefono, fechaContrato})
        res.status(201).send(nuevoConductor)
    }catch(error){
        res.status(500).send({mensaje: 'Error al crear el conductor', error})
    }
}

module.exports = {
    crearConductor
}