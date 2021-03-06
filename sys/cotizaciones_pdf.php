<?php
require("fpdf/fpdf.php");
include("funciones/basedatos.php");
require("funciones/funciones.php");
/*18 Mar 2016*/
$titulo = substr_count($_SERVER['PHP_SELF'], 'tornero') > 0 ? "La Casa Del Tornero" : "HC Aceros y Servicios";
/*18 Mar 2016*/

function sector($sector,$tipo){
  if($tipo == "f"){
    $t = "factura";
  } else {
    $t = "nota";
  }
	$s = "SELECT * FROM vectores WHERE sector = '{$sector}' AND tipo = '{$t}'";
  //echo $s."<br>";
	$q = mysql_query($s);
	return mysql_fetch_assoc($q);
}

function celda($x,$tipo){
  if($tipo == "f"){
    $t = "factura";
  } else {
    $t = "nota";
  }
	$s = "SELECT porcentaje FROM vectores_productos WHERE columna = '{$x}' AND tipo = '{$t}'";
	$q = mysql_query($s);
	$r = mysql_fetch_assoc($q);
	return $r[porcentaje];
}

Conectar();

$pdf=new FPDF('P','pt',array(611,804));
$pdf->AddPage();
$pdf->SetFont('courier','',9);
$pdf->SetMargins(0,0,0);
$pdf->SetDrawColor(150,150,150);

//$pdf->Cell(611,734,"",1,1,"R");
//$pdf->Output();
//exit;

$s = "SELECT
c.*,
u.nombre vendedor
FROM
cotizaciones c
LEFT JOIN usuarios u ON u.id_usuario = c.id_facturista
WHERE folio = '{$_GET[folio]}'";
$q = mysql_query($s) or die (mysql_error());
$r = mysql_fetch_assoc($q);
$importe = $r[importe];
$tipo = $r[tipo];
$facturista = $r[vendedor];

/*
$cliente_direccion = $r[cliente_direccion];
$cliente_nombre = $r[nombre];
$cliente_rfc = $r[cliente_rfc];
*/
$vendedor = $r[vendedor];

$vendedor = explode(" ",$vendedor);
foreach($vendedor as $v)
{
	$vendedor_v .= $v[0];
}

$pdf->SetXY(10,10);
$pdf->MultiCell(200,15,strtoupper($vendedor_v),0);
$pdf->SetXY(0,0);

$sq = "SELECT
cotizaciones_productos.cantidad,
cotizaciones_productos.precio,
cotizaciones_productos.iva,
cotizaciones_productos.importe,
productos.codigo_barras,
IF(
	 cotizaciones_productos.id_producto = 0,
	 especial,
	 productos.descripcion
	 ) descripcion,
IFNULL(cotizaciones_productos.complemento,NULL) 'complemento'
FROM
cotizaciones_productos
LEFT JOIN productos ON cotizaciones_productos.id_producto = productos.id_producto
WHERE folio_cotizacion = '{$_GET[folio]}'
GROUP BY cotizaciones_productos.id_cotizacionproducto";
$qq = mysql_query($sq) or die (mysql_error());
require("funciones/CNumeroaLetra.php");

$logo_s = "SELECT * FROM vars";
$logo_q = mysql_query($logo_s);
$logo_r = mysql_fetch_assoc($logo_q);

// ==== ENCABEZADO
$pdf->Image("logo/".$logo_r[logotipo],36,30,0,80);
$pdf->SetFillColor(64,64,64);
$pdf->SetFont('Arial','',12);
$pdf->SetXY(150,50);
$pdf->Cell(280,13, $titulo . " S.A. De C.V.",0,0,"C");  

$pdf->SetFont('Arial','',10);
$pdf->SetXY(150,68);
$pdf->Cell(280,12,"Tel�fono (01 999) 9 46 20 56 / 57",0,0,"C");  

$pdf->SetXY(150,84);
$pdf->Cell(280,12,"Calle 110 por 75 No. 631",0,0,"C");  

$pdf->SetXY(150,100);
$pdf->Cell(280,12,"M�rida, Yucat�n, M�xico C.P. 97256",0,0,"C");  

$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(255,255,255);
$pdf->SetXY(440,34);
$pdf->Cell(130,14,"COTIZACION",0,1,"C",1);  

$pdf->SetFont('Arial','B',13);
$pdf->SetTextColor(255,0,0);
$pdf->SetXY(440,48);
$pdf->Cell(130,26,$_GET[folio],1,1,"C");  
$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(255,255,255);
$pdf->SetXY(440,86);
$pdf->Cell(130,14,"FECHA",0,1,"C",1);  

$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','',11);
$pdf->SetXY(440,100);
$pdf->Cell(130,20,FormatoFecha($r[fecha]),1,1,"C");  

$pdf->SetFont('Arial','B',11);
$pdf->SetXY(36,136);
$pdf->Cell(534,12,"DATOS DEL CLIENTE",0,1,"L");  
$pdf->SetXY(36,132);
$pdf->Cell(534,66,NULL,1,1,"L");

