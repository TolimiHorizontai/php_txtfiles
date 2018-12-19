<html>
<head>
<meta charset="UTF-8">

<style>
title {sveiki}
body {background-color: rgb(255, 255, 204);}
h4 {color: rgb(51, 51, 0); font-family: "Times New Roman"; font-size: 20px; font-weight: bold;}
p.nuoroda {color: rgb(117, 117, 163); text-align: left; font-family: verdana; font-weight: normal; font-size: 14px;}
#sveiki {
	margin-top: 10px;
    margin-bottom: 10px;
    margin-right: 700px;
    margin-left: 20px;
	padding-top: 5px;
    padding-right: 5px;
    padding-bottom: 5px;
    padding-left: 5px;
}
#formos{
	margin-top: 5px;
    margin-bottom: 10px;
    margin-right: 700px;
    margin-left: 20px;
	padding-top: 5px;
    padding-right: 5px;
    padding-bottom: 5px;
    padding-left: 5px;
	background-color:	rgb(255, 230, 255); color:rgb(115, 0, 230);
	align:left;
}
#reg {
	margin-top: 2px;
    margin-bottom: 2px;
    margin-right: 50px;
    margin-left: 5px;
	padding-top: 2px;
    padding-right: 5px;
    padding-bottom: 5px;
    padding-left: 5px;
} 
#jung{
	margin-top: 2px;
    margin-bottom: 2px;
    margin-right: 50px;
    margin-left: 5px;
	padding-top: 2px;
    padding-right: 5px;
    padding-bottom: 5px;
    padding-left: 5px;
}
	
.backLink a{
font-size: 22px;
font-style: bold;
color: #e6005c;	
}

</style>

</head>
<body>
<?php

if(isset($_GET['psl'])){
$psl = $_GET['psl'];}
else{$psl = "";}

if($psl == ""){
	echo "
	<div id='sveiki'><h4>Sveiki atvykę, <br>prisiregistruokite arba prisijunkite:</h4></div>
	<div id='formos'>  
	
<fieldset>
<legend><b>Duomenis įveskite čia:</b></legend>

<div id='reg'>
<h4>Registruotis:</h4>
<form action='index.php?psl=registracija', method='post'>
	Prisijungimo vardas: <input type='text' name='name'/> <br><br>
	Slaptažodis: <input type='password' name='passw'/> <br><br>
  <input type='submit' value='Registruoti'/> 
</form>
</div>

<div id='jung'>
<h4>Prisijungti:</h4>
<form action='index.php?psl=prisijungimas' method='post'>
  Prisijungimo vardas: <input type='text' name='name'/> <br><br>
Slaptažodis: <input type='password' name='passw'/> <br><br>
  <input type='submit' value='Prisijungti'/> 
</form>

</div>

</fieldset>
	</div>";
}

if($psl == "registracija"){
$name=$_POST['name'];
$passw=$_POST['passw'];


if($name == "" or $passw == ""){
	echo "Klaida, būtina užpildyti visus laukelius.<br>
		<a href='index.php'><i>Grįžkite į pradinį puslapį</i></a>";}

elseif (file_exists("$name.txt")){
	echo "Toks vartotojas jau egzistuoja. <br>
	<a href='index.php'><i>Grįžkite į pradinį puslapį</i></a>";}
	
else {
	$name=preg_replace('[^A-Za-z0-9]',"",$name);
	$atidaryti=fopen("$name.txt","w");
	fwrite($atidaryti,"$name|$passw");
	fclose($atidaryti);
	
	echo "Jūsų prisijungimo vardas yra $name.<br>
	Jūsų registracija sėkminga.<br>
	<a href='index.php'><i>Grįžkite į pradinį puslapį ir prisijunkite</i></a>
	";
}
}

if($psl == "prisijungimas"){
	
$name=$_POST['name'];
$passw=$_POST['passw'];

if ($name == "" or $passw == ""){
echo "Klaida, būtina užpildyti visus laukelius.<br>
<a href='index.php'><i>Grįžkite į pradinį puslapį</i></a>";}
else {
	
	if(file_exists("$name.txt")){
		$text=file_get_contents("$name.txt");
		$duomenys=explode("|",$text);
		if($duomenys[1]==$passw){
		echo "Puiku, $name, Jūs sėkmingai prisijungėte.<br>
		<a href='gauti2.php'><i><b>Čia galite pereiti į seną svetainės versiją</i></b></a><br>
		<br><a href='index.php'><i>Grįžkite į pradinį puslapį</i></a>";
}
		else {echo "Įvestas neteisingas slaptažodis.<br>
		<a href='index.php'><i>Grįžkite į pradinį puslapį</i></a>";}
}	
	else {
		echo "Toks vartotojas neregistruotas.<br>
		<a href='index.php'><i>Grįžkite į pradinį puslapį</i></a>
		";}
}
}

?>

<div class = "backLink">
		<br>
		<a href="../distribute.php"><i>Grįžti į darbų puslapį</i></a>
		<br>
	</div>
</body>

</html>