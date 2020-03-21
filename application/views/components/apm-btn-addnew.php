<div class="btn-list <?= (in_array($district_key, $list_district_editable) != 0) && ($editable == 1) ? '':'d-none' ?>">
	<form class="form-inline form-group w-100" action="<?= base_url().'Apartment/new/'.$district_key ?>" method="post">
		<button type="submit" class=" form-control btn btn-success add-new-apm col-2 col-md-2 ml-1">Thêm</button>
	<div class="add-new"></div>
	</form>
</div>