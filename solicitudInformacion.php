<?php
    include_once('php_dbinfo.php');

    // Declare Global Variables
    $uploadOk = null;
    
    if(isset($_POST["submit"])){

        // Declare variables
        $nombre = $_POST['nombre'];
        $apaterno = $_POST['apaterno'];
        $amaterno = $_POST['amaterno'];
        $sexo = $_POST['sexo'];
        $dateBirth = $_POST['dateBirth'];
        $pais = $_POST['pais'];
        $estado = $_POST['estado'];
        $municipio = $_POST['municipio'];
        $email = $_POST['email'];
        $escolaridad = $_POST['escolaridad'];
        $ocupacion = $_POST['ocupacion'];
        $empresa = $_POST['empresa'];
        $cargo = $_POST['cargo'];
        $usoInformacion = $_POST['usoInformacion'];
        if (isset($_POST['tipoInformacion'])) {
            $tipoInformacion = "Sin datos";
         }else{
            $tipoInformacion = $_POST['tipoInformacion'];
         }
        $nombreProyecto = $_POST['nombreProyecto'];
        $informacionSolicitada = $_POST['informacionSolicitada'];

        // Check Variables
        // Check Nombre
        if (!$nombre) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Nombre</div>';
            $uploadOk = 0;
        }

        // Check Apellido Paterno
        if (!$apaterno) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Apellido Paterno</div>';
            $uploadOk = 0;
        }

        // Check Apellido Materno
        if (!$amaterno) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Apellido Materno</div>';
            $uploadOk = 0;
        }

        // Check Date of Birth
        if (!$dateBirth) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Fecha de Nacimiento</div>';
            $uploadOk = 0;
        }

        // Check País
        if (!$pais) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin País</div>';
            $uploadOk = 0;
        }

        // Check Estado
        if (!$estado) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Estado</div>';
            $uploadOk = 0;
        }

        // Check Municipio
        if (!$municipio) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Municipio</div>';
            $uploadOk = 0;
        }

        // Check Email
        if (!$email) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Email</div>';
            $uploadOk = 0;
        }

        // Check Escolaridad
        if (!$escolaridad) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Escolaridad</div>';
            $uploadOk = 0;
        }

        // Check Ocupación
        if (!$ocupacion) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Ocupación</div>';
            $uploadOk = 0;
        }

        // Check Empresa
        if (!$empresa) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Institución o Empresa</div>';
            $uploadOk = 0;
        }

        // Check Cargo
        if (!$cargo) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Cargo</div>';
            $uploadOk = 0;
        }

        // Check uso información
        if (!$usoInformacion) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Uso de Información</div>';
            $uploadOk = 0;
        }

        // Check Nombre del Proyecto
        if (!$nombreProyecto) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Nombre del Proyecto</div>';
            $uploadOk = 0;
        }

        // Check Escolaridad
        if (!$informacionSolicitada) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error:</strong> Sin Información a Solicitar</div>';
            $uploadOk = 0;
        }

        // Check upload information

        if ($uploadOk == 1) {
            $query = "INSERT INTO solicitudes (nombre, apaterno, amaterno, sexo, fecha, pais, estado, municipio, email, escolaridad, ocupacion, empresa, cargo, usoinfo, fininfo, nproyecto, infosol, fsolicitud) VALUES ('".$nombre."','".$apaterno."','".$amaterno."','".$sexo."','".$fecha."','".$pais."','".$estado."','".$municipio."','".$email."','".$escolaridad."','".$ocupacion."','".$empresa."','".$cargo."','".$usoInformacion."','".$tipoInformacion."','".$nombreProyecto."','".$informacionSolicitada."')";
            $result = mysql_query($query);
            if (!$result) {
                    die('Invalid query: ' . mysql_error());
            }else{
                echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>La solicitud de información se realizó satisfactoriamente.</strong></div>';
            }     
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>LNMySR</title>
        <link href="/LNMYSR/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            //<![CDATA[

            // Declare variables
            var estado;
            var estacion;
            var municipio;
            var urlRequestEstaciones;
            var urlRequestMunicipios;
            var markers = [];
            var xml;
            var statusMarkers = 0;
            var minLat;
            var latMunicipio;
            var lngMunicipio;
            var maxLng;
            var validationStatus = 0;
            var maxCharacters = 400;
            var numCharacters;

            function downloadUrl(url, callback) {
                var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                  request.onreadystatechange = doNothing;
                  callback(request, request.status);
                }
              };

              request.open('GET', url, true);
              request.send(null);
            }

            function doNothing() {}

            function selectMunicipio(str){
                estado = str;
                if (estado == "99") {
                    document.getElementById("MunicipioInput").innerHTML = "<label for=\"municipio\">Municipio:</label><input type=\"text\" class=\"form-control\" name=\"municipio\">";
                
                }else{
                    
                }
                    urlRequestMunicipios = "php_getMunicipiosSolicitudInformacion.php?estado=" + estado;
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("MunicipioSelect").innerHTML = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("GET", urlRequestMunicipios, true);
                    xmlhttp.send();
                }

            function validationForm(str){
                
                if (validationStatus == 0) {
                    document.getElementById("buttonSend").innerHTML = "<input name=\"submit\" type=\"submit\" value=\"Enviar\" class=\"btn btn-success\"></input>";
                    validationStatus = 1;
                }else{
                    document.getElementById("buttonSend").innerHTML = "";
                    validationStatus = 0;
                }
                
            }

            function validationInfo(str){
                if (str == "Uso Profesional") {
                    document.getElementById("tipoInformacion").innerHTML = "<label for=\"tipoInformacion\">Tipo de Uso</label><select class=\"form-control\" id=\"tipoInformacion\" name=\"tipoInformacion\"><option value=\"T_Licenciatura\">Tesis Licenciatura</option><option value=\"T_Maestria\">Tesis Maestría</option><option value=\"T_Doctorado\">Tesis Doctorado</option></select>";
                }else{
                    document.getElementById("tipoInformacion").innerHTML = "";
                }
            }

            function showCharacters(str){
                if (str.length == 0) {
                    document.getElementById("caracteresRestantes").innerHTML = maxCharacters;
                }else{
                    numCharacters = maxCharacters - str.length;
                    document.getElementById("caracteresRestantes").innerHTML = numCharacters;
                    if (numCharacters <= 0) {
                        document.getElementById("caracteresRestantes").innerHTML = "El número máximo de caracteres es: " + maxCharacters;
                    };
                }
            }
            //]]>
        </script>
    </head>
    <?php include("/includes/header.html");?>
    <body>
        <h1 class="text-center">Solicitud de Información Climatológica del INIFAP</h1>
        <br>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                <div class="col-sm-6">
                    <form class="form-horizontal" role="form" action="solicitudInformacion.php" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre(s):</label>
                            <input type="text" class="form-control" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="apaterno">Apellido Paterno:</label>
                            <input type="text" class="form-control" name="apaterno" placeholder="">  
                        </div>
                        <div class="form-group">
                            <label for="amaterno">Apellido Materno:</label>
                            <input type="text" class="form-control" name="amaterno" placeholder="">  
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <select class="form-control" name="sexo">
                                <option value="1">Hombre</option>
                                <option value="3">Mujer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dateBirth">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" name="dateBirth"> 
                        </div>
                        <div class="form-group">
                            <label for="pais">País:</label>
                            <input type="text" class="form-control" name="pais"> 
                        </div>
                       <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select onchange="selectMunicipio(this.value)" class="form-control" name="estado">
                                <?php include_once('php_getEstadosSolicitud.php');?>
                            </select> 
                        </div>
                       <div id="MunicipioSelect" class="form-group"> 
                       </div>
                       <div id="MunicipioInput" class="form-group">
                       </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="escolaridad">Escolaridad:</label>
                            <select class="form-control" name="escolaridad">
                                <option value="0">Selecciona tu escolaridad</option>
                                <option value="Primaria">Primaria</option>
                                <option value="Secundaria">Secundaria</option>
                                <option value="Primaria">Bachillerato</option>
                                <option value="CarreraT">Carrera Técnica</option>
                                <option value="Licenciatura">Licenciatura/Ingeniería</option>
                                <option value="Posgrado">Posgrado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ocupacion">Ocupación:</label>
                            <select class="form-control" name="ocupacion">
                                <option value="0">Selecciona una ocupación</option>
                                <option value="Primaria">Estudiante</option>
                                <option value="Secundaria">Profesor/Investigador</option>
                                <option value="FuncionarioFederal">Funcionario Público Federal</option>
                                <option value="FuncionarioEstatal">Funcionario Público Estatal</option>
                                <option value="FuncionarioMunicipal">Funcionario Público Municipal</option>
                                <option value="FuncionarioOrganismos">Funcionario de Organismos Autónomos</option>
                                <option value="Empresario">Empresario</option>
                                <option value="Empleado">Empleado</option>
                                <option value="Profesionista">Profesionista</option>
                                <option value="Medios">Medios de Comunicación</option>
                                <option value="AmaCasa">Ama de Casa</option>
                                <option value="Jubilado">Desempleado/Jubilado/Pensionado</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="empresa">Institución o Empresa:</label>
                            <input type="text" class="form-control" name="empresa"> 
                        </div>
                        <div class="form-group">
                            <label for="cargo">Cargo:</label>
                            <select class="form-control" name="cargo">
                                <option value="0">Selecciona un cargo</option>
                                <option value="Directivo">Directivo</option>
                                <option value="Administrativo">Administrativo</option>
                                <option value="Gerente">Gerente</option>
                                <option value="Mando Medio">Mando Medio</option>
                                <option value="Profesor">Profesor</option>
                                <option value="Enlace">Enlace</option>
                                <option value="Supervisor">Supervisor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usoInformacion">Uso de la Información:</label>
                            <select onchange="validationInfo(this.value)" class="form-control" name="usoInformacion">
                                <option value="0">Selecciona una opción</option>
                                <option value="Proyectos INIFAP">Para uso en proyectos de investigación, validación y transferencia de tecnología del INIFAP</option>
                                <option value="Proyectos Investigación Externos">Para uso en proyectos de Centros e Institutos de investigación, validación y transferencia de tecnología</option>
                                <option value="Cambio Climatico">Estudios de cambio climático</option>
                                <option value="Caracterizacion clima regional">Caracterización climática regional</option>
                                <option value="Uso Profesional">Con fines de uso profesional o preparación académica</option>
                            </select>
                        </div>
                        <div id="tipoInformacion" class="form-group">  
                        </div>
                        <div class="form-group">
                            <label for="nombreProyecto">Nombre del Proyecto:</label>
                            <input type="text" class="form-control" name="nombreProyecto"> 
                        </div>
                        <div class="form-group">
                            <label for="informacionSolicitada">Información a Solicitar:</label>
                            <textarea onkeyup="showCharacters(this.value)" type="text" class="form-control" name="informacionSolicitada"></textarea>
                            <p>Caracteres restantes: <span id="caracteresRestantes"></p> 
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#myModal">Aviso para el Solicitante</button>
                        </div>
                        <div class="checkbox">
                            <label><input onchange="validationForm(this.value)" type="checkbox" id="checkbox">Esta de acuerdo con las condiciones de uso de la información de la Red de Estaciones Agroclimatológicas</label>
                        </div>
                        <br>
                        <div id="buttonSend" class="form-group">        
                            
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <p align="justify"><b>AVISO DE PRIVACIDAD</b><br>
                        Los datos personales que en su caso nos proporcione serán protegidos conforme a lo dispuesto por la Ley Federal de Transparencia y Acceso a la Información Pública Gubernamental, su Reglamento, los Lineamientos de Protección de Datos Personales, publicados en el D.O.F., el 30 de septiembre de 2005.
                    </p>    
                </div>
            </div> 
            </div> 
        </div>
    </body>
    <?php include("/includes/footer.html");?>
