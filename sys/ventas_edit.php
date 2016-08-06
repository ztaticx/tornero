<?php
if(!isset($_GET[section])){
	header("Content-type: text/html; charset=iso-8859-1");
	include("funciones/basedatos.php");
	include("funciones/funciones.php");
}

if(isset($_POST[folio]))
{
		if($_POST[serief]== "")
		{
			$serie= " AND serie IS NULL";
			$serie_factura= " AND serie_factura IS NULL";
		}
		else
		{
			$serie= " AND serie='{$_POST[serief]}'";
			$serie_factura= " AND serie_factura='{$_POST[serief]}'";
		}
	
	//print_pre($_POST);
	$s = "SELECT id_almacen FROM facturas WHERE folio = '{$_GET[folio]}' {$serie}";
	$q = mysql_query($s) or die ($s.mysql_error());
	$f = mysql_fetch_assoc($q);
	
	//Limpiar informaci�n
  $data = array();
  for($i=0;count($_POST[id_producto])>$i;$i++){
		if(strlen($_POST[descripcion_especial][$i])==0){ //Es producto
			if(strlen($_POST[id_producto][$i])>0 && $_POST[cantidad][$i]>0 && $_POST[control] != "~~~Campo de Control~~~"){ //Tiene cantidad y no es nulo
				if($_POST[disponible][$i]>=$_POST[cantidad][$i]){ //Verificar cantidad disponible
					$lote_this = explode(":::",$_POST[lote][$i]);
					if(strlen($lote_this[0])==NULL){ //Tomar en cuenta los lotes sin caracteres
						$lote_this[0] = "";
					}
					$data[id_producto][] = $_POST[id_producto][$i];
					$data[cantidad][] = $_POST[cantidad][$i];
					$data[unidades][] = $_POST[unidades][$i];
					$data[cantidad_esp][] = $_POST[cantidad_esp][$i];
					$data[descuento][] = $_POST[descuento][$i];
					$data[importe][] = $_POST[importe][$i];
					$data[iva][] = $_POST[iva][$i];
					$data[precio][] = $_POST[precio][$i];
					$data[lote][] = $lote_this[0];
					$data[descripcion_especial][] = 0;
					
					if($_POST[complemento][$i] != $com_text && $_POST[complemento][$i] != "")
					{
						$data[complemento][] = $_POST[complemento][$i];
					}
					else
					{
						$data[complemento][] = "";
					}
					
				}
			}
		} else {
			$data[descripcion_especial][] = $_POST[descripcion_especial][$i];
			$data[id_producto][] = "0";
			$data[cantidad][] = $_POST[cantidad][$i];
			$data[unidades][] = $_POST[unidades][$i];
			$data[cantidad_esp][] = $_POST[cantidad_esp][$i];
			$data[descuento][] = $_POST[descuento][$i];
			$data[importe][] = $_POST[importe][$i];
			$data[iva][] = $_POST[iva][$i];
			$data[precio][] = $_POST[precio][$i];
			$data[lote][] = "No aplica";
			
			if($_POST[complemento][$i] != $com_text && $_POST[complemento][$i] != "")
			{
				$data[complemento][] = $_POST[complemento][$i];
			}
			else
			{
				$data[complemento][] = "";
			}

		}		
  }
	
  $data[cliente] = $_POST[cliente];
  $data[cliente_data] = $_POST[cliente_data];
  $data[cliente_datos] = $_POST[cliente_datos];
	$data[fecha] = $_POST[fecha];
	$data[folio] = $_POST[folio];
	$data[serief] = $_POST[serief];
	$data[leyenda] = $_POST[leyenda];
	$data[pago] = $_POST[pago];
  $data[importe_input] = $_POST[importe_input];
  $data[metodoDePago] = $_POST[metodoDePago];
	
	$data[cantidad_old] = $_POST[cantidad_old];
	$data[unidades_old] = $_POST[unidades_old];
	$data[cantidad_old_esp] = $_POST[cantidad_old_esp];
	$data[complemento_old] = $_POST[complemento_old];
	$data[precio_old] = $_POST[precio_old];
	$data[total_input] = $_POST[total_input];
	$data[iva_old] = $_POST[iva_old];
	$data[olds] = $_POST[olds];
	
	if(strlen(trim($_POST[NumCtaPago])) == 0)
	{
		$s = "SELECT NumCtaPago FROM clientes WHERE clave = '{$_POST[cliente]}'";
		$q = mysql_query($s) or die ($s.mysql_error());
		$r = mysql_fetch_assoc($q);
		$data[NumCtaPago] = $r[NumCtaPago];
	}
	else
	{
		$data[NumCtaPago] = $_POST[NumCtaPago];
	}

  unset($_POST);
  $_POST = $data;
	
	if(strlen(trim($_POST[NumCtaPago])) == 0)
	{
		$s = "SELECT NumCtaPago FROM clientes WHERE clave = '{$_POST[cliente]}'";
		$q = mysql_query($s) or die ($s.mysql_error());
		$r = mysql_fetch_assoc($q);
		$_POST[NumCtaPago] = $r[NumCtaPago];
	}
	
  //Fin de Limpieza
  if(count($_POST[id_producto])>0){
    //**********Eliminar POSTS repetidos con LOTES repetidos   
    $id_productos_indice = array();
    $lotes_indice = array();
    for($x=0;count($_POST[id_producto])>$x;$x++){
      $id_productos_indice[$x] = $_POST[id_producto][$x];
    }
    $id_productos_indice = array_unique($id_productos_indice);
    for($i=0;count($id_productos_indice)>$i;$i++){
      $lotes_indice = array();
      for($ii=0;count($_POST[id_producto])>$ii;$ii++){
        if($id_productos_indice[$i] == $_POST[id_producto][$ii]){
          if(!in_array($_POST[lote][$ii],$lotes_indice)){
            $lotes_indice[$i] = $_POST[lote][$ii];
          } else {
						if(strlen($_POST[descripcion_especial][$ii])==0){
							echo "Eliminado {$ii}";
							unset($_POST[id_producto][$ii]);
							unset($_POST[lote][$ii]);
							unset($_POST[cantidad][$ii]);
							unset($_POST[cantidad_esp][$ii]);
							unset($_POST[descuento][$ii]);
							unset($_POST[importe][$ii]);
							unset($_POST[iva][$ii]);
							unset($_POST[precio][$ii]);
						}
          }
        }
      }
    }
   	//***********Termina filtro
  }
	
	$s = "SELECT id_almacen FROM facturas WHERE folio = '{$_GET[folio]}' {$serie}";
	$q = mysql_query($s) or die ((1).mysql_error());
	$f = mysql_fetch_assoc($q);
	
	$mantener = array();
	if(is_array($_POST[olds]))
	{
		foreach($_POST[olds] as $ok => $ov)
		{
			foreach($_POST[cantidad_old] as $k => $v)
			{
				if($k == $ok)
				{
					$mantener[] = $ov;
				}
			}
		}
	}
	
	if(count($_POST[olds]) > 0)
	{
		$eliminar = array_diff($_POST[olds],$mantener);
	}
	/*echo "OLDS";
	print_pre($_POST[olds]);
	echo "<hr>MANTENER";
	print_pre($mantener);
	echo "<hr>ELIMINAR";
	print_pre($eliminar);
	echo "<hr>";*/
	//Eliminar productos y retornar a existencias	
	if(isset($eliminar))
	{
		foreach($eliminar as $e)
		{
			$es = "SELECT id_producto, cantidad, lote FROM facturas_productos WHERE id_facturaproducto = {$e}";
			$eq = mysql_query($es) or die ((2).mysql_error());
			$er = mysql_fetch_assoc($eq);
			
			$us = "UPDATE existencias SET cantidad = cantidad + {$er[cantidad]} WHERE id_producto = '{$er[id_producto]}' AND lote = '{$er[lote]}' AND id_almacen = '{$f[id_almacen]}'";
			//echo $us."<br>";
			mysql_query($us) or die ((3).mysql_error());
			$ds = "DELETE FROM facturas_productos WHERE id_facturaproducto = {$e}";
			//echo "<b>Eliminar: ".$ds."</b><br>";
			mysql_query($ds) or die ((4).mysql_error());
		}
	}
	//echo "<hr>";
	//Regresar o extraer productos editados
	if(is_array($_POST[cantidad_old]))
	{
		foreach($_POST[cantidad_old] as $ck => $cv)
		{
			$ms = "SELECT id_producto, cantidad, lote,canti_ FROM facturas_productos WHERE id_facturaproducto = {$_POST[olds][$ck]}";
			//echo $ms."<br>";
			$mq = mysql_query($ms) or die ((5).mysql_error());
			$mr = mysql_fetch_assoc($mq);
			
			//echo "{$ck} * {$cv} > {$_POST[cantidad_old][$ck]} > {$_POST[cantidad_old][$ck]} > {$mr[cantidad]}<br>";
			
			if($_POST[cantidad_old][$ck] < $mr[cantidad]) //Regresar
			{
				$us = "UPDATE existencias SET cantidad = cantidad + ".($mr[cantidad]-$_POST[cantidad_old][$ck])."  WHERE id_producto = '{$mr[id_producto]}' AND lote = '{$mr[lote]}' AND id_almacen = '{$f[id_almacen]}'";
				//echo $us." < REGRESAR<br>";
				mysql_query($us) or die ((5).mysql_error());
			}
			else if($_POST[cantidad_old][$ck] > $mr[cantidad]) //Extraer
			{
				$us = "UPDATE existencias SET cantidad = cantidad - ".($mr[cantidad]+$_POST[cantidad_old][$ck])."  WHERE id_producto = '{$mr[id_producto]}' AND lote = '{$mr[lote]}' AND id_almacen = '{$f[id_almacen]}'";
				//echo $us." > EXTRAER<br>";
				mysql_query($us) or die ((6).mysql_error());
			}
			
			$us = "UPDATE facturas_productos SET folio_factura = '{$_POST[folio]}', cantidad = '{$_POST[cantidad_old][$ck]}', precio = '{$_POST[precio_old][$ck]}', iva = '{$_POST[iva_old][$ck]}', complemento = '{$_POST[complemento_old][$ck]}', canti_='{$_POST[cantidad_old_esp][$ck]}', unidad ='{$_POST[unidades_old][$ck]}', serie='{$_POST[serief]}' WHERE id_facturaproducto = '{$_POST[olds][$ck]}'";
			//echo "<b>EDITAR: </b><b>".$us."</b><br>";
			mysql_query($us) or die ((7).mysql_error());
		}
	}
	
	//Ingresar nuevos productos
	if(is_array($_POST[importe]))
	{
		foreach($_POST[importe] as $k => $v){
			
			if(strlen($_POST[descripcion_especial][$k])>1){
				$especial = mysql_real_escape_string($_POST[descripcion_especial][$k]);
			} else {
				$especial = 0;
			}
	
			if(strlen($_POST[complemento][$k])>1){
				$complemento = mysql_real_escape_string($_POST[complemento][$k]);
			} else {
				$complemento = 0;
			}
			if(!isset($_POST[cantidad_esp][$k])){	
		  	$_POST[cantidad_esp][$k] = 0;
	  	}
			$importe = $_POST[cantidad][$k]*($_POST[precio][$k]+($_POST[precio][$k]*($_POST[iva][$k]/100)));
			$s = "INSERT INTO facturas_productos
(folio_factura, id_producto, cantidad, lote, precio, iva, especial, complemento,
		canti_, unidad, serie, almacen, usuario)
			VALUES(
			'{$_POST[folio]}',
			'{$_POST[id_producto][$k]}',
			'{$_POST[cantidad][$k]}',
			'{$_POST[lote][$k]}',
			'{$_POST[precio][$k]}',
			#'{$_POST[descuento][$k]}',
			'{$_POST[iva][$k]}',
			#'{$importe}',
			'{$especial}',
			'{$complemento}',
			'{$_POST[cantidad_esp][$k]}',
			'{$_POST[unidades][$k]}',
			'{$_POST[serief]}',
'{$f['id_almacen']}', 0
			)";
//p($f);
//echo $s;
			mysql_query($s) or die ((8).mysql_error());
			
			/*if($especial == 0){
				//Actualizar Existencias
				$s = "UPDATE existencias 
				SET cantidad = cantidad-{$_POST[cantidad][$k]} 
				WHERE id_producto = '{$_POST[id_producto][$k]}'
				AND id_almacen = '{$f[id_almacen]}'
				AND lote = '{$_POST[lote][$k]}'";
				mysql_query($s) or die ((9).mysql_error());
				
				//Resgistrar movimiento de inventario
				$s = "INSERT INTO movimientos
				VALUES(
				NULL,
				'{$f[id_almacen]}',
				'0',
				'9',
				'{$_POST[id_producto][$k]}',
				'{$_POST[cantidad][$k]}',
				'{$_POST[lote][$k]}',
				NOW(),
				'{$_SESSION[id_usuario]}',
				'{$_POST[folio]}',
				'{$_POST[serief]}'				
				)";
				mysql_query($s) or die ((10).mysql_error());
			}*/
		}
	}
	
	$s = "SELECT ROUND(SUM(cantidad*(precio+(precio*(iva/100)))),2) suma FROM facturas_productos WHERE folio_factura = '{$_POST[folio]}' {$serie}";
	$q = mysql_query($s) or die ($s.mysql_error());
	$r = mysql_fetch_assoc($q);
	$importe_real = $r[suma];
	
	//Reasignar propiedades de la factura antigua y sus productos
	$s = "UPDATE facturas SET
				folio = '{$_POST[folio]}',
				fecha_factura = '{$_POST[fecha]}',
				fecha_captura = NOW(),
				id_cliente = '{$_POST[cliente]}',
				datos_cliente = '{$_POST[cliente_datos]}',
				importe = '{$importe_real}',
				leyenda = '{$_POST[leyenda]}',
				serie='{$_POST[serief]}',
				metodoDePago='{$_POST[metodoDePago]}',
				NumCtaPago='{$_POST[NumCtaPago]}'
				WHERE folio = '{$_GET[folio]}' {$serie}";
	//echo "<br><b><i>{$s}</i></b>";
	mysql_query($s) or die ((11).mysql_error());
	
	$s = "UPDATE facturas_productos SET importe = ROUND(cantidad*precio,2) + ROUND(cantidad*(precio*(iva/100)),2) WHERE folio_factura = '{$_POST[folio]}' {$serie}";
	mysql_query($s) or die($s." - ".mysql_error());
	
	//Actualizar Pagos de Contado
	$s = "SELECT folio, id_ingreso FROM facturas Inner Join ingresos_detalle ON folio = factura Inner Join ingresos ON id_ingreso = ingresos.id WHERE referencia = 'PAGO DE CONTADO' AND folio = '{$_POST[folio]}' {$serie_factura}";
	// print_r($_POST);
	// echo $s;
	$q = mysql_query($s) or die ((12).mysql_error());
	$in = mysql_fetch_assoc($q);
	if(mysql_num_rows($q) > 0) //Tiene pagos de contado.
	{
		$s = "UPDATE ingresos_detalle SET abono = {$importe_real}, factura = '{$_POST[folio]}' WHERE factura = '{$_POST[folio]}' {$serie_factura}";
		mysql_query($s) or die ((13).mysql_error());
		
		$s = "UPDATE ingresos SET importe = {$importe_real} WHERE id = {$in[id_ingreso]}";
		mysql_query($s) or die ((13).mysql_error());
		
		$s = "UPDATE movimientos_bancos SET ingresos = {$importe_real} WHERE id_mov = {$in[id_ingreso]}";
		mysql_query($s) or die ((13).mysql_error());
	}
	else if($_POST[pago] == "contado")
	{
		$s="SELECT id_ingreso FROM ingresos_detalle WHERE factura = '{$_POST[folio]}' {$serie_factura}";		
		$q_pago= mysql_query($s) or die($s.mysql_error());
		if(mysql_num_rows($q_pago) == 0)
		{
				$s_c = "INSERT INTO ingresos VALUES(
				NULL,
				{$importe_real},
				3,
				'transferencia',
				'PAGO DE CONTADO',
				'{$_POST[fecha]}',
				0
				)";
				mysql_query($s_c) or die($s_c." - ".mysql_error());
	    	$ID = mysql_insert_id();
			
			$s_c = "INSERT INTO ingresos_detalle VALUES (
			NULL,
			{$ID},
			'{$_POST[folio]}',
			{$importe_real},
			'{$_POST[serief]}'
			)";
			mysql_query($s_c) or die($s_c." - ".mysql_error());
			
			$s_c = "INSERT INTO movimientos_bancos
			VALUES (
			NULL,
			{$ID},
			3,
			'{$_POST[fecha]}',
			'{$importe_real}',
			NULL
			)";
			mysql_query($s_c) or die($s_c." - ".mysql_error());
			
		}		
	}
	 if($_POST[pago] == "credito")
	{		
		$sql_pago="SELECT id_ingreso FROM ingresos_detalle WHERE factura = '{$_POST[folio]}' {$serie_factura}";		
		$q_pago= mysql_query($sql_pago);		
	  if(mysql_num_rows($q_pago) > 0)
		{
			$r_pago= mysql_fetch_assoc($q_pago);
			$sql_del_pago ="DELETE FROM ingresos WHERE id ={$r_pago[id_ingreso]}";
			mysql_query($sql_del_pago);
			
			$sql_del_pago2 ="DELETE FROM ingresos_detalle WHERE id_ingreso ={$r_pago[id_ingreso]}";
			mysql_query($sql_del_pago2);
			
			$sql_del_pago3 ="DELETE FROM movimientos_bancos WHERE id_mov ={$r_pago[id_ingreso]}";
			mysql_query($sql_del_pago3);	
		 }
	}

	relocation("?section=ventas_detalle&folio={$_POST[folio]}&serie={$_POST[serief]}");
	exit();
}

