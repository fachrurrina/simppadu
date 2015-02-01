<?php 	 

function alert($jenis_alert, $pesan)
{
    return "	<div class='container'>
				<div class='col-lg-12'>
					<div class='alert alert-".$jenis_alert." alert-dismissible' role='alert'>
						<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
						".$pesan."
					</div>
				</div>
			</div>";
}