</html>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">AVISO PARA EL SOLICITANTE</h4>
      </div>
      <div class="modal-body">
        <p align="justify">El presente documento es obligatorio para el SOLICITANTE y el INIFAP, respecto a la información climatológica que integra el INIFAP, relacionada en el anexo que acompaña a este instrumento, en adelante la INFORMACIÓN. Al utilizar la INFORMACIÓN el SOLICITANTE se obliga a sujetarse a los términos que a continuación se describen:
CONDICIONES DE USO DE LA INFORMACIÓN DE LA RED DE ESTACIONES AGROCLIMATOLÓGICAS
El INIFAP concede al SOLICITANTE el derecho para utilizar la Información, siempre y cuando cumpla con todos los términos y condiciones de este instrumento, mismos que se señalan a continuación:

<br>1.- Uso de la INFORMACIÓN.-

<br>1.1 El INIFAP proporcionará al SOLICITANTE la Información bajo los presentes términos.
<br>1.2 El SOLICITANTE puede:
<br>a) Utilizar la Información como insumo de sus productos o servicios, sin fines de lucro, otorgando los
créditos correspondientes al INIFAP como origen y mencionando la fuente de extracción de la
información y el nombre de la misma;
<br>1.3 El SOLICITANTE en ningún caso podrá:
<br>a) Comercializar la Información que se le entregue con motivo de este instrumento;
<br>b) Utilizar procesos tendientes a identificar a los informantes de la Información que se proporciona;
<br>c) Distribuir a través de ninguna forma o por cualquier medio, ya sea electrónica, mecánica,
fotocopia, por registro u otros medios, sin el permiso previo y por escrito a la Institución.
<br>1.4 Cuando El SOLICITANTE reciba información con cobertura estatal, regional o nacional deberá
notificar por escrito al INIFAP sobre los proyectos en que la utilizó, y en caso de continuar haciendo 
uso de la misma deberá reportarlo a la conclusión de su proyecto.
Para lo anterior, el solicitante deberá contestar, signar y enviar escaneado el formulario que el
INIFAP le proporcione a la cuenta de correo electrónico solicitud.clima@inifap.gob.mx
El uso no autorizado en contravención a las disposiciones antes previstas, podrá ser sancionado de
acuerdo con la legislación aplicable.