//Inicia configuraci�n
titleset("Edici�n de la Venta \\\"{$_GET[folio]}\\\"");
//Fin de configuraci�n
if($_GET[serie]== "")
{
  $serie1= " AND serie IS NULL";
}
else
{
	$serie1= " AND serie='{$_GET[serie]}'";
}

$sql_chris = "SELECT
facturas.importe-IFNULL(SUM(CASE WHEN ingresos.status = 0 THEN ingresos_detalle.abono ELSE 0 END),0) AS 'saldo'
FROM
facturas
LEFT OUTER JOIN ingresos_detalle ON ingresos_detalle.factura = facturas.folio
LEFT OUTER JOIN ingresos ON ingresos.id = ingresos_detalle.id_ingreso
WHERE
facturas.status = 0
AND facturas.tipo = 'f'
AND facturas.folio='{$_GET[folio]}'
{$serie1}
GROUP BY facturas.folio
HAVING 1
AND saldo > 0 ";
//echo $sql_chris;
$q_chris = mysql_query($sql_chris) or die ($s.mysql_error());
$r_chris = mysql_fetch_assoc($q_chris);
$contados = $r_chris[saldo];

//Verificar que no haya sido pagada
$s = "SELECT
ingresos.referencia,
ingresos.id,
IF(facturas.status=0,IF(SUM(abono)=facturas.importe,'Saldada',IF(SUM(abono)>0,'Abonada','Normal')),'Cancelada') AS 'estado'
FROM
facturas
LEFT OUTER JOIN ingresos_detalle ON ingresos_detalle.factura = facturas.folio
LEFT OUTER JOIN ingresos ON ingresos.id = ingresos_detalle.id_ingreso
WHERE folio = '{$_GET[folio]}'
{$serie1}
GROUP BY facturas.folio";
$q = mysql_query($s) or die ($s.mysql_error());
$r = mysql_fetch_assoc($q);
//echo $r[estado];
if($r[estado]!="Normal"){
	if($r[referencia] != "PAGO DE CONTADO"){
		echo "<b>Esta factura tiene pagos asignados. Imposible continuar.</b>";
		exit();
	}
}
if($r[estado] == "Cancelada")
{
	echo "<b>Esta factura est� cancelada. Imposible continuar.</b>";
	exit();
}

