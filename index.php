<?php

error_reporting(0);

session_start();

$toplam = 0;
$_POST['miktar'] = 0;

$sepet = $_SESSION['sepet'];
$adet  = $_SESSION['adet'] ;

$urun = array("Silgi","Kalem","Cetvel","Pergel","Canta","Bant","Kitap","Boya");
$fiyat = array(12,3,1,2.5,9,0.5,4,3);

if (empty($_SESSION['sepet'])) {
	
	$sepet = array();
	$adet = array();

}

$key = array_search($_GET['id'],$sepet);

if ($_GET['action'] == 'ekle') {
	
	if (in_array($_GET['id'],$sepet)) {
		
		$adet[$key]++;

	}else{

		array_push($sepet, $_GET['id']);
		array_push($adet,1);

	}

}else if($_GET['action'] == 'sil'){

	unset($sepet[$key]);
	unset($adet[$key]);

}else if ($_GET['action'] == 'guncelle') {
	
	unset($adet);
	$i=0;

	foreach ($sepet as $key => $value) {

		$adet[$key]=$_POST['miktar'][$i];
		$i++;

	}

}

$_SESSION['sepet']=$sepet;
$_SESSION['adet']=$adet;


?>

<html>

<head>
	<title> SEPET UYGULAMASI </title>
</head>

<body>

<h3> SEPET UYGULAMASI </h3>
	

<?php 

echo "Sepetinizde Toplam : <b>" . count($sepet) . "</b> adet urun var. <br><br>";

?>

<form action="index.php?action=guncelle" method="post">

	<table>

<?php 

if ($sepet) {
	
	foreach ($sepet as $key => $value) {
		
		$eder = ($fiyat[$value]*$adet[$key]);
		$toplam += $eder;


		echo "<tr>

			<td> <a href='index.php?action=sil&id=$value'>Sil</a>
			<td>  $urun[$value]  </td>
			<td> <input type='text' name='miktar[]' value='$adet[$key]' size=3> </td>
			<td>  $eder TL </td>
		</tr>";
		
		
	}

}

?>

</table>

<p> Sepet Toplami : <strong> <?php echo $toplam; ?>  TL  </strong> </p>

<button type="submit"> Guncelle </button>

</form>

<h3> URUNLER </h3>

<?php

foreach ($urun as $key => $value) {

				echo '<tr>

						<td> '.$value ." </td>
						<td> ".$fiyat[$key]." TL </td> 
						<td>";

				echo '<a href="index.php?action=ekle&id='.$key.'">Ekle</a> </td> </tr> <br><br>';

		}

?>	

</body>
</html>	