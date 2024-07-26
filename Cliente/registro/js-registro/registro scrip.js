function registrarcliente(){
    let nombres=document.getElementById("nombres").value;
    let apellidos=document.getElementById("apellidos").Value;
    let =document.getElementById("tipo_docu")
    let numerodocumento=document.getElementById("numerodocumento").value;
    let numerotelefonico=document.getElementById("numerotelefonico").value;
    let direccion=document.getElementById("direccion").value;
    let municipio=document.getElementById("municipio").value;
    let correo=document.getElementById("correo").value;
    let contraseña=document.getElementById("contraseña").value;
    let confirmacion=document.getElementById("confirmacion").value;
    let autorizacion=document.getElementById("autorizacion").value;

    if(nombres===""|| apellidos==="" ||tipo_docu|| numerodocumento==="" ||
        numerotelefonico==="" ||correo ==="" || municipio==="" || contraseña==="" || 
        confirmacion===""|| autorizacion===""){
        document.getElementById("mensaje").innerText="TODOS LOS CAMPOS SON OBLIGATORIOS";
        return;
    };
    let mensaje="Cliente registrado: \n\nnombres: " + nombres + "\napellidos: " + apellidos + 
    "\nnumerodocumento" +"\tipo_docu" + numerodocumento + 
    "\nnumerotelefonico: " + numerotelefonico + "\ndireccion: " + direccion + 
    "\nmunicipio: " + municipio + "\ncorreo: " + correo+ "\ncontraseña: "  + contraseña + 
    "\nconfimacion: " + confirmacion + "\nautorizacion: " + autorizacion;

    document.getElementById("mensaje").innerText= mensaje;
    document.getElementById("formulario").reset();
}
