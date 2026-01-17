const reservasKey = "petplanet_reservas";  //string para el localStorage

//Lee reservas (si no hay nada, devuelve un array vacío)
function getReservas(){
    try{
        const raw = localStorage.getItem(reservasKey);
        return raw ? JSON.parse(raw) : [];
    }catch (e){
        console.error("Error leyendo reservas: ", e);
        return []
    }
}

//Guardar las reservas
function saveReservas(reservas){
    localStorage.setItem(reservasKey, JSON.stringify(reservas));
}

//Comprobamos si una mascota está ya reservada
function isReservada(id){
    const reservas = getReservas();
    return reservas.some(r => r.id === id);
}

//Añadir reservas (si existe, no duplica)
function addReserva(mascota){
    if(!mascota || !mascota.id) {
        return {ok: false, msg: "Mascota inválida (no tiene id)"}
    }

    const reservas = getReservas();

    //para evitar duplicados
    if(reservas.some(r => r.id === mascota.id)){
        return {ok: false, msg: "Esta mascota ya está reservada"}
    }

    const nueva ={
        id: mascota.id,
        nombre: mascota.nombre || "",
        tipo: mascota.tipo || "",
        edad: mascota.edad || "",
        imagen: mascota.imagen || "",
        fechaReserva: new Date().toISOString(),
        estado: "pendiente"
    };

    reservas.push(nueva);
    saveReservas(reservas);

    return {ok: true, msg: "Reserva guardada correctamente"}
}


//eliminar reservas
function removeReserva(id){
    const reservas = getReservas();
    const nuevas = reservas.filter(r => r.id !== id);
    saveReservas(nuevas);
    return { ok: true, msg: "Reserva eliminada" };
}


//vaciar reservas
function clearReservas(){
    saveReservas([]);
    return { ok: true, msg: "Reservas vaciadas" };
}