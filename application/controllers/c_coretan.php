<?php

class C_coretan extends CI_Controller{

	private $data;

	function __construct(){
		parent::__construct();
		
		// query blla bla
		$this->data['koplaporan'] = 'DINAS PENDAPATAN';
		$this->data['ttd'] = 'fachrul andy';

	}

	public function test(){
		echo "<pre>";
		print_r($this->data);
		echo "</pre>";
	}

	function index(){
		echo "<pre>$".print_r($this->m_index_lokasi->get_nilai(3), true)."</pre>";
	}

	public function nama_kadis(){
		echo $this->m_config->get_nama_kepala_dinas();
	}

	public function get_no_sk_where_no_daftar($no_daftar){
		$data = $this->m_situ->get_no_sk_where_no_daftar($no_daftar);

		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}

	public function uri_segment(){
		echo $this->uri->segment(1) .'/'. $this->uri->segment(2);
	}

	public function testexcel(){
		?>
			<table>
				<tbody>
					<tr>
						<td>Lorem ipsum dolor.</td>
						<td>Porro itaque, esse!</td>
						<td>Quibusdam, labore, velit.</td>
						<td>Aperiam, maiores est.</td>
						<td>Optio beatae, eius.</td>
					</tr>

					<tr>
						<td>Lorem ipsum dolor.</td>
						<td>Porro itaque, esse!</td>
						<td>Quibusdam, labore, velit.</td>
						<td>Aperiam, maiores est.</td>
						<td>Optio beatae, eius.</td>
					</tr>

					<tr>
						<td>Lorem ipsum dolor.</td>
						<td>Porro itaque, esse!</td>
						<td>Quibusdam, labore, velit.</td>
						<td>Aperiam, maiores est.</td>
						<td>Optio beatae, eius.</td>
					</tr>

					<tr>
						<td>Lorem ipsum dolor.</td>
						<td>Porro itaque, esse!</td>
						<td>Quibusdam, labore, velit.</td>
						<td>Aperiam, maiores est.</td>
						<td>Optio beatae, eius.</td>
					</tr>
				</tbody>
			</table>
		<?php
	}
}