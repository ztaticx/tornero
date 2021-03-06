<?php
if(isset($_POST[enviar_mail]))
{
	//Crear archivos
	$_GET[folio] = $_GET[enviar];
	include("funciones/basedatos.php");
	include("funciones/funciones.php");
	print_r($_POST);
	print_r($_GET);
	if(isCFDI($_GET[serie], $_GET[folio]))
	{
		$d = factura_data($_GET[folio],$_GET[serie]);
		$fecha = explode('-', $d[factura][fecha]);
		$pdf = "{$_GET[serie]}-{$_GET[folio]}.pdf";
		$xml = "{$_GET[serie]}-{$_GET[folio]}.xml";
		$carpeta = "../facturas_archivos/{$d[empresa][rfc]}/{$fecha[0]}/{$fecha[1]}/{$fecha[2]}";
		if(count($d) > 0 and (!file_exists($carpeta."/{$pdf}") or !file_exists($carpeta."/{$xml}")))
		{
			@mkdir("../facturas_archivos/{$d[empresa][rfc]}");
			@mkdir("../facturas_archivos/{$d[empresa][rfc]}/{$fecha[0]}");
			@mkdir("../facturas_archivos/{$d[empresa][rfc]}/{$fecha[0]}/{$fecha[1]}");
			@mkdir($carpeta);
			
			$s = "SELECT * FROM cfdi WHERE folio = '{$_GET[folio]}' AND serie = '{$_GET[serie]}'";
			$q = mysql_query($s) or die (mysql_error());
			$r = mysql_fetch_assoc($q);
			file_put_contents($carpeta."/{$pdf}", $r[pdf]);
			file_put_contents($carpeta."/{$xml}", $r[xml]);
		}
	}
	else
	{
		$smtp_file_xml = $_POST[ruta]."/XML[{$_GET[enviar]}].xml";
		include("ventas_xml.php");
		$smtp_file = $_POST[ruta]."/Factura[{$_GET[enviar]}].pdf";
		include("ventas_spdf.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/dynamic.php">
<link rel="stylesheet" type="text/css" href="css/body.css" />
</head>
<body>
Los archivos se guardaron correctamente.
<script language="javascript" type="text/javascript">
 setTimeout(function(){top.window.hs.close();},5000);	
</script></body>
</html>
<?php
	exit();
}
else
{
	if(isset($_POST[destino]))
	{
		$_GET[folio] = $_GET[enviar];
		include("funciones/basedatos.php");
		include("funciones/funciones.php");
		Conectar();
		switch($_GET[tipo])
		{
			case 0: //Cotización
				$smtp_file = "Cotizacion_{$_GET[enviar]}.pdf";
				file_put_contents($smtp_file, file_get_contents(PATH . "cotizaciones_pdf.php?folio=" . $_GET[enviar]));
				//include("cotizaciones_pdf.php");
				$titulo = "Cotización {$_GET[enviar]}";
				$anexo = "<b>Anexo</b> '{$smtp_file}'";
			break;
			case 1: //Pedido
				$smtp_file = "Orden_{$_GET[enviar]}.pdf";
				include("pedidos_print.php");
				$titulo = "Orden de compra {$_GET[enviar]}";
			break;
			case 2: //Factura
				$smtp_file = "facturas/Factura[{$_GET[enviar]}].pdf";
				$smtp_file_xml = "facturas/XML[{$_GET[enviar]}].xml";
				
				//Crear los archivos CFDI que se enviarán
				if(isset($_POST[cfdi]))
				{
					$s = "SELECT * FROM cfdi WHERE folio = '{$_GET[folio]}' AND serie = '{$_GET[serie]}'";
					$q = mysql_query($s) or die (mysql_error());
					$r = mysql_fetch_assoc($q);
					file_put_contents($smtp_file, $r[pdf]);
					file_put_contents($smtp_file_xml, $r[xml]);
				}
				else
				{
					include("ventas_spdf.php");			
					include("ventas_xml.php");			
				}
				$titulo = "Factura {$_GET[enviar]}";
				$anexo = "<b>Anexos</b> {$smtp_file} {$smtp_file_xml}";
			break;
		}

		if(isset($_POST[con]))
		{
			$d = implode(",",$_POST[destino]);
			$v = "<b>Se envi&oacute; un correo electr&oacute;nico.</b><br />
					{$anexo}<br />
					<b>Remitente</b> {$_POST[remitente]}<br />
					<b>Destinatario(s)</b> {$d}<br />
					$_POST[mensaje]";
			$s = "INSERT INTO notas  VALUES(null,
				NOW(),
			'{$_POST[con]}',
			'{$_SESSION[id_usuario]}',
			'{$v}',
			'0.00',
			'0',
			1)";
			query($s);
		}
		$enviado = mandar_mail($_POST[remitente],$_POST[destino],$titulo,array($smtp_file),array($smtp_file_xml), $_POST[mensaje]);	
		if($_GET[tipo] == 0) @unlink($smtp_file);
		//unlink($smtp_file_xml);
		if($_GET[tipo] == 2)
		{
			//unlink($smtp_file_xml);
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/dynamic.php">
<link rel="stylesheet" type="text/css" href="css/body.css" />
</head>
<body>
<?php
		if(strlen($enviado) == 1) //CORRECTO!!
		{
			echo "<b>El mensaje se ha enviado correctamente.</b>";
		}
		else //ERROR =(
		{
			echo "<b>Ha ocurrido un error y el mensaje no ha sido enviado.<br />Verifique su informaci&oacute;n.</b><pre>{$enviado}</pre>";
		}
?>
<script language="javascript" type="text/javascript">
 setTimeout(function(){top.window.hs.close();},5000);	
</script>
</body>
</html>
<?php
	exit();
   }
}
header("Content-type: text/html; charset=utf-8");
include("funciones/basedatos.php");
include("funciones/funciones.php");
session_start();
$remitente = array();
//obtiene el nombre y correo de la empresa
$s="SELECT * FROM vars";
$q=query($s);
$f=mysql_fetch_assoc($q);
/*if($_GET[serie]== "")
{
  $serie= " AND serie =''";
}
else
{
	$serie= " AND serie='{$_GET[serie]}'";
}*/
if($_GET[serie]== "")
{
  $serie= " AND serie IS NULL";
}
else
{
	$serie= " AND serie='{$_GET[serie]}'";
}
switch($_GET[tipo])
{
	case 0: //Cotización
	case 2: //Factura
	$cliente = ($_GET[tipo] == 0)
	? mysql_fetch_assoc(query("SELECT * FROM cotizaciones WHERE folio = '{$_GET[enviar]}'"))
	: mysql_fetch_assoc(query("SELECT * FROM facturas WHERE folio = '{$_GET[enviar]}' {$serie}"));

	if(isset($cliente[id_cliente]))
	{
		$q = query("SELECT 'Correo empresarial cliente' nombre, email, 1 principal FROM clientes WHERE clave = {$cliente[id_cliente]}							
								ORDER BY principal ASC");
		while($r = mysql_fetch_assoc($q))
		{
				if(strlen($r[email])> 0){
					 $remitente[] = $r;
				}
		}
	}
	break;
	case 1: //Pedido
	$proveedor=mysql_fetch_assoc(query("SELECT * FROM pedidos WHERE folio = '{$_GET[enviar]}'"));
	$q = query("SELECT nombre, email FROM proveedores WHERE clave = {$proveedor[proveedor]}");
	$r = mysql_fetch_assoc($q);
	if(strlen($r[email])> 0){
	$remitente[] =$r;
	}
	break;
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Envio de Correos</title>
<link rel="stylesheet" type="text/css" href="css/body.css" />
<link rel="stylesheet" type="text/css" href="css/exclusivo.css" />
<link href="js/highslide/highslide.css" rel="stylesheet" type="text/css" />
<link href="js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="js/calendar/calendar.js"></script>
<script language="JavaScript" type="text/javascript" src="js/funciones.js"></script>
<script language="javascript" type="text/javascript" src="js/ajax.js"></script>
<script language="JavaScript" type="text/javascript" src="js/php.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script language="JavaScript" type="text/javascript" >
$(document).ready(function(){
	CKEDITOR.replace('mensaje');
	var tr_destino = $(".tr_destino").html().replace("Destinatario","CCO");
	cambio();
	$("#clonar").click(function(){
		$("#table_body").append("<tr class='tr_destino'>"+tr_destino+"</tr>");
		cambio();
		$(".destino").trigger("change");
	});
	$("#enviar_mail").click(function(){
		$(this).attr("disabled",true);
		$("#form1").submit();
	});
	$(".destino").trigger("change");

});
function cambio()
{
	$(".destino").change(function(){
		 if($(this).val() == "0")
		 {
			 $(this).parent().html('<input type="text" name="destino[]" size="50" class="destino" > <img src="imagenes/deleteX.png" title="Remover este destinatario" onclick="eliminar(this)" />');			
		 }
	});
}

function eliminar(obj)
{
	if($(".tr_destino").size() > 1)
	{
		$(obj).parent().parent().remove();
	}
	$("#table_body").find("th:first").html("Destinatario");
}
</script>
</head>

<body>
<a href="javascript:void(0);" id="clonar" title="Agregar un destinatario con copia oculta"><img src="imagenes/add.png" />Destinatario</a>
<form action="" method="post" name="form1" id="form1">
  <table width="426" border="0" align="center" cellpadding="4" cellspacing="0" class="bordear_tabla" id="formulario">
    <tr>
      <th width="1">Remitente</th>
      <td><select name="remitente" id="remitente">
          <option value="<?=$_SESSION[correo]?>"><?=$_SESSION[nombre]?> (<?=$_SESSION[correo]?>)</option>
          <option value="<?=$f[smtp_remitente]?>"><?=$f[nombre]?> (<?=$f[smtp_remitente]?>)</option>
        </select></td>
    </tr>
    <tbody id="table_body">
      <tr class="tr_destino">
        <th width="1">Destinatario</th>
        <td class="remover_destinatario"><select name="destino[]" class="destino">
            <?php foreach($remitente as $rem){ ?>
            <option value="<?=$rem[email]?>"><?=$rem[nombre]?> (<?=$rem[email]?>)</option>
            <?php } ?>
            <option value="0">Ingresar</option>
          </select>
          <img src="imagenes/deleteX.png" title="Remover este destinatario" onClick="eliminar(this)" /></td>
      </tr>
    </tbody>   
    <tr>
      <th nowrap="nowrap"><?=($_GET[tipo] == 2)?"Archivos anexos":"Archivo anexo"?></th>
      <td><b>
			<?php
			switch($_GET[tipo])
			{
				case 0: //Cotización
				echo "<a href='cotizaciones_pdf.php?folio={$_GET[enviar]}' target='_blank'>Cotizaci&oacute;n_{$_GET[enviar]}.pdf</a>";
				break;
				case 1: //Pedidos
				echo "<a href='pedidos_print.php?folio={$_GET[enviar]}' target='_blank'>Orden_{$_GET[enviar]}.pdf</a>";
				break;
				case 2: //Factura
				echo "{$_GET[enviar]}.pdf<br/>{$_GET[enviar]}.xml</a>";
				break;
			}
			?>
      </b></td>
    </tr>
  </table>
  <?php
	  	$var_s = "SELECT ruta FROM vars";
			$var_q = mysql_query($var_s);
			$res_r = mysql_fetch_assoc($var_q);
	?>
  <br />
  <center>
    <textarea name="mensaje" id="mensaje"></textarea>
    <button type="submit" value="Enviar mail" id="enviar_mail" name="enviar_mail" style="margin:10px 0 0 0">
    	<table width="0" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="imagenes/mail_attach.png" width="32" height="32" /></td>
          <th style="padding:4px 0 0 10px">Enviar mensaje</th>
        </tr>
      </table>
    </button>
		<!--
    <button type="submit" value="Guardar XML" id="guardar_xml" name="guardar_xml" style="margin:10px 0 0 0">   
    	<table width="0" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="imagenes/xml.png" width="32" height="32" /><img src="imagenes/pdf.png" width="32" height="32" /></td>
          <th style="padding:4px 0 0 10px">Guardar archivos</th>
        </tr>
      </table>
    </button>
		-->
    <input type="hidden" id="ruta" name="ruta" value="<?=$res_r[ruta]?>" />
		<?php if(isset($_GET[cfdi])){ ?><input type="hidden" id="cfdi" name="cfdi" value="1" /><?php } ?>
  </center>
</form>
</body>
</html>