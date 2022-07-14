<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('unsaac.png',160,0,33);
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,20,utf8_decode('REPORTE'),0,0,'C');
     $this->Ln(5);
    $this->Cell(0,30,utf8_decode('Alumnos que No serán Tutorados en 2022 - I'),0,0,'C');
    // Salto de línea
    $this->Ln(30);
    $this->Cell(20,7, 'Codigo',1,0,'C',0);
	$this->Cell(60,7, 'Apellido Paterno',1,0,'C',0);
	$this->Cell(60,7, 'Apellido Materno',1,0,'C',0);
	$this->Cell(50,7, 'Nombres',1,1,'C',0);
}
// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('UNSAAC - Grupo 2 - Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}
include('conexion.php');
$consulta = "select T2.Codigo, T2.Apellido_Paterno, T2.Apellido_Materno, T2.Nombre 
            from matriculados T1 
            RIGHT OUTER JOIN distrubuciondocente T2 
            ON T1.Codigo = T2.Codigo 
            WHERE T1.Codigo IS NULL";

$resultado = mysqli_query($con,$consulta);

$pdf = new PDF();
$pdf ->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

while($row=$resultado->fetch_assoc()){
	$pdf->Cell(20,7, $row['Codigo'],1,0,'C',0);
	$pdf->Cell(60,7, $row['Apellido_Paterno'],1,0,'C',0);
	$pdf->Cell(60,7, $row['Apellido_Materno'],1,0,'C',0);
	$pdf->Cell(50,7, $row['Nombre'],1,1,'C',0);
}
$pdf->Output();

?>