<br>2.- Propiedad de la Información.-

El INIFAP es propietario de la Información, pudiendo ceder el uso de la misma a otros solicitantes,
por lo cual el solicitante deberá sujetarse a las condiciones de uso establecidas en este instrumento.
En el momento que el SOLICITANTE de a conocer información proporcionada por el INIFAP deberá
expresar lo siguiente:
<br>a) Otorgar de manera pública los créditos correspondientes al INIFAP, señalándolo como fuente
básica de la información climatológica, indicando la siguiente leyenda: DATOS OBTENIDOS DE
LA RED ESTATAL DE ESTACIONES AGROCLIMATOLÓGICAS, y/o;
<br>b) En caso de que la generación de los productos, sea por medio de tabulados, gráficas,
ilustraciones, mapas, etc., deberá señalarse que se encuentran basados en información del
INIFAP e indicar la fuente de información de la siguiente manera, Fuente: INSTITUTO
NACIONAL DE INVESTIGACIONES FORESTALES, AGRICOLAS Y PECUARIAS y nombre del
producto: INFORMACIÓN DE LA RED ESTATAL DE ESTACIONES AGROCLIMATOLÓGICAS.

<br>3.- Daño.-

El INIFAP no será responsable por los daños de cualquier naturaleza (incluyendo entre otros,
pérdida de información) que se deriven del uso o la imposibilidad de uso de la Información. En
cualquier caso, la responsabilidad total del INIFAP derivada de cualquier disposición del presente
instrumento se limitará a la reposición de la INFORMACIÓN.

