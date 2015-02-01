<?php

function get_status_modal_perusahaan($nilai_modal)
{
   	if($nilai_modal < 51000000){
   		$status_perusahaan = 'M';
   	}elseif ($nilai_modal < 501000000) {
   		$status_perusahaan = 'PK';
   	}elseif ($nilai_modal < 10100000000) {
   		$status_perusahaan = 'PM';
   	}else{
   		$status_perusahaan = 'PB';
   	}

   	return strtoupper($status_perusahaan);
}

