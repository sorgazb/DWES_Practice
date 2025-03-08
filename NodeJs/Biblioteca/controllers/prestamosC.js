// Importar el Modelo Prestamo y Libro
const {Prestamo, Libro} = require('../models')

async function crearPrestamo(req,res) {
    try{
        const {libro, nombreCliente} = req.body
        if(!libro || !nombreCliente){
            throw {textoError : 'Todos los campos son obligatorios'}
        }
        const libroPrestamo = await Libro.findByPk(libro)
        if(!libroPrestamo){
            throw {textoError : 'No existe ese libro'}
        }else{
            if(libroPrestamo.numEjemplares < 1){
                throw {textoError : 'No hay ejemplares de ese libro'}
            }else{
                const ejemplaresNuevos = libroPrestamo.numEjemplares - 1
                libroPrestamo.set('numEjemplares',ejemplaresNuevos)
                if(libroPrestamo.changed()){
                    await libroPrestamo.save()
                }
            }
        }
        const fechaPrestamo = new Date()
        const nuevoPrestamo = await Prestamo.create({fecha : fechaPrestamo, libro_id:libro, nombreCliente})
        res.status(201).send(nuevoPrestamo)
    }catch(error){
        res.status(500).send({mensaje: 'Error al crear el prestamo', error})
    }
}

async function obtenerPrestamosNoDevueltos(req,res){
    try {
        if(!req.params.id){
            throw 'Faltan parámetros';
        }
        const libro = await Libro.findByPk(req.params.id);
        if(!libro){
            throw 'No existe el libro'; 
        }
        const prestamos = await Prestamo.findAll({
                attributes: ['id','fecha','nombreCliente','fechaDevolucion'],
                where:{libro_id:req.params.id,fechaDevolucion:null},
                include:[
                    {model:Libro, attributes:['titulo']}]
                
            });
        res.status(200).send(prestamos);

    } catch (error) {
        res.status(500).send('Error:'+error);
    }
}

async function devolverPrestamo(req,res){
    try {
        if(!req.params.id){
            throw 'Faltan parámetros';
        }
        const prestamo = await Prestamo.findByPk(req.params.id);
        if(!prestamo){
            throw 'No existe el prestamo'; 
        }else{
            const fechaDevolucion = new Date()
            prestamo.set("fechaDevolucion",fechaDevolucion)
            if(prestamo.changed()){
                await prestamo.save()
                res.status(200).json({mensaje: 'Se ha devuelto el prestamo correctamente'});
                const libroPrestamo = await Libro.findOne({where:{id:prestamo.libro_id}})
                const ejemplaresNuevos = libroPrestamo.numEjemplares + 1
                libroPrestamo.set('numEjemplares',ejemplaresNuevos)
                if(libroPrestamo.changed()){
                    await libroPrestamo.save()
                }
            }else{
                res.status(200).json({mensaje: 'No se ha devuelto el prestamo correctamente'});
            }
        }
    } catch (error) {
        res.status(500).send('Error:'+error);
    }
}



module.exports = {
    crearPrestamo,
    obtenerPrestamosNoDevueltos,
    devolverPrestamo
}