<br>4.- Exclusión de responsabilidades.-

El INIFAP no se hará responsable por la interpretación y aplicación que el SOLICITANTE haga de los resultados obtenidos a través del uso de la información; por ello, cualquier decisión basada en tal criterio sujeto de juicio, excluye al INIFAP de responsabilidad alguna. Así mismo, se exime al INIFAP de cualquier asunto relacionado con diferencias obtenidas por precisiones, redondeos o truncamientos numéricos, así como por cambios técnicos o tecnológicos que puedan incidir en tales resultados.
El INIFAP podrá pedir al SOLICITANTE en cualquier momento que se retiren de distribución los productos generados a partir de la información proporcionada por estas condiciones de uso, en los cuales se haga un uso indebido o erróneo de la información.
Por lo anterior, es responsabilidad del SOLICITANTE la interpretación y aplicación de los resultados de la información en todas sus variantes, así como lo relacionado con la operación, supervisión y control del mismo.

<br>5.- Vigencia.-

La vigencia de este documento será por tiempo indefinido siempre que no contravengan los términos establecidos en este instrumento.

<br>6.- Confidencialidad.-

El SOLICITANTE y el INIFAP, se comprometen a respetar la confidencialidad, respecto a la información que llegaran a entregar, utilizar o producir con motivo de este instrumento.

<br>7.- Legislación aplicable y jurisdicción.-

El presente documento se regirá por la Ley del Sistema Nacional de Información Estadística y Geográfica, así como por la normatividad aplicable en la materia, en caso de existir controversia, se someterán a la jurisdicción y competencia de los Tribunales Federales de la Ciudad de México, D.F., renunciando el SOLICITANTE al fuero que pudiera corresponderle por razón de domicilio presente, futuro o cualquier otra causa.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date(); a = s.createElement(o),
        m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-38548366-1', 'auto');
    ga('send', 'pageview');
</script>