$s = "SELECT
f.*,
c.nombre,
a.descripcion,
u.nombre vendedor
FROM
facturas f
LEFT JOIN clientes c ON c.clave = f.id_cliente
LEFT JOIN usuarios u ON u.id_usuario = f.id_facturista
INNER JOIN almacenes a ON a.id_almacen = f.id_almacen
WHERE folio = '{$_GET[folio]}' {$serie1}";
$q = mysql_query($s) or die ($s.mysql_error());
$r = mysql_fetch_assoc($q);
$id_cliente = $r[id_cliente];
$importe = $r[importe];
$tipo = $r[tipo];
$status = $r[status];
$al = $r[id_almacen];

//Ajuste de optimizaci�n por Rich 20/06/2012
$sql_cliente = "SELECT clave, nombre, credito, dias_credito, credito - IFNULL(saldo_final,0) saldo, DATEDIFF(fecha_antigua, CURDATE() - dias_credito) * -1 dias
								FROM clientes c

								LEFT JOIN
								(
									SELECT *, SUM(saldo) saldo_final FROM
									(
										SELECT
										id_cliente,
										fecha_factura fecha_antigua,
										f.importe,
										SUM(f.importe) - IFNULL(SUM(abono),0) saldo
										FROM facturas f
										LEFT JOIN ingresos_detalle d ON d.factura = f.folio
										WHERE f.status = 0
										GROUP BY folio
										ORDER BY fecha_factura
									) facturas_sin_pago
									WHERE saldo > 0
									GROUP BY id_cliente
								) s ON s.id_cliente = c.clave
								WHERE
									status = 0
									AND IFNULL(DATEDIFF(fecha_antigua, CURDATE() - dias_credito) * -1,0) <= dias_credito
								GROUP BY clave
								ORDER BY nombre ASC";
