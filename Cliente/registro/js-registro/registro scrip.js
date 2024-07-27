function registrarcliente(){
    let nombres=document.getElementById("nombres").value;
    let apellidos=document.getElementById("apellidos").Value;
    let ndocumento=document.getElementById("ndocumento").value;
    let ncelular=document.getElementById("ncelular").value;
    let direccion=document.getElementById("direccion").value;
    let municipio=document.getElementById("municipio").value;
    let correo=document.getElementById("correo").value;
    let contraseña=document.getElementById("contraseña").value;
    let vcontraseña=document.getElementById("vcontraseña").value;
    let autorizacion=document.getElementById("autorizacion").value;

    if(nombres===""|| apellidos==="" || ndocumento==="" ||
        ncelular==="" ||correo ==="" ||direccion===""|| municipio==="" || contraseña==="" || 
        vcontraseña===""|| autorizacion===""){
        document.getElementById("mensaje").innerText="TODOS LOS CAMPOS SON OBLIGATORIOS";
        return;
    };
    let mensaje="Cliente registrado: \n\nnombres: " + nombres + "\napellidos: " + apellidos + 
    "\nndocumento" + ndocumento + "\nncelular: " + ncelular + "\ndireccion: " + direccion + 
    "\nmunicipio: " + municipio + "\ncorreo: " + correo+ "\ncontraseña: "  + contraseña + 
    "\nvcontraseña: " + vcontraseña + "\nautorizacion: " + autorizacion;

    document.getElementById("mensaje").innerText= mensaje;
    document.getElementById("formulario").reset();
}
