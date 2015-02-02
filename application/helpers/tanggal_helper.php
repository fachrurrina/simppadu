<?php

function convert_tanggal_jadi_string($tanggal = null){
	
	if($tanggal == null){
		
		return;
	}

	$array_tanggal = explode('-', $tanggal);

	switch ($array_tanggal[1]) {
		case '01':
			$bulan_string = 'Januari';
			break;
		case '02':
			$bulan_string = 'Februari';
			break;
		case '03':
			$bulan_string = 'Maret';
			break;
		case '04':
			$bulan_string = 'April';
			break;
		case '05':
			$bulan_string = 'Mei';
			break;
		case '06':
			$bulan_string = 'Juni';
			break;
		case '07':
			$bulan_string = 'Juli';
			break;
		case '08':
			$bulan_string = 'Agustus';
			break;
		case '09':
			$bulan_string = 'September';
			break;
		case '10':
			$bulan_string = 'Oktober';
			break;
		case '11':
			$bulan_string = 'November';
			break;
		case '12':
			$bulan_string = 'Desember';
			break;
	}

	$format_baru = $array_tanggal[2] .' '. $bulan_string .' '. $array_tanggal[0];
	return $format_baru;
}

function selisihHari($tglAwal, $tglAkhir)
{
    // list tanggal merah selain hari minggu
    // $tglLibur = Array("2013-01-04", "2013-01-05", "2013-01-17");

    // memecah string tanggal awal untuk mendapatkan
    // tanggal, bulan, tahun
    $pecah1 = explode("-", $tglAwal);
    $date1 = $pecah1[2];
    $month1 = $pecah1[1];
    $year1 = $pecah1[0];

    // memecah string tanggal akhir untuk mendapatkan
    // tanggal, bulan, tahun
    $pecah2 = explode("-", $tglAkhir);
    $date2 = $pecah2[2];
    $month2 = $pecah2[1];
    $year2 =  $pecah2[0];

    // mencari total selisih hari dari tanggal awal dan akhir
    $jd1 = GregorianToJD($month1, $date1, $year1);
    $jd2 = GregorianToJD($month2, $date2, $year2);

    $selisih = $jd2 - $jd1;

    // proses menghitung tanggal merah dan hari minggu
    // di antara tanggal awal dan akhir
   /* for($i=1; $i<=$selisih; $i++)
    {
        // menentukan tanggal pada hari ke-i dari tanggal awal
        $tanggal = mktime(0, 0, 0, $month1, $date1+$i, $year1);
        $tglstr = date("Y-m-d", $tanggal);

        // menghitung jumlah tanggal pada hari ke-i
        // yang masuk dalam daftar tanggal merah selain minggu
        
        if (in_array($tglstr, $tglLibur))
        {
           $libur1++;
        }

        // menghitung jumlah tanggal pada hari ke-i
        // yang merupakan hari minggu
        if ((date("N", $tanggal) == 7))
        {
           $libur2++;
        }
    }*/

    // menghitung selisih hari yang bukan tanggal merah dan hari minggu
    return $selisih-$libur1-$libur2;
}