$query_cliente = mysql_query($sql_cliente) or die ($s.mysql_error());
?>
<script language="javascript" type="text/javascript">
var n = 0;
var com_text = "<?=$com_text?>";
function AgregarFila(){
	var	almacen = <?=$r[id_almacen]?>;
	
  n++;
  var num = n;
	if(n%2 == 0){
		var color = "tr_list_0";
	} else {
		var color = "tr_list_1";
	}
	
  var tbody = document.getElementById("tabla_productos").getElementsByTagName("tbody")[0];
  var row = document.createElement("tr");
	row.id = "tr_"+num;
  row.setAttribute("class",color);
	row.onmouseover = function(){this.setAttribute('class','tr_list_over');}
	row.onmouseout = function(){this.setAttribute('class',color);}
  
  //Switch
  celda = document.createElement("td");
	celda.align = "center";
  swi = document.createElement("input");
	swi.type = "checkbox";
	swi.name = "switch[]";
	swi.value = 1;
	swi.id = "swi"+num;
	swi.onclick = function(){cambiar_especial(this,num);}
  celda.appendChild(swi);
	row.appendChild(celda);
	
  //B�squeda
  celda = document.createElement("td");
  buscar = document.createElement("a");
  buscar.innerHTML = "<img src='imagenes/search.png' />";
  buscar.id = "buscar"+num;
  buscar.href = "productos_pick.php?n="+num+"&almacen="+almacen+"&venta";
	buscar.onclick = function(){return hs.htmlExpand(this,{objectType:'iframe',headingText:'Buscador de Productos',minWidth:600,height:600,preserveContent:false,cacheAjax:false})};
  celda.appendChild(buscar);
	
  //Control (Oculto) Sirve para determinar si el campo "B�squeda" ha cambiado despues de "onBlur"
  control = document.createElement("input");
  control.type = "hidden";
  control.name = "control[]";
  control.id = "control"+num;
	control.value = "~~~Campo de Control~~~";
  celda.appendChild(control);
	
  //Id_producto (Oculto)
  id_producto = document.createElement("input");
  id_producto.type = "hidden";
  id_producto.name = "id_producto[]";
  id_producto.id = "id_producto"+num;
  celda.appendChild(id_producto);
  
  row.appendChild(celda); //Esta celda comparte "B�squeda" , "ID_producto" y "Valor_inicial"

  //Barras
  celda = document.createElement("td");
  barras = document.createElement("input");
  barras.type = "text";
  barras.name = "barras[]";
  barras.id = "barras"+num;
  barras.size = 18;
  barras.onblur = function(){buscar_datos(this,num,"barras");}
  celda.appendChild(barras);
  row.appendChild(celda);
	
	//unidades
	celda = document.createElement("td");
  unidades = document.createElement("input");
  unidades.type = "text";
  unidades.name = "unidades[]";
  unidades.id = "unidades"+num;
  unidades.size = 10; 
  celda.appendChild(unidades);
  row.appendChild(celda);
  
  //Descripcion
  celda = document.createElement("td");
  descripcion = document.createElement("select");
  descripcion.name = "descripcion[]";
  descripcion.id = "descripcion"+num;
  descripcion.onchange = function(){actualizar_campos(this,num);}
	descripcion.options[0] = new Option("Escriba un c�digo de barras.");
	celda.appendChild(descripcion);
		
  descripcion_especial = document.createElement("input");
	descripcion_especial.type = "text";
	descripcion_especial.style.display = "none";
  descripcion_especial.name = "descripcion_especial[]";
  descripcion_especial.id = "descripcion_especial"+num;
	descripcion_especial.style.width = "200px";
	celda.appendChild(descripcion_especial);

	br_complemento = document.createElement("br");
	celda.appendChild(br_complemento);
	
  complemento = document.createElement("textarea");
	$(complemento).css("width","200px").css("height","39px").attr("id","complemento"+num).attr("name","complemento[]").attr("disabled",true).val(com_text).focus(function(){if($(this).val() == com_text){$(this).val("");}});
	celda.appendChild(complemento);

  row.appendChild(celda);
	
  //Lote
  celda = document.createElement("td");
  lote = document.createElement("select");
  lote.name = "lote[]";
  lote.id = "lote"+num;
  lote.onchange = function(){actualizar_campos_lote(this,num);}
	lote.options[0] = new Option("Sin lote");
	celda.appendChild(lote);
  row.appendChild(celda);
	
  //Disponible
  celda = document.createElement("td");
  celda.align = "center";
  disponible = document.createElement("input");
  disponible.type = "text";
  disponible.name = "disponible[]";
  disponible.id = "disponible"+num;
  disponible.size = 10;
	disponible.value= "0.000";
	disponible.readOnly = true;
  celda.appendChild(disponible);
  row.appendChild(celda);

  //Cantidad
  celda = document.createElement("td");
  celda.align = "center";
  cantidad = document.createElement("input");
  cantidad.type = "text";
  cantidad.name = "cantidad[]";
  cantidad.id = "cantidad"+num;
	cantidad.className = "cantidad";
  cantidad.size = 8;
	cantidad.value= "0.000";
	//cantidad.readOnly = true;
  cantidad.onblur = function(){numero(this,3); CompararExistencias(this,num); sumar_tr(num); sumar();}
  celda.appendChild(cantidad);
  row.appendChild(celda);
	
		//empieza BY chris 11-21-2010
		
  celda = document.createElement("td");
  celda.align = "center";
	// br_complemento = document.createElement("br");
	// celda.appendChild(br_complemento);	
	 //Cantidad especial
  cantidadesp = document.createElement("input");
  cantidadesp.type = "text";
  cantidadesp.name = "cantidad_esp[]";
  cantidadesp.id = "cantidadesp"+num;
  cantidadesp.size = 8;
	cantidadesp.value= "0.000";
	cantidadesp.readOnly = true;
  cantidadesp.onblur = function(){numero(this,3); CompararExistencias(this,num);}
  celda.appendChild(cantidadesp);
  row.appendChild(celda);
	//termina 	
  row.appendChild(celda);
	
  
	//Precio
  celda = document.createElement("td");
  celda.align = "center";
  precio = document.createElement("input");
  precio.type = "text";
  precio.name = "precio[]";
  precio.id = "precio"+num;
	precio.className = "precio";
  precio.size = 8;
	precio.value= "0.00";
	precio.readOnly = false;
  precio.onblur = function(){numero(this,2); f_pmv(this,num); sumar_tr(num); sumar();}
  celda.appendChild(precio);
	
  //PMV
  celda.align = "center";
  pmv = document.createElement("input");
  pmv.type = "hidden";
  pmv.name = "pmv[]";
  pmv.id = "pmv"+num;
	pmv.value= 0;
  celda.appendChild(pmv);
  row.appendChild(celda);
	
	//Descuento
  celda = document.createElement("td");
  celda.align = "center";
	celda.style.display = "none";
  descuento = document.createElement("input");
  descuento.type = "text";
  descuento.name = "descuento[]";
  descuento.id = "descuento"+num;
  descuento.size = 8;
	descuento.value= "0.00";
	descuento.readOnly = true;
  descuento.onblur = function(){numero(this,2); sumar_tr(num); sumar();}
  celda.appendChild(descuento);
  row.appendChild(celda);
	
	//IVA
  celda = document.createElement("td");
  celda.align = "center";
  iva = document.createElement("input");
  iva.type = "text";
  iva.name = "iva[]";
  iva.id = "iva"+num;
	iva.className = "iva";
  iva.size = 8;
	iva.value= "0.00";
	iva.readOnly = false;
  iva.onblur = function(){numero(this,2); sumar_tr(num); sumar(); AgregarFilaValida(this);}
  celda.appendChild(iva);
  row.appendChild(celda);
	
	//Importe
/*	celda = document.createElement("td");
  celda.align = "center";
  importe = document.createElement("input");
  importe.type = "text";
  importe.name = "importe[]";
  importe.id = "importe"+num;
	importe.className = "importe";
  importe.size = 8;
	importe.value= "0.00";
	importe.readOnly = true;
  importe.onblur = function(){numero(this,2); sumar_tr(num); sumar();}
  celda.appendChild(importe);
  row.appendChild(celda);*/

  //Eliminar Fila
	celda = document.createElement("td"); 
	celda.align = "center";
	eliminar = document.createElement("img"); 
	eliminar.src = "imagenes/deleteX.png";
	eliminar.setAttribute("class", "manita");
	eliminar.onclick = function(){borrar(this);}
	eliminar.id = "eliminar"+num;
  celda.appendChild(eliminar);
  row.appendChild(celda);

	tbody.appendChild(row);
	//if(num>1){
		$(barras).focus();
		if($("@[name='barras[]']").size() > 1)
		{
			setTimeout(function(){$(barras).select().focus()},200);
		}
		evitar();
	//}
}

function evitar()
{
	$("#form1").find("input").bind("keypress",function(e){
		if(e.keyCode == 13) {
			return false;
		}
	});
}

function AgregarFilaValida(obj){
	var tbody = document.getElementById("tabla_productos").getElementsByTagName("tbody")[0];
	var filas = tbody.rows.length-1; // Le restamos 2 porque no tomamos en cuenta los encabezados y comienza desde 0
	var id = obj.parentNode.parentNode.id;
	var last_tr = document.getElementById("tabla_productos").getElementsByTagName("tbody")[0].rows[filas].id
	for(var i=0;filas>i++;){ //Pasar por cada fila
		var fila = document.getElementById("tabla_productos").getElementsByTagName("tbody")[0].rows[i].id;
		if(id == last_tr && fila == last_tr){
			AgregarFila();
		}
	}
}

function borrar(obj) {
	var tbody = document.getElementById("tabla_productos").getElementsByTagName("tbody")[0];
	if(tbody.rows.length > 2){
		while (obj.tagName != 'TR') 
			obj = obj.parentNode;
		for (i=1; ele=tbody.getElementsByTagName('tr')[i]; i++)
			if (ele==obj) num=i;
		tbody.deleteRow(num);
		for (i=1; ele=tbody.getElementsByTagName('tr')[i]; i++)
			ele.id = "tr_"+i;
	}
	sumar();
	return false;
}

function CompararExistencias(obj,num){
	var disponible = document.getElementById("disponible"+num).value;
	var cantidad = document.getElementById("cantidad"+num).value;
	console.log(obj);
	if (parseFloat(cantidad) > parseFloat(disponible)){
		alert("Esta cantidad no est� disponible en el almac�n seleccionado.\nSe aplicar� la cantidad m�xima actual.");
		document.getElementById("cantidad"+num).value = disponible;
		document.getElementById("cantidad"+num).focus();
		document.getElementById("cantidad"+num).select();
		return false;
	}
}

