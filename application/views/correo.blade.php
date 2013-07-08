<!doctype html>
<html lang="en">
<head>
    
    <style>
        body{
            padding-top: 50px;
        }
        #conten{
            margin-top: 50px;
            background-color: #316A93;
            border-radius: 3px;
        }
        #cuerpo{
            padding-top: 30px;
            padding-bottom: 30px;
            background-color: #3775AF;
            border-radius: 3px;
            color: #FFFFFF;
        }
        #cuerpo a{
            color: #FFFFFF;
        }
        p{
            padding-left: 50px;
        }
        h2{
            color: #FFFFFF;
            padding: 10px 0px 10px 50px;
        }
    </style>

</head>
<body>
    <div id="conten">
        <h2>
            <b> 
                Hola {{ $nombre }} se a realizado un solicitud de restablecimiento de contraseña.
            </b>
        </h2>
    </div>

    <br>
    <br>
    <br>

    <div id="cuerpo">
        <h3>
            <p>
                Tu nombre de usuario es : <b> {{ $rfc }} </b>
            </p>
            <p>
                Tu Nueva Contraseña es : <b> {{ $pass }} </b>
            </p>
            <p>
                Con esta contraseña podrás entrar al sistema recuerda que puedes cambiarla en: 
                <b style="padding-left:50px;"><a href="{{$link}}">Galletitas.com.mx</a></b>
            </p>
            <p>
                Si tu no has realizado esta petición por favor, <b>borra e ignora este mensaje</b>, disculpa las molestias. Enviado por : Galletitas S.A. de C.V.
            </p>
        </h3>
    </div>
</body>
</html>