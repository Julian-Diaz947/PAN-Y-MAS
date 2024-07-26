/*function ndisponible(){
let servicio=document.getElementById("servicio");
alert("EL CONTENIDO NO SE ENCUENTEERA DISPONIBLE")
};*/
const nav = document.querySelector("#nav");
const abnav=document.querySelector("#abnav");
const crnav =document.querySelector("#crnav");
const abrir= document.querySelector("#abrir")
const cerrar = document.querySelector("#cerrar");
const navj= document.querySelector("#navj");
const abcarrito=document.querySelector("#abcarrito");
const contenido=document.querySelector("#contenido");
const crcarrito=document.querySelector("#crcarrito");

abnav.addEventListener("click",() => {
    nav.classList.add("visible");
})
crnav.addEventListener("click", () => {
    nav.classList.remove("visible");
})
abrir.addEventListener("click",() => {
    navj.classList.add("mostrar");
})
cerrar.addEventListener("click", () => {
    navj.classList.remove("mostrar");
})
abcarrito.addEventListener("click",() => {
    contenido.classList.add("ver");
})
crcarrito.addEventListener("click", () => {
    contenido.classList.remove("ver");
})

