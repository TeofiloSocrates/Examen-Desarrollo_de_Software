<?php
include("conexion.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Informatica - T</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="Estilos.css" rel="stylesheet" type="text/css" />
</head>
<body>
<center>
<div class="SubCont">
<br>
    <div class="Cont">
    <form method="post" action="tutoria.php">
        <br>
        <table>
            <tr>
                <th width="100"></th>
                <th width="500"><h1 class="h1">Tutorias - Unsaac</h1></th>
                <th width="150"><img src="unsaac.png" width="150" height="200" ></th>
            </tr>
        </table>
        <div class="Opcion">
            <label>
                <input type="radio" name="radioButton" value="1" checked> Mostrar Alumnos que No serán Tutorados en 2022 - I
            </label>
            <p class="link"><a href="reporte.php "><img src="icono-pdf.png" width="30" height="30"></a></p>
            <br>
            <br>
            <label>
                <input type="radio" name="radioButton" value="2" > Mostrar  Alumnos para Tutoría
            </label>
            <p class="link"><a href="reporte2.php "><img src="icono-pdf.png" width="30" height="30"></a></p>
        </div>
        <div class="boton">
            <button name="button" class="btn">Buscar</button>
        </div>
        <hr width="820px">
        <center><h3 class="Tex">Resultados</h3></center>
        <?php
        if($_REQUEST['radioButton']=="1"){
            $consulta = "select T2.Codigo, T2.Apellido_Paterno, T2.Apellido_Materno, T2.Nombre 
            from matriculados T1 
            RIGHT OUTER JOIN distrubuciondocente T2 
            ON T1.Codigo = T2.Codigo 
            WHERE T1.Codigo IS NULL";
        }
        if ($_REQUEST['radioButton']=="2") {
            $consulta = "select T1.Codigo, T1.Apellido_Paterno, T1.Apellido_Materno, T2.Nombre 
            FROM matriculados T1 
            LEFT OUTER JOIN distrubuciondocente T2 
            ON T1.Codigo = T2.Codigo";
        }
        $Alumno = mysqli_query($con, $consulta);
        if ($Alumno){
        // si hay Estudiantes
            // Dibujar una tabla
            echo "<table class='lista' cellpadding='0' cellspacing='0' width=830px;>";
            echo "<tr><th class='tablasolicitud'>Codigo</th><th class='tablasolicitud'>Apellido Paterno</th><th class='tablasolicitud'>Apellido Materno</th><th class='tablasolicitud'>Nombres</th></tr>";
            //$clase = '"Celdalogin"';
            while (($fila = mysqli_fetch_assoc($Alumno)) != null){
                $codigo = $fila['Codigo'];
                $ap_paterno = $fila['Apellido_Paterno'];
                $ap_materno = $fila['Apellido_Materno'];
                $nombres = $fila['Nombre'];
                echo "<tr>";
                echo "<td class='celdacodigo'>$codigo</td>";
                echo "<td class='celdadatospersonales'>$ap_paterno</td>";
                echo "<td class='celdadatospersonales'>$ap_materno</td>";
                echo "<td class='celdadatospersonales'>$nombres</td>";
                echo "</tr>";
            }
            echo "</table><br>";
        }
        else{
            echo "<script>alert('No hay alumnos ....')</script>";
        }
        
        ?>

        
    </form>
    </div>
    <br>
    <hr>
</div>

</center>
</body>
</html>