function registrarcliente() {
    // Obtener los valores de los campos del formulario por sus ID
    let nombres = document.getElementById("nombres").value;
    let apellidos = document.getElementById("apellidos").value;
    let ndocumento = document.getElementById("ndocumento").value;
    let ncelular = document.getElementById("ncelular").value;
    let direccion = document.getElementById("direccion").value;
    let municipio = document.getElementById("municipio").value;
    let correo = document.getElementById("correo").value;
    let contraseña = document.getElementById("contraseña").value;
    let vcontraseña = document.getElementById("vcontraseña").value;
    let autorizacion = document.getElementById("autorizacion").value;

    // Verificar si algún campo está vacío
    if (nombres === "" || apellidos === "" || ndocumento === "" ||
        ncelular === "" || correo === "" || direccion === "" || municipio === "" || 
        contraseña === "" || vcontraseña === "" || autorizacion === "") {
        
        // Mostrar mensaje de error si algún campo está vacío
        document.getElementById("mensaje").innerText = "TODOS LOS CAMPOS SON OBLIGATORIOS";
        return;
    }

    // Construir un mensaje con los datos del cliente
    let mensaje = "Cliente registrado: \n\n" +
                  "nombres: " + nombres + "\n" +
                  "apellidos: " + apellidos + "\n" +
                  "ndocumento: " + ndocumento + "\n" +
                  "ncelular: " + ncelular + "\n" +
                  "direccion: " + direccion + "\n" +
                  "municipio: " + municipio + "\n" +
                  "correo: " + correo + "\n" +
                  "contraseña: " + contraseña + "\n" +
                  "vcontraseña: " + vcontraseña + "\n" +
                  "autorizacion: " + autorizacion;

    // Mostrar el mensaje en el elemento con ID 'mensaje'
    document.getElementById("mensaje").innerText = mensaje;

    // Restablecer el formulario
    document.getElementById("formulario").reset();
}
