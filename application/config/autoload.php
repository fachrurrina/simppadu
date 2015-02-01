<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Helper files
| 4. Custom config files
| 5. Language files
| 6. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packges
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/

$autoload['packages'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your application/libraries folder.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'session', 'xmlrpc');
*/

$autoload['libraries'] = array('database', 'session', 'form_validation');


/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/

$autoload['helper'] = array(
	'url',
	'alert',
	'modal',
	'tanggal',
	'terbilang',
	'romawi'
);


/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/

$autoload['config'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/

$autoload['language'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('model1', 'model2');
|
*/

$autoload['model'] = array(
	'm_koif_luas',
	'm_koif_tingkat',
	'm_koif_guna',
	'm_harga_dasar_bangunan',
	
	'm_kepemilikan_tanah',
	'm_jenis_bangunan',
	'm_kelembagaan_siup',
	'm_bidang_sib',
	'm_bidang_situ',
	'm_bidang_siujk',
	'm_bidang_ho',
	'm_bidang_siuk',
	'm_bidang_iup',
	'm_jenis_alat_tangkap',
	'm_master',
	'm_config',

	'm_imb',
	'm_tdp',
	'm_sipi',
	'm_sios',
	'm_siot',
	'm_sipp',
	'm_sikb',
	'm_sik',
	'm_sia',
	'm_sipo',
	'm_sikp',
	'm_sipb',
	'm_sib',
	'm_sipd',
	'm_siup',
	'm_sib',
	'm_sisbw',
	'm_siuakb',
	'm_tdi',
	'm_sipl',
	'm_ho',
	'm_situ',
	'm_siujk',
	'm_siuk',
	'm_modul',
	'm_sub_modul',
	'm_bentuk_perusahaan',
	'm_fo',
	'm_syarat',
	'm_kbli',
	
	'm_index_gangguan',
	'm_index_harga_dasar',
	'm_index_lokasi',
	'm_index_luas'
	
);


/* End of file autoload.php */
/* Location: ./application/config/autoload.php */