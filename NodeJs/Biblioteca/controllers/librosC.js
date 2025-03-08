// Importar el Modelo Libro
const {Libro} = require('../models')

async function crearLibro(req,res) {
    try{
        const {titulo, numEjemplares} = req.body
        if(!titulo || !numEjemplares){
            throw {textoError : 'Todos los campos son obligatorios'}
        }
        const libro = await Libro.findOne({where:{titulo:titulo}})
        if(libro){
            throw {textoError : 'Ya existe un libro con ese titulo'}
        }
        const nuevoLibro = await Libro.create({titulo, numEjemplares})
        res.status(201).send(nuevoLibro)
    }catch(error){
        res.status(500).send({mensaje: 'Error al crear el libro', error})
    }
}

module.exports = {
    crearLibro
}