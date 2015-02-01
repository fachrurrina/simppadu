<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH ."third_party/PHPExcel/IOFactory.php";

class Excel_iofactory extends PHPExcel_IOFactory{
	
	function __construct(){
		parent::__construct();
	}
}