<?php 
function sum_incomes_month($month){
	global $con;
	$year=date('Y');
	$sql=mysqli_query($con,"select SUM(deposito) as total from base where year(fecha_pago) = '$year' and month(fecha_pago)= '$month' ");
	$rw=mysqli_fetch_array($sql);
	echo $total=number_format($rw['total'],2,'.','');
	}
function sum_expenses_month($month){
	global $con;
	$year=date('Y');
	$sql=mysqli_query($con,"select SUM(amount) as total from expenses where year(created_at) = '$year' and month(created_at)= '$month' ");
	$rw=mysqli_fetch_array($sql);
	echo $total=number_format($rw['total'],2,'.','');
	}

	function sum_expenses_month_real($month){
		global $con;
		$year=date('Y', strtotime('-1 year'));
		$sql=mysqli_query($con,"select SUM(amount) as total from expenses where year(created_at) = '$year' and month(created_at)= '$month' ");
		$rw=mysqli_fetch_array($sql);
		echo $total=number_format($rw['total'],2,'.','');
		}

	function sum_expenses_month_last($month){
		global $con;
		$year=date('Y', strtotime('-1 year'));
		$sql=mysqli_query($con,"select SUM(deposito) as total from base where year(fecha_mens) = '$year' and month(fecha_mens)= '$month' ");
		$rw=mysqli_fetch_array($sql);
		echo $total=number_format($rw['total'],2,'.','');
		}

		function sum_incomes_mens_month($month){
			global $con;
			$year=date('Y', strtotime('-1 year'));
			$sql=mysqli_query($con,"select SUM(mens) as total from base where  category_id <>4 and category_id <>2  and year(fecha_mens) = '$year' and month(fecha_mens)= '$month' ");
			$rw=mysqli_fetch_array($sql);
			echo $total=number_format($rw['total'],2,'.','');
			}

				function sum_incomes_mens_actual_month($month){
					global $con;
					$year=date('Y');
					$sql=mysqli_query($con,"select SUM(mens) as total from base where   category_id <>4 and year(fecha_mens) = '$year' and month(fecha_mens)= '$month' ");
					$rw=mysqli_fetch_array($sql);
					echo $total=number_format($rw['total'],2,'.','');
					}

				function sum_incomes_mens_multas_month($month){
					global $con;
					$year=date('Y');
					$sql=mysqli_query($con,"select SUM(mens) as total from base where  category_id=4 and year(fecha_mens) = '$year' and month(fecha_mens)= '$month' ");
					$rw=mysqli_fetch_array($sql);
					echo $total=number_format($rw['total'],2,'.','');
					}
	
				function sum_saldos_casa($casa){
					global $con;
					$year=date('Y');
					$sql=mysqli_query($con,"SELECT b.saldo_inicial,ROUND(SUM(a.mens),2)AS mensualidades, ROUND(SUM(a.deposito),2)AS depositos ,ROUND ((SUM(a.mens) -SUM(a.deposito) ),2) AS total ,TIMESTAMPDIFF(MONTH, '2021-07-01', CURDATE() )AS mes_acum,b.casa ,b.propietario,IF(b.tarjetas=1, 'CON TARJETA', 'SIN TARJETA')AS tarjeta,b.referencia,b.correo FROM base a , personas b WHERE (a.casa=b.casa) and a.casa='$casa' GROUP BY casa ORDER BY b.referencia asc");
					$rw=mysqli_fetch_array($sql);
					echo $total=number_format($rw['total'],2,'.','');
					}

				function sum_tarjeta_casa($casa){
					global $con;
					$year=date('Y');
					$sql=mysqli_query($con,"SELECT b.saldo_inicial,ROUND(SUM(a.mens),2)AS mensualidades, ROUND(SUM(a.deposito),2)AS depositos ,ROUND ((SUM(a.mens) -SUM(a.deposito) ),2) AS total ,TIMESTAMPDIFF(MONTH, '2021-07-01', CURDATE() )AS mes_acum,b.casa ,b.propietario,IF(b.tarjetas=1, 'CON TARJETA', 'SIN TARJETA')AS tarjeta,b.referencia,b.correo FROM base a , personas b WHERE (a.casa=b.casa) and a.casa='$casa' and a.casa not in ('5B','11A','22A','32B','6B') and b.tarjetas=1  GROUP BY casa ORDER BY b.referencia asc");
					$rw=mysqli_fetch_array($sql);
					echo $total=number_format($rw['total'],2,'.','');
					}
	
?>

