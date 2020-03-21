<?php
	$address_addnew = 'd-none ';
    if ($list_district_editable != null)
    {
        $address_addnew = in_array($district_key, $list_district_editable) != 0 ? '':'d-none ';
    }   
?>

<div class="btn-list <?= $address_addnew ?>">
	<form class="form-inline form-group w-100" action="<?= base_url().'Apartment/new/'.$district_key ?>" method="post">
		<button type="submit" class=" form-control btn btn-success add-new-apm col-2 col-md-2 ml-1">Thêm</button>
	<div class="add-new"></div>
	</form>
</div>