function ajax_query_barras(data,field){ //Petici�n desde el campo de c�digo de barras
	var url = "ajax_tools.php?ajax_producto="+data+"&field="+field+"&ident=codigo_barras";
	var r = procesar(url);
	return r;
}

function ajax_query_id_producto(data,field){ //Petici�n desde HighSlide
	var url = "ajax_tools.php?ajax_producto="+data+"&field="+field+"&ident=id_producto";
	var r = procesar(url);
	return r;
}

function buscar_datos_pop(num){
	var id_producto = document.getElementById("id_producto"+num);
	buscar_datos(document.getElementById("id_producto"+num),num,"id_producto")
}

function buscar_datos(obj,num,tipo){
	var control = document.getElementById("control"+num);
	var id_producto = document.getElementById("id_producto"+num);
	var descripcion = document.getElementById("descripcion"+num);
  var barras = document.getElementById("barras"+num);
	if(obj.value.length > 0 && control.value != obj.value){
    if(tipo == "barras"){ //Petici�n desde el campo de c�digo de barras
      var ajax_id_producto = ajax_query_barras(obj.value,"id_producto");
    } else { //Petici�n desde HighSlide
      var ajax_id_producto = ajax_query_id_producto(obj.value,"id_producto");
    }
		if(ajax_id_producto != "NULO"){
			id_producto.value = ajax_id_producto.split("~")[0];
			descripcion.length = 0;
      if(tipo == "barras"){ //Petici�n desde el campo de c�digo de barras
        var descripciones = ajax_query_barras(obj.value,"descripcion").split("~");
        control.value = obj.value;
      } else { //Petici�n desde HighSlide
        var descripciones = ajax_query_id_producto(obj.value,"descripcion").split("~");
        codigo_barras = ajax_query_id_producto(obj.value,"codigo_barras").split("~");
        barras.value = codigo_barras;
        control.value = codigo_barras;
      }
			for(i=0; descripciones.length>i; i++){
				descripcion.options[i] = new Option(descripciones[i],ajax_id_producto);
			}
			activar(num);
      loteDetect(num);
      
      //Determinar IVA
      document.getElementById("iva"+num).value = ajax_query_id_producto(id_producto.value,"iva");
      numero(document.getElementById("iva"+num),2);
      
      //Determinar PMV
      var url = "ajax_tools.php?pmv="+id_producto.value;
      document.getElementById("pmv"+num).value = procesar(url);
			
			$("#disponible"+num).focus();
		} else {
			alert("No se pudo encontrar este producto.\n"+obj.value);
			$("#barras"+num).val("");
      resetear(num);
		}
	}
  if(obj.value.length == 0) {
    resetear(num);
	}
  f_pmv(document.getElementById("precio"+num),num);
}

function resetear(num){
  document.getElementById("control"+num).value = "~~~Campo de Control~~~";
  document.getElementById("id_producto"+num).value = "";
	document.getElementById("unidades"+num).length = "";
  document.getElementById("descripcion"+num).length = 0;
  document.getElementById("descripcion"+num).options[0] = new Option("Escriba un c�digo de barras.");
  document.getElementById("lote"+num).length = 0;
  document.getElementById("lote"+num).options[0] = new Option("Sin lote");
  document.getElementById("iva"+num).value = "0.00";
  document.getElementById("precio"+num).value = "0.00";
  document.getElementById("pmv"+num).value = "0.000";
	$("#cantidad"+num).val("0.00");
	$("#cantidadesp"+num).val("0.00");
	$("#disponible"+num).val("0.000");
	$("#complemento"+num).val(com_text);
  desactivar(num);
  sumar_tr(num);
	sumar();
}

function activar(num){
  document.getElementById("cantidad"+num).readOnly = false;
		//empieza BY chris 11-21-2010
	document.getElementById("cantidadesp"+num).readOnly = false;
	//termina
  document.getElementById("precio"+num).readOnly = false;
  document.getElementById("descuento"+num).readOnly = false;
  //document.getElementById("iva"+num).readOnly = false;
	$("#complemento"+n).attr("disabled",false);
	sumar();
}

function desactivar(num){
  document.getElementById("cantidad"+num).readOnly = true;
  document.getElementById("cantidad"+num).value = "0.000";
		//empieza BY chris 11-21-2010
	document.getElementById("cantidadesp"+num).readOnly = true;
  document.getElementById("cantidadesp"+num).value = "0.000";
	//termina
  document.getElementById("precio"+num).readOnly = false;
  document.getElementById("descuento"+num).readOnly = true;
  document.getElementById("descuento"+num).value = "0.00";
  //document.getElementById("iva"+num).readOnly = true;
	$("#complemento"+n).attr("disabled",true).val(com_text);
	sumar();
}

function cambiar_especial(obj,n){
	resetear(n);
	if(obj.checked){ // Cambiar a Especial
		document.getElementById("cantidad"+n).onblur = null;
		document.getElementById("precio"+n).onblur = null;
	
		$("#id_producto"+n).val("");
		$("#id_producto"+n).val("");
		$("#complemento"+n).attr("disabled",false);
		$("#buscar"+n).css("display","none");
		$("#barras"+n).val("").css("display","none");
		$("#lote"+n).find('option').remove().end().append('<option>'+Math.floor(Math.random()*11)+'</option>').css("display","none");
		$("#disponible"+n).val("0.000").css("display","none");
		$("#descripcion"+n).css("display","none").find('option').remove().end().css("display","none");
		$("#descripcion_especial"+n).css("display","");
		$("#cantidad"+n).blur(function(){numero(this,3); sumar_tr(n); sumar();}).attr("readonly","");
		//agregado by chris el 11-21-2010
		  //$("#cantidadesp"+n).blur(function(){numero(this,3);}).attr("readonly","");
			$("#cantidadesp"+n).css("display","none");
		//termina
		$("#precio"+n).blur(function(){numero(this,2); sumar_tr(n); sumar();});
		$("#iva"+n).attr("readonly","");
	} else {
		$("#tr_"+n).remove();
		AgregarFila();
		sumar();
	}
}

function precio_quiz(num){
	var lote = 	document.getElementById("lote"+num);
	var lote_value = lote.options[lote.selectedIndex].value;
	if(lote_value != "Sin lote"){
		var id_producto = document.getElementById("id_producto"+num).value;
		//var precios = <?=$r[licitacion]?>; //Selector de Lista de Precios
		var lista = "<?=$r[licitacion]?>";
		
		var url = "ajax_tools.php?precio&id_producto="+id_producto+"&lista="+lista;
		var r = procesar(url);
		if(r.length == 0 && lista != "_normal_"){
			var url = "ajax_tools.php?precio&id_producto="+id_producto+"&lista=_normal_";
			var r = procesar(url);
			
			var descripcion = document.getElementById("descripcion"+num);
			var descripcion_text = descripcion.options[descripcion.selectedIndex].text;
			
			alert("El producto \""+descripcion_text+"\" no est� definido en la lista de precios \""+lista+"\".\nSe aplicar� su precio p�blico: $ "+money(parseFloat(r)))
		}
		document.getElementById("precio"+num).value = parseFloat(r).toFixed(2);
    } else {
      document.getElementById("precio"+num).value = "0.00";
      document.getElementById("iva"+num).value = "0.00";
	}
}

function actualizar_campos(obj,num){
	document.getElementById("id_producto"+num).value = obj.options[obj.selectedIndex].value.split("~")[obj.selectedIndex];

  //Determinar IVA
  var iva = ajax_query_id_producto(document.getElementById("id_producto"+num).value,"iva");
  document.getElementById("iva"+num).value = iva;
  numero(document.getElementById("iva"+num),2);
	loteDetect(num);
  precio_quiz(num);
  
  //Determinar PMV
  var url = "ajax_tools.php?pmv="+id_producto.value;
  document.getElementById("pmv"+num).value = procesar(url);
  f_pmv(document.getElementById("precio"+num),num);
}

