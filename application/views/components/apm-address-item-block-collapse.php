<?php 
$data = [
	"item_apm" => $item_apm,
	"list_service" => $list_service,
	"district_key" => $district_key,
	"list_district_editable" => $list_district_editable
];

 ?>

<div id="apm_<?= $item_apm['id'] ?>" class="collapse address-detail" role="tabpanel">
	<div class="card-body">
		<div class="d-none d-md-block">
			<?php 
				$this->load->view('components/apm-services', $data); 
			?>
		</div>
		<?php
			$this->load->view('components/apm-note-rooms-images-map', $data); 
		?>
	</div>
</div>