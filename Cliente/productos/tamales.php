<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="http://localhost/PAN-Y-MAS/Cliente/css/catalogo.css">
    <link rel="stylesheet" type="text/css" href="../css/tamales.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>PAN Y MAS</title>
</head>
<body>
    <header class="head">
        <a class="contenedor-log" href=""> <figure class="logocorp"></figure></a>
        <button id="abnav" class="ab-nav"><i class="bi bi-list"></i></button>
         <nav class="nav "  id="nav">
             <button id="crnav" class="cr-nav"><i class="bi bi-x-circle"></i></button>
             <ul class="ul">
                 <li><a href="../catalogo/catalogo.php">INICIO</a></li>
                 <li><a class="nosotros" id="snosotros" href="../pedido/pedido.php">PEDIDOS ONLINE</a></li>
                 <li><a class="nosotros" id="snosotros" href="../sobre_nosotros/snosotros.php">SOBRE NOSOTROS</a></li>
             </ul>
         </nav>
       <article class="ar0">
         <button id="abrir" class="ar1">
             <i class="bi bi-person-circle"></i>
             </button>
             <nav class="navse " id="navj">
                 <button id="cerrar" class="ar2"><i class="bi bi-x-lg"></i></button>
                 <ul class="nav-con">
                     <lia><a href="../perfil/perfil.php">Configuración del perfil</a></li>
                     <li><a href="">Cerrar sesión </a></li>
                 </ul>
             </nav>
         </article>
       </article>
    </header>
    
     <section class="fondo">
        <section class="p1">
        <article class="produc" id="productos">
            <div class="img1"></div>
            <h2 class="subtitulo">PAN GRANDE</h2>
            <a class="a" href=""><input type="button"value="VER MÁS" required></a>
        </article>
        <article class="ventana">
            <article class="fondo2">
                <article class="ventana-contenido">
                    <figure class="cerrar">                
                        <a href="../catalogo/catalogo.php"><span class="material-symbols-outlined" style="font-size: 60px;">
                            close_small
                            </span>
                        </a>    
                    </figure>
                    <div class="imgmpr">
                    </div>
                    <article class="descripcion">
                        <h1 class="titulo">TAMALES</h1>
                        <p class="precio"><b>5.000 COP</b></p>
                        <p class="descripcion"><b>DESCRIPCIÓN:</b>Tamal de tres carnes (res, cerdo, pollo)con huevo 
                        </p>
                        <p class="stock"><b>CANTIDAD DISPONIBLE:</b> 20
                        </p>
                        <article class="botones">
                                <input type="number"value="1" min="1" max="100">     
                        </article>    
                        <article class="añadir-carrito">
                            <input type="button" value="Añadir al carrito">
                        </article>
                    </article>
                   
                </article>
            </article>
        </article>

        <article class="produc" id="productos">
            <div class="img2"></div>
            <h2 class="subtitulo">CROASANT</h2>
            <a class="a" href="/productos/crasan.html"><input type="button" id="servicio"onclick="ndisponible()" value="VER MÁS" required></a>
        </article>
        <article class="produc" id="productos">
            <div class="img3"></div>
            <h2 class="subtitulo">PASTELES</h2>
            <a class="a" href=""><input type="button" id="servicio"onclick="ndisponible()" value="VER MÁS"required></a>
        </article>
        <article class="produc" id="productos">
            <div class="img4"></div>
            <h2 class="subtitulo">TAMALES</h2>
            <a class="a" href=""><input type="button"id="servicio"onclick="ndisponible()" value="VER MÁS"required></a>
        </article>
        <article class="produc" id="productos">
            <div class="img5"></div>
            <h2 class="subtitulo">LECHE ASADA</h2>
            <a class="a" href=""><input type="button"id="servicio"onclick="ndisponible()" value="VER MÁS"required></a>
        </article>
        <article class="produc" id="productos">
            <div class="img6"></div>
            <h2 class="subtitulo">GALLETAS</h2>
            <a class="a" href=""><input type="button"id="servicio"onclick="ndisponible()" value="VER MÁS"required></a>
        </article>
     </section>
     <script src="../js-inicio/inicio scrip.js"></script>
     </section>
</body>
</html>