function loteDetect(id){
  var id_producto = document.getElementById("id_producto"+id);
  var lote = document.getElementById("lote"+id);
  var disponible = document.getElementById("disponible"+id);
	var almacen = document.getElementById("id_almacen");
  var url = "ajax_tools.php?lotes="+id_producto.value+"&ad1=<?=$r[id_almacen]?>";
  var rr = procesar(url);
  if(rr != "NULO"){ //Tiene existencias en este almac�n
		document.getElementById("lote"+id).length = 0;
    var r = rr.split("|||");
    for(i=0; r.length>i; i++){
      lote.options[i] = new Option(r[i].split(":::")[0],r[i]);
    }
    disponible.value = r[0].split(":::")[1];
    activar(id);
		precio_quiz(id);
  } else { //Este producto no tiene existencias en este almac�n
		lote.length = 0;
		lote.options[0] = new Option("Sin Existencias",0);
    desactivar(id);
  }
  if(parseFloat(document.getElementById("disponible"+id).value) == 0){
    desactivar(id);
  }
}

function actualizar_campos_lote(obj,num){
  var disponible = document.getElementById("disponible"+num);
  var existencia = obj.options[obj.selectedIndex].value.split(":::")[1];
  desactivar(num);
  activar(num);
  disponible.value = existencia;
  if(parseFloat(existencia)==0){
    desactivar(num);
  }
}

function f_pmv(obj,id){
  document.getElementById("lote"+id).disabled = false;
  if(document.getElementById("id_producto"+id).value.length > 0){
    var precio_uni = parseFloat(obj.value);
    var pmv = parseFloat(document.getElementById("pmv"+id).value);
    if(precio_uni < pmv){
      if(confirm("El precio establecido es MENOR al Precio M�nimo de Venta: $ "+pmv+".\n�Desea Continuar?")){
        document.getElementById("precio"+id).value = pmv;
      } else {
        desactivar(id);
        document.getElementById("lote"+id).disabled = true;
      }
    }
  }
}

function sumar_tr(num){
	
	/*
	
	var cantidad = parseFloat(document.getElementById("cantidad"+num).value);
  var precio = parseFloat(document.getElementById("precio"+num).value);
	var descuento = parseFloat(document.getElementById("descuento"+num).value);
  var iva = parseFloat(document.getElementById("iva"+num).value);
  var importe = document.getElementById("importe"+num);
  var importe_v = cantidad*(precio-(precio*(descuento/100))+((precio-(precio*(descuento/100)))*(iva/100)));
  importe.value = importe_v.toFixed(2);
	
	
	*/
	
	var _cantidad_ = parseFloat(document.getElementById("cantidad"+num).value);
  var _precio_ = parseFloat(document.getElementById("precio"+num).value);
	//var descuento = parseFloat(document.getElementById("descuento"+num).value);
  var _iva_ = parseFloat(document.getElementById("iva"+num).value)/100;
  
  //var importe_v = cantidad*(precio-(redon2(precio*(descuento/100)))+redon2((precio-(precio*(descuento/100)))*redon2(iva/100)));   
	/*importe_v = round(_cantidad_*_precio_,2) + round(_cantidad_*(_precio_*_iva_),2);
	
	var importe = document.getElementById("importe"+num);  
  importe.value = importe_v;*/

}


function redon(valor){
		valor=valor*100;
		valor=Math.floor(valor);
		valor=valor/100;		
		return money(valor);
		}

function sumar()
{
	jsubtotal = 0;
	jiva = 0;

	$(".cantidad").each(function(){
		if(!$(this).attr("disabled"))
		{
			x = $(this).get(0).id.replace("[","").replace("]","").replace("cantidad","").replace("precio","").replace("iva","");
			var _cantidad_ = parseFloat($("#cantidad"+x).val());
			var _precio_ = parseFloat($("#precio"+x).val());
			var _iva_ = round(parseFloat($("#iva"+x).val())/100,2);
			jsubtotal += _cantidad_*(_precio_);
			jiva += (_cantidad_*_precio_)*_iva_;
		}
	});	

	$("#importe_td").html(money(jsubtotal + jiva));
	$("#importe_input").val(jsubtotal + jiva);
	$("#iva_td").html(money(round(jiva,2)));
	$("#subtotal_td").html(money(round(jsubtotal,2)));
	 var chrisfinal = jsubtotal + jiva;
		var sumatoria = parseFloat($("#credito_disponible").val())-chrisfinal;
  $("#sumatoria_span").html(money(sumatoria));
	$("#sumatoria").val(sumatoria);
	
	
}

function quitar(obj)
{
	$(obj).parent().parent().find("input:text, textarea").each(function(){
		if($(obj).attr("checked"))
		{
			$(this).attr("disabled",true);
		}
		else
		{
			$(this).attr("disabled",false);
		}
	});
	sumar();
}
function array_unique2(array){
    var tem_arr = new Array();
    for(i=0;i<array.length;i++){
        if(!in_array(array[i],tem_arr)){
            tem_arr[i]=array[i];
        }
    }
    return tem_arr.join(',').split(',');
}
function verificar_folio(){
	var folio = document.getElementById("folio");
	if(folio.value != "<?=$_GET[folio]?>")
	{
		var tipo_venta = document.getElementById("tipo_venta");
		var  ser_f='<?=$_GET[serie]?>';
		var url = "ajax_tools.php?folio_venta="+folio.value+"&serie="+ser_f+"&tipo=1";
		var r = procesar(url);
		if(r > 0){
			alert("Este folio ha sido previamente usado.\nIntente nuevamente.");
			folio.focus();
			folio.select();
			return false;
		} else {
			return true;
		}
	}
	else
	{
		return true;
	}
}

function ingresar(){
	//Verificar Folio
	var folio = document.getElementById("folio");
	if(folio.value.length == 0){
		alert("Escriba un folio para esta venta.");
		folio.focus();
		return false;
	}
	
	if(verificar_folio())
	{
		if($("#importe_input").val() == 0)
		{
			alert("La venta est� en ceros.");
			return false;
		}
			
				var tipo = document.getElementById("tipo_venta");
				var pago = document.getElementById("pago");
					if(tipo !== null)
					{
							if(tipo.value == 1 && pago.selectedIndex == 1)
							{ //Es factura a cr�dito
									var sumatoria = document.getElementById("sumatoria");
									if(parseFloat(sumatoria.value) < 0)
									{
										alert("El cr�dito de este cliente ha sido superado.");
										return false;
									}
							} 
							else 
							{
								return true;
							}
					}
			 
		 
	} 
	else {
		return false;
	}
}

function items(){
	var prods = $("[name=id_producto[]]"); //Campos de IDS de Productos
	var lotes = $("[name=lote[]]"); //Campos de Lotes
	var ids = new Array(); //Valores de IDS de Productos
	var lotes_indice = new Array(); //Todos los lotes
	var i = 0;

	prods.each(function(pi){ //Indexar IDS de Productos y sus Lotes
		if(parseFloat($(this).val()) > 0){
			ii = 0;
			num = $(this).attr("id").replace("id_producto",""); //�ndice num�rico
			ids[i] = parseFloat($(this).val()); //Indexar este ID
			if(!is_array(lotes_indice[ids[i]])){ //No existe el �ndice de lotes para este producto
				lotes_indice[ids[i]] = new Array($("#lote"+num).val().split(":::")[0]); //Indexar este Lote
			} else {
				lotes_indice[ids[i]][i] = [$("#lote"+num).val().split(":::")[0]]; //Indexar este tambi�n
			}
			i++;
		}
	});

	ids = array_unique2(ids); //Unificar productos
	
	for(i in ids){ //Verificar lotes repetidos. Inicia por cada ID de producto
		var doble = new Array(); //Almacena los lotes
		var x = 0;
		for(l in lotes_indice[ids[i]]){ //Verificar lotes repetidos. Continua por cada Lote correspondiente.
			if(!in_array(lotes_indice[ids[i]][l],doble)){ //No est� indexado.
				doble[x] = lotes_indice[ids[i]][l]; //Indexar
			} else { //Est� indexado. ����REPETIDO!!!!
				alert("Existe un producto con el mismo lote repetido.\nVerifique la informaci�n.");
				return false;
			}
			x++;
		}
	}
	return true;
}

