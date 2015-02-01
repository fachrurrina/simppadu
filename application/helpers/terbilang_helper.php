<?php

/*function terbilang($bilangan){
	$bilangan = abs($bilangan);
	
	$angka = array("Nol","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas");
	$temp = "";
	
	if($bilangan < 12){
		$temp = " ".$angka[$bilangan];
	}else if($bilangan < 20){
		$temp = terbilang($bilangan - 10)." belas";
	}else if($bilangan < 100){
		$temp = terbilang($bilangan/10)." puluh".terbilang($bilangan%10);
	}else if ($bilangan < 200) {
		$temp = " seratus".terbilang($bilangan - 100);
	}else if ($bilangan < 1000) {
		$temp = terbilang($bilangan/100). " ratus". terbilang($bilangan % 100);
	}else if ($bilangan < 2000) {
		$temp = " seribu". terbilang($bilangan - 1000);
	}else if ($bilangan < 1000000) {
		$temp = terbilang($bilangan/1000)." ribu". terbilang($bilangan % 1000);
	}else if ($bilangan < 1000000000) {
		$temp = terbilang($bilangan/1000000)." juta". terbilang($bilangan % 1000000);
	}
	
	return $temp;
}*/


function terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}