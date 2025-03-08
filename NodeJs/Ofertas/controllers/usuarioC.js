//Importar el modelo de Usuario
const Usuario = require('../Models/usuario');
//Importar bcrypt
const cifrar = require('bcrypt');

const servicioJWT = require('../service/jwt') 
const {request} = require('express');

const fs = require('fs');
const path = require('path');

async function login(req, res) {

    try {
        //Recuperar datos
        const {email, password} = req.body;
        if(!email || !password){
            throw 'Falta email o ps';
        }
        //REcuperar el us por el email
        const us = await Usuario.findOne({where:{email}});
        if(!us){
            throw 'Usuario incorrecto';
        }
        else{
            //Comprobar con bcrypt si la contraseña es correcta
            if(await cifrar.compare(password,us.password)){
                // Crear token
                const token = servicioJWT.crearToken(us,'24h') 
                res.status(200).send({email:us.email,nombre:us.nombre,perfil:us.perfil, token:token});
            }
            else{
                throw 'Usuario incorrecto';
            }
        }

    } catch (error) {
        res.status(500).send({textoError:error});
    }
    
}

async function registro(req, res) {
    try {
        //Recuperar los datos de la solicitud (req)
        const { nombre, email, password, perfil } = req.body;

        //Validar si vienen todos los datos para registro
        if (!nombre || !email || !password || !perfil) {
            throw 'Faltan datos para registrar al usuario' ;
        }
        //Comprobar que no hay otro usuario con el mismo email
        //Hacemos un select a la tabla usuarios por email
        //where:{campo:valor} si coincide se puede poner where:{email}
        //Debemos esperar a que termien de ejecutarse el findOne para
        //continuar. Debemos llamar a findOne con await
        const u = await Usuario.findOne({ where: { email: email } });
        if (u) {
            //Se ha recuperado un usuario
            throw 'Ya existe usuario con ese email';
        }
        //Cifrar pswd
        const hashPs = await cifrar.hash(password, 10);
        //Crear usuario
        const us = await Usuario.create({ nombre, email, password: hashPs, perfil })
        //Devolver el usuario creado
        res.status(200).send(us);
    } catch (error) {
        res.status(500).send({textoError:error});
    }
}

async function subirAvatar(req, res) {
    try{
        console.log(req.files)
        if(!req.files.avatar){
            throw 'Falta el avatar';
        }
        console.log(req.files)
        const rutaF=req.files.avatar.path.split('/')
        const us= await Usuario.findByPk(req.datosUs.id)
        us.avatar = rutaF[1]
        if(us.changed()){
            await us.save()
            res.status(200).send('Avatar cambiado')
        }else{
            res.status(200).send('No se ha cambiado el avatar')
        }
    }catch(error){
        res.status(500).send({textoError:error});
    }
}

async function obtenerAvatar(req, res) {
    try{
        const us = await Usuario.findByPk(req.datosUs.id)
        if(!us ||  !us.avatar){
            throw 'No se ha encontrado el avatar'
        }else{
            const nombreF = `./avatar/${us.avatar}`
            fs.stat(nombreF,(error,stat)=>{
                if(error){
                    throw 'No se ha encontrado el avatar'
                }else{
                    res.sendFile(path.resolve(nombreF))
                }
            })
        }
    }catch(error){
        res.status(500).send({textoError:error});
    }
}

//Exportar funciones para usarlas fuera de este fichero
module.exports = {
    login,
    registro,
    subirAvatar,
    obtenerAvatar
}