function dataX(data)
{
  $("#cliente_datos").val(data[0]+"|"+data[1]+"|"+data[2]+"|"+data[3]+"|"+data[4]+"|"+data[5]+"|"+data[6]+"|"+data[7]+"|"+data[8]+"|"+data[9]+"|"+data[10]);	
	
	if(data[4].length > 0)
	{
	  	data[4] = " Int. "+data[4];
	}
	if(data[3].length > 0)
	{
	  	data[3] = " No. "+data[3];
	}	
	$("#cliente_data").val("==N�mero de cuenta ["+data[11]+"]==\nCALLE: "+data[2]+data[3]+ data[4]+"\nCOLONIA: "+data[5]+"\nC.P.: "+data[10]+"\n"+data[6]+", "+data[7]+", "+data[8]+", "+data[9]+"\nRFC: "+data[0]);
}

<?php if($tipo == "f"){ ?>
function cliente_data_ajax(obj)
{
	var cliente = document.getElementById("cliente");
	var url = "ajax_tools.php?cliente_data2="+obj.options[obj.selectedIndex].value;
	data = array("","","","","","","","","","");
	r = procesar(url);
	
	data = r.split("|");
	dataX(data);
	
	//document.getElementById("cliente_data").value = procesar(url);
	
	document.getElementById("credito").value = obj.options[obj.selectedIndex].title.split("~")[0];
	document.getElementById("credito_span").innerHTML = money(obj.options[obj.selectedIndex].title.split("~")[0]);
	document.getElementById("credito_disponible").value = obj.options[obj.selectedIndex].title.split("~")[1];
	document.getElementById("credito_disponible_span").innerHTML =money(obj.options[obj.selectedIndex].title.split("~")[1]);
	document.getElementById("sumatoria_span").innerHTML = money(cliente.options[cliente.selectedIndex].title.split("~")[1]);
	sumar();
}

function credito_show(obj){
	if(obj.selectedIndex == 0){ //Es pago de Contado
		document.getElementById("tabla_credito").style.display = "none";
	} else { //Es a Cr�dito
		document.getElementById("tabla_credito").style.display = "";
	}
}

<?php } ?>

function maximi(o,m,c, especial)
{
	if(parseFloat(o.value) > (c+m) && especial == 0)
	{
		alert("La cantidad disponible en el almac�n es de "+(c+m)+".\nSe definir� esta cantidad como la solicitada para este producto.");
		o.value = (c+m);
	}
}

function activar_sumatoria()
{
	$(".num").blur(function(){
		//numero($(this).get(0),3);
		
		id = $(this).get(0).name.replace("[","").replace("]","").replace("cantidad","").replace("precio","").replace("iva","").replace("_old","");
		var _cantidad_ = parseFloat(document.getElementById("cantidad"+id).value);
		var _precio_ = parseFloat(document.getElementById("precio"+id).value);
		var _iva_ = parseFloat(document.getElementById("iva"+id).value)/100;
		var importe_v = round(_cantidad_*_precio_,2) + round(_cantidad_*(_precio_*_iva_),2);
		/*var importe = document.getElementById("importe"+id);  
		importe.value = importe_v;*/

		
		//importe = parseFloat($("#cantidad"+id).val())*(parseFloat($("#precio"+id).val())+(parseFloat($("#precio"+id).val())*(parseFloat($("#iva"+id).val())/100)))
		$("#importe"+id).html(importe_v.toFixed(2));
		
		//alert(id);
		sumar();
	});
	$("input:checkbox").each(function(){
		$(this).click(function(){
			quitar($(this));
		});
	});
}
</script>  
<style>
.num{width:50px; text-align:right}
</style>
<span id="ocurre"></span>
<form id="form1" name="form1" method="post" action="" onsubmit="return ingresar();">
<center>
    <table border="0" align="center" cellpadding="4" cellspacing="0" class="bordear_tabla">
      <tr>
        <th>Folio</th>
        <td>
					<input type="text" value="<?=$_GET[folio]?>" name="folio" id="folio" readonly="readonly" />
					<input type="hidden" value="<?=$_GET[serie]?>" name="serief" id="serief" readonly="readonly" />
				</td>
        <th>Fecha</th>
        <td>
        	<input type="text" name="fecha" value="<?=$r[fecha_factura]?>" size="10" maxlength="10" readonly="readonly" />
          <img src="imagenes/calendar.png" onclick="displayDatePicker('fecha');" style="margin-bottom:-3px; cursor:pointer" />
        </td>
      </tr>
      <tr>
        <th>Almac&eacute;n</th>
        <td>
        	<?=$r[descripcion]?>
        </td>
        <th>Moneda</th>
        <td><?=$r[moneda]?></td>
      </tr>
      <tr>
        <th>Precios</th>
        <td>
        	<?php if($r[licitacion] == "_normal_"){echo "Normal";} else {echo $r[licitacion];}?></td>
        <th>Pago</th>
        <td>
					<select name="pago" id="pago" onchange="credito_show(this);">
            <option value="contado">Contado</option>
            <option value="credito" selected="selected">Cr&eacute;dito</option>
          </select>
				</td>
      </tr>
      <tr>
        <th>M&eacute;todo de pago</th>
        <td>
					<select name="metodoDePago">
						<option>EFECTIVO</option>
						<option <?=selected($r[metodoDePago],'TARJETA DE CREDITO')?>>TARJETA DE CREDITO</option>
						<option <?=selected($r[metodoDePago],'TARJETA DE DEBITO')?>>TARJETA DE DEBITO</option>
						<option <?=selected($r[metodoDePago],'CHEQUE NOMINATIVO')?>>CHEQUE NOMINATIVO</option>
						<option <?=selected($r[metodoDePago],'TRANSFERENCIA BANCARIA')?>>TRANSFERENCIA BANCARIA</option>
						<option <?=selected($r[metodoDePago],'NO IDENTIFICADO')?>>NO IDENTIFICADO</option>
					</select>
				</td>
        <th>No. de cuenta</th>
        <td><input name="NumCtaPago" id="NumCtaPago" placeholder="Definido por el cliente" value="<?=$r[NumCtaPago]?>" /></td>
      </tr>
      <?php
			if($tipo == "f")
			{
			?>
      <tr>
        <th>Leyenda</th>
        <td style="white-space:normal" colspan="3"><textarea name="leyenda" cols="60" rows="3" id="leyenda"><?=$r[leyenda]?></textarea></td>
      </tr>
      <tr>
        <th>Cliente</th>
        <td colspan="3">
					<select name="cliente" id="cliente" onchange="cliente_data_ajax(this);">
						<optgroup label="Con credito disponible">
						<?php
							function dateDiff($start, $end) {$start_ts = strtotime($start);$end_ts = strtotime($end);$diff = $end_ts - $start_ts;return round($diff / 86400);}
							if(mysql_num_rows($query_cliente) > 0)
							{
								while($c = mysql_fetch_array($query_cliente))
								{
									echo "<option value='{$c[clave]}' title='{$c[credito]}~{$disponible}' ".selected($c[clave],$r[id_cliente]).">{$c[nombre]}</option>";
								}
							}
						?>
						</optgroup>
						<optgroup label="Para pago de contado" id="morosos"></optgroup>
          </select>
				</td>
      </tr>
      <tr id="tr_datos_cliente">
        <th>Datos del Cliente</th>
        <td colspan="3"><textarea name="cliente_data" cols="60" rows="5" readonly="readonly" id="cliente_data"></textarea><input type="hidden" name="cliente_datos" value="" id="cliente_datos" /></td>
      </tr>
    </table>

      <?php } ?>
    </table>
