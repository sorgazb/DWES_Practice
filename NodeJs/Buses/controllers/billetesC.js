// Importar el Modelo Conductor
const { Billete, Linea, Conductor } = require('../models')


async function venderBillete(req,res) {
    try{
        // Recuperamos los parametros
        const {tipo, precio, conductor, linea} = req.body
        if(!tipo || !precio || !conductor || !linea){
            throw {textoError : 'Todos los campos son obligatorios'}
        }
        const lineaBillete = await Linea.findByPk(linea)
        if(!lineaBillete){
            throw {textoError : 'No existe esa linea'}
        }
        const conductorBillete = await Conductor.findByPk(conductor)
        if(!conductorBillete){
            throw {textoError : 'No existe ese conductor'}
        }
        const fecha = new Date()
        const fechaSinHora = fecha.toISOString().split('T')[0]
        console.log(fechaSinHora)
        const hora = fecha.toISOString().split('T')[1].split('.')[0]
        const nuevoBillete = await Billete.create({conductor_id : conductor, linea_id:linea, fecha:fechaSinHora, hora, tipo, precio})
        res.status(201).send(nuevoBillete)
    }catch(error){
        res.status(500).send({mensaje: 'Error al crear el billete', error})
    }
}

async function obtenerBilletesConductor(req, res) {
    try {
        const { conductorId } = req.params;  
        const { fecha } = req.body;      

        if (!fecha) {
            throw { textoError: 'No se ha indicado la fecha' };
        }

        const conductor = await Conductor.findByPk(conductorId);

        if (!conductor) {
            throw { textoError: 'No se ha encontrado al conductor' };
        }

        const billetes = await Billete.findAll({
            where: {conductor_id:conductorId, fecha},
            include: [
                { model: Linea, attributes: ['nombre'] },
                { model: Conductor, attributes: ['nombreApe'] }
            ],
        });

        if (billetes.length == 0) {
            throw { textoError: 'No se hay billetes de ese conductor en esas fechas' };
        }

        res.status(200).json(billetes);

    } catch (error) {
        res.status(500).send({mensaje: 'Error al crear el billete', error})
    }
}

async function obtenerRecaudacionLinea(req, res) {
    try {
        const { lineaId } = req.params;  
        const { fecha } = req.body;      

        if (!fecha) {
            throw { textoError: 'No se ha indicado la fecha' };
        }

        const linea = await Linea.findByPk(lineaId);

        if (!linea) {
            throw { textoError: 'No se ha encontrado la linea' };
        }

        const recaudacion = await Billete.sum('precio',{
            where: {linea_id:lineaId, fecha},
        });

        if (recaudacion == null) {
            throw { textoError: 'No se hay billetes de esa linea en esas fechas' };
        }

        res.status(200).json(recaudacion);

    } catch (error) {
        res.status(500).send({mensaje: 'Error al crear el billete', error})
    }
}




module.exports = {
    venderBillete,
    obtenerBilletesConductor,
    obtenerRecaudacionLinea
}