$pdf->SetFont('Arial','',9);
$pdf->SetXY(36,150);
$pdf->Cell(534,12,$r[cliente],0,1,"L");
$pdf->SetXY(36,162);
$pdf->Cell(534,12,$r[datos_cliente],0,1,"L");
/*$pdf->SetXY(36,174);
$pdf->Cell(534,12,$cliente_direccion,0,1,"L");
*/
$pdf->SetXY(36,644);
$pdf->Cell(370,12,"IMPORTE EN LETRAS",0,1,"L");
$pdf->SetXY(36,640);
$pdf->Cell(370,50,NULL,1,1,"L");
$numalet= new CNumeroaletra;
$numalet->setNumero($importe);
$numalet->setMayusculas(0);
$numalet->setGenero(0);
$numalet->setMoneda($r[moneda] == "M.N." ? "PESOS" : "DOLARES");
$numalet->setPrefijo("");
$numalet->setSufijo($r[moneda] == "M.N." ? "M.N." : "");
$pdf->SetXY(36,658);
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(370,12,"SON: ".strtoupper($numalet->letra()),0,1,"L");
$pdf->SetFont('Arial','B',11);

$pdf->SetXY(414,640);
$pdf->Cell(155,50,NULL,1,1,"L");

$pdf->SetXY(160,698);
$pdf->Cell(300,48,"  Realiz�: ",1,1,"L"); 
$pdf->Line(234,728,424,728);
$pdf->SetFont('Arial','',11);
$pdf->SetXY(282,731);
$pdf->Cell(200,12,$facturista,0,1,"L"); 
// === FIN DE ENCABEZADO

$secs = array("Tabla_de_Productos" => array("Esta es la Tabla de Productos", "L"),
							//"Total" => array(0,"R"),
							//"Fecha" => array($r[fecha_factura])
							);

foreach($secs as $k => $v){
	$s = sector(str_replace("_"," ",$k),$tipo);
	if($k == "Tabla_de_Productos"){
		$a = $s[ancho];
		$w = array($a*(celda("cantidad",$tipo)/100),
							 $a*(celda("descripcion",$tipo)/100),
							 $a*(celda("precio",$tipo)/100),
							 $a*(celda("importe",$tipo)/100)
							);
		$x = $s[x];
		$y = $s[y];

		$pdf->SetXY($s[x],$s[y]);
		
		// === CABECERA DE PRODUCTOS
		$pdf->SetTextColor(255,255,255);
		$pdf->SetFont('Arial','B',9);
		$pdf->SetX($s[x]); //Arrimar hacia la izquierda
		$pdf->Cell($w[0],20,"CANTIDAD",0,0,"C",1); //Cantidad
		
		$y1 = $pdf->GetY();
		$pdf->Cell($w[1],20,"CONCEPTO",0,0,"C",1);
		$y2 = $pdf->GetY();
		$yH = $y2 - $y1;
		$pdf->SetXY($x + $w[1] + $w[0], $pdf->GetY() - $yH);
						
		$pdf->Cell($w[2],20,"P.U.",0,0,"C",1);
		$pdf->Cell($w[3],20,"IMPORTE",0,0,"C",1);
		$pdf->Cell(.001,$yH,"",0,1,"R");
		
		$pdf->SetXY($s[x]+$w[0],$s[y]+20);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','',9);
		// === FINALIZA CABECERA DE PRODUCTOS
		while($r = mysql_fetch_assoc($qq)){
			$sub_total += round($r[cantidad]*$r[precio],2);
			$iva += round($r[cantidad]*$r[precio]*($r[iva]/100),2);
			
			$pdf->SetX($s[x]); //Arrimar hacia la izquierda
			$pdf->Cell($w[0],15,$r[cantidad]."     ",0,0,"C"); //Cantidad
			
			$y1 = $pdf->GetY(); //Indexar Y1
			
			$descripcion = $r[descripcion];
			if($r[complemento] != "0")
			{
				$descripcion .= "\n".$r[complemento];
			}					
			$pdf->MultiCell($w[1],15,$descripcion,0); //Descripci�n
			$y2 = $pdf->GetY(); //Indexar Y2
			$yH = $y2 - $y1; // Diferencia
			$pdf->SetXY($x + $w[1] + $w[0], $pdf->GetY() - $yH); //Reindexar X
							
			$pdf->Cell($w[2],15,number_format($r[precio],2)."  ",0,0,"C"); //Precio
			$pdf->Cell($w[3],15,number_format($r[cantidad]*$r[precio],2)."  ",0,0,"C"); //Importe
			$pdf->Cell(.001,$yH,"",0,1,"R"); //Invisible!!        
		}
	} else {
		switch($k){
			case "Total": $v[0] = money($importe); break;
		}
		$pdf->SetXY($s[x],$s[y]);
		$pdf->MultiCell($s[ancho],13,$v[0],0,$v[1]);
	}
	
	//CARNE: IMPORTES
	$pdf->SetFont('Arial','',11);
	$pdf->SetXY(420,644);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(72,12,"SUBTOTAL  ",0,0,"R");
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(76,12,number_format($sub_total,2),0,1,"L");
	$pdf->SetXY(420,660);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(72,12,"I.V.A.  ",0,0,"R");
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(76,12,number_format($iva,2),0,1,"L");
	$pdf->SetXY(420,676);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(72,12,"TOTAL  ",0,0,"R");
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(76,12,number_format($importe,2),0,1,"L");
	//FIN CARNE: IMPORTES
	
}
$pdf->Output();
?>