<br />
    <table border="0" align="center" cellpadding="5" cellspacing="0" class="bordear_tabla lista" id="editables">
      <tr>
      	<th>&nbsp;</th><th>&nbsp;</th>
        <th>C&oacute;digo Barras</th>
        <th>Unidad</th>
        <th>Descripci&oacute;n</th>
        <th>Lote</th>
        <th>Cantidad<br>Almac�n</th>
        <th>Cantidad<br>Factura</th>
        <th>Precio</th>
        <th>% IVA</th>
        <!--<th>Sub-Total</th>-->
        <th>Eliminar</th>
      </tr>
  <?php
	$i=0;
	$n=0;
	$s = "SELECT
		fp.id_producto,
		fp.id_facturaproducto id,
		fp.cantidad,
		fp.lote,
		fp.precio,
		fp.descuento,
		fp.iva,
		fp.importe,
		fp.canti_,
		fp.unidad,
		IF(especial='0' OR especial='',productos.codigo_barras,'-') 'codigo_barras',
		IFNULL(productos.descripcion,fp.especial) 'descripcion',
		IFNULL(fp.complemento,NULL) 'complemento'#,
		#SUM(devoluciones_clientes_detalles.cantidad) 'devueltos',
		#devoluciones_clientes_detalles.id_devolucion 'devolucion'
		FROM
		facturas_productos fp
		LEFT JOIN productos ON fp.id_producto = productos.id_producto
		/*LEFT JOIN devoluciones_clientes ON devoluciones_clientes.factura = '{$_GET[folio]}'
		LEFT JOIN devoluciones_clientes_detalles
			ON devoluciones_clientes_detalles.id_producto = fp.id_producto
			AND devoluciones_clientes_detalles.lote = fp.lote
			AND devoluciones_clientes_detalles.id_devolucion = devoluciones_clientes.id*/
		WHERE folio_factura = '{$_GET[folio]}' {$serie1}
		GROUP BY fp.id_facturaproducto";
	$q = mysql_query($s) or die ($s.mysql_error());
	while($r = mysql_fetch_assoc($q)){
		if($i%2 == 0) $class = "tr_list_0"; else $class = "tr_list_1";
			$i++;
			$sub_total += round($r[cantidad]*$r[precio],2);
			//$descuento += $r[cantidad]*($r[precio]*($r[descuento]/100));
			$iva += round($r[cantidad]*$r[precio]*($r[iva]/100),2);
			
			$sp = "SELECT cantidad FROM existencias WHERE id_producto = {$r[id_producto]} AND lote = '{$r[lote]}' AND id_almacen = {$al}";
			$qp = mysql_query($sp);
			$rp = mysql_fetch_assoc($qp);
	?>
  <tr class="<?=$class?>"
  onMouseOver="this.setAttribute('class', 'tr_list_over');"
  onMouseOut="this.setAttribute('class', '<?=$class?>');"
  >
  	<td>&nbsp;</td><td>&nbsp;</td>
    <td><?=$r[codigo_barras]?></td>
    <td><input type="text" id="unidades_old<?=$n?>" name="unidades_old[<?=$n?>]" value="<?=$r[unidad]?>" size="10"/></td>
    <td style="white-space:normal">
    <?=$r[descripcion]?><br />
		<textarea name="complemento_old[<?=$n?>]" cols="20" rows="3" class="num complemento" id="complemento<?=$n?>" style="width:200px; height:39px; text-align:left"><?php
			if($r[complemento] != "0")
			{
				echo $r[complemento];
			}
		?></textarea>
    </td>
    <td style="text-align:center"><?=$r[lote]?></td>
    <td style="text-align:center"><input type="text" id="cantidad<?=$n?>" name="cantidad_old[<?=$n?>]" value="<?=$r[cantidad]?>" class="num cantidad" onblur="maximi(this,<?=$r[cantidad]?>,<?=round($rp[cantidad],3)?>, <?=($r[codigo_barras] == "-") ? 1 : 0?>); numero(this,3);" />
    <?php //agregado el 05-11-2010 by chris?>
    </td>
		<td style="text-align:center">
    <input style="text-align:right;" type="text" id="cantidadesp<?=$n?>" name="cantidad_old_esp[<?=$n?>]" value="<?=$r[canti_]?>" size="6" onblur="maximi(this,<?=$r[canti_]?>,<?=round($rp[cantidad],3)?>, <?=($r[codigo_barras] == "-") ? 1 : 0?>); numero(this,3);" />
        <?php //termina?>

    </td>
    <td style="text-align:right"><input type="text" id="precio<?=$n?>" name="precio_old[<?=$n?>]" value="<?=$r[precio]?>" class="num precio" /></td>
    <td style="text-align:right"><input type="text" id="iva<?=$n?>" name="iva_old[<?=$n?>]" value="<?=$r[iva]?>" class="num iva" /></td>
   <!-- <td style="text-align:right" id="importe<?=$n?>" class="importe"><?=$r[importe]?></td>-->
    <td style="text-align:center">
    	<input name="eliminar[<?=$n?>]" type="checkbox" value="" />
      <input type="hidden" name="olds[<?=$n?>]" value="<?=$r[id]?>" />
    </td>
  </tr>
  <?php
		$n++;
	}
	?>
  </table>
 <br/>
  <table border="0" align="center" cellpadding="4" cellspacing="0" class="bordear_tabla lista" id="tabla_credito" style="margin-bottom:10px;">
      <caption id="aviso">
      Cr�dito
      </caption>
      <tr>
        <th>Total</th>
        <th>Disponible</th>
        <th>Con esta Venta</th>
      </tr>
      <tr>
        <td style="text-align:center"><input type="hidden" value="0" name="credito" id="credito"/>
          $ <span id="credito_span">0.00</span></td>
        <td style="text-align:center"><input type="hidden" value="0" name="credito_disponible" id="credito_disponible" />
          $ <span id="credito_disponible_span">0.00</span></td>
        <td style="text-align:center"><input type="hidden" name="sumatoria" id="sumatoria" />
          $ <span id="sumatoria_span">0.00</span></td>
      </tr>
    </table>
     <div style="margin:4px; margin-top:10px; font-weight:bold; font-size:14px">
  Agregar Productos
  </div>
    <table border="0" align="center" cellpadding="5" cellspacing="0" class="bordear_tabla lista" id="tabla_productos">
      <tr>
      	<th><img src="imagenes/icon_attention.png" width="16" height="16" /></th>
        <th>&nbsp;</th>
        <th>C&oacute;digo Barras</th>
        <th>Unidad</th>
        <th>Descripci&oacute;n</th>
        <th>Lote</th>
        <th>Disponible</th>
        <th>Cantidad<br>Almac�n</th>
        <th>Cantidad<br>Factura</th>
        <th>Precio</th>
        <th style="display:none">% Desc</th>
        <th>% IVA</th>
        <!--<th>Sub-Total</th>-->
        <th>&nbsp;</th>
      </tr>
      <tbody id="tabla"></tbody>
    </table>
      <br>
<table border="0" align="center" cellpadding="6" cellspacing="0" class="bordear_tabla">
      <tr>
        <th>Sub-Total</th>
        <td style="text-align:right" id="subtotal_td">0.00</td>
      </tr>
      <tr>
        <th>IVA</th>
        <td style="text-align:right" id="iva_td">0.00</td>
      </tr>
        <th>Total:</th>
        <td style="text-align:right" id="importe_td">0.00</td>
      </tr>
    </table>
<input type="hidden" value="0.00" name="importe_input" id="importe_input"  />
 <input name="tipo_venta" id="tipo_venta" type="hidden" value="" />
<button type="submit" style="margin-top:10px;">Guardar</button>
</center>
</form>
<br />
<script language="javascript" type="text/javascript">
$(document).ready(function(){
	n = <?=$n?>;
	activar_sumatoria();
	AgregarFila();
	sumar();
	<?php if($contados == ""){?>
	$("#pago").val("contado");
	$("#tabla_credito").hide();
	<?php }?>
	
	<?php if($tipo == "f"){ ?>
	$("#tipo_venta").val("1");
	try{ cliente_data_ajax($("#cliente").get(0)); } catch(err){  }
	<?php }else{ ?>
	$("#tipo_venta").val("0");
	<?php }?>
	
	var hecho = 0;
	var m = $('#morosos').hide();
	$('#pago').change(function(){
		var t = $(this);
		if(t.val() == 'contado' && hecho == 0)
		{
			hecho++;
			var cargando = '';//$('<span>Cargando clientes...</span>').css({ fontSize: '10px', float: 'right', marginTop: '5px', fontStyle: 'italic' });
			$('#cliente').attr('disabled', false);
			t.parent().width(186);//.append(cargando);
			$.getJSON('ajax_tools.php', { morosos: true }, function(data){
				$(data).each(function(i, r){
					var o = $("<option value='"+ r.clave +"' title='"+ r.credito +"~"+ r.disponible +"'>"+ r.nombre +"</option>");
					m.append(o);
				});
				m.show();
				//cargando.fadeOut();
				$('#cliente OPTION[value="<?=$id_cliente?>"]').attr('selected', true);
				cliente_data_ajax($("#cliente").get(0));
				$('#cliente').attr('disabled', false);
			});
		}
	}).change();
});
</script>