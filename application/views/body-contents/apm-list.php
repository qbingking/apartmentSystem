<?php 
    $this->load->view('functions/base');
    $district_active = 
    	($this->session->district_active != '') ? 
		$this->session->district_active : 7;
	$data['list_service'] = $list_service;
?>
<!-- Page-Title -->
<link rel="stylesheet" 
	href="<?= base_url() ?>templates/css/apartment-service-editable.css">
<link rel="stylesheet" 
	href="<?= base_url() ?>templates/css/apartment-note-editable.css">
<!-- include file css -->
<link rel="stylesheet" type="text/css" 
	href="<?= base_url() ?>vendors/assets/css/components/apm-block-address.css">

<?php 
	$this->load->view('components/apm-contact');	
?>
<div class="row">
	<div class="offset-md-1 col-md-10 offset-lg-1 col-lg-8 col-12">
		<div class="card-box">
			<?php 
				$this->load->view('components/apm-quotes', array('quote' => $quote)); 
         		$this->load->view('components/apm-districts-nav', [
         								'list_district' => $list_district,
         								'district_active' => $district_active
         							]);	
         	?>

            <div class="tab-content">
            	<?php foreach ($list_district as $district_key => $district_text): ?>
            		<div class="apm-order tab-pane <?= $district_key == $district_active?'show active':'' ?>" id="quan_<?= $district_key ?>">
            		<?php 
						
						$data['district_key'] = $district_key;
						$data['list_district_editable'] = $list_district_editable;
					
					    $data['address_can_editable'] = '';
					    $data['contenteditable'] = '';
					    $data['apartment_note_can_editable'] = '';
					    $data['service_info_can_editable'] = '';
					    $data['room_status_can_editable'] = '';
					    $data['apartment_tag'] = 'd-none';
					    $data['apartment_can_delete'] = 'd-none ';
					    $data['apartment_can_add'] = 'd-none ';
					    $data['add_new_room_btn'] = 'd-none';
					    $data['power_sale'] = '';
					    $data['power_lead'] = 'd-none';
					    
					    if($list_district_editable != null)
					    {
					    	$data['power_sale'] = is_product_manager(
					        									$district_key, 
					        									$list_district_editable, 'd-none');
					    	$data['power_lead'] = $data['power_sale'] == 'd-none' ? '': 'd-none';
					        $data['address_can_editable'] = is_product_manager(
					        									$district_key, 
					        									$list_district_editable,
					        									'address-editable ');
					        $data['apartment_can_delete'] = is_product_manager($district_key, $list_district_editable);
					        $data['apartment_can_add'] = is_product_manager($district_key, $list_district_editable);
					        $flag_apm_btn = is_product_manager(
	        									$district_key, 
	        									$list_district_editable, 
	        									'true');
					        $data['service_info_can_editable'] = is_product_manager(
					        										$district_key, 
					        										$list_district_editable,
					        										'service-info-editable');
					        $data['apartment_tag'] = is_product_manager(
					        										$district_key, 
					        										$list_district_editable,
					        										'apartment-tag');
					        $data['room_status_can_editable'] = is_product_manager(
					        										$district_key, 
					        										$list_district_editable,
					        										'room-status');
					        $data['contenteditable'] = is_product_manager(
					        										$district_key, 
					        										$list_district_editable,
					        										'contenteditable="true"');
					        $data['apartment_note_can_editable'] = is_product_manager(
					        										$district_key, 
					        										$list_district_editable,
					        										'note-editable');
					         
					        $data['add_new_room_btn'] = is_product_manager(
					        										$district_key, 
					        										$list_district_editable);
					    }
					?>

            		<?php $this->load->view('components/apm-btn-addnew', $data); ?>

            		<?php foreach ($list_apm as $index => $item_apm): ?>
            			<?php 
            			$data['item_apm'] = $item_apm;
            			$data['apartment_can_delete_btn_view'] = is_product_manager(
						        									$district_key, 
						        									$list_district_editable, 
						        									set_btn_delete('apm',$item_apm['id']));
            			$data['list_this_apm_tag'] = $this->apartment_tag_model->get_tag($item_apm['id']);

            			?>
            			<?php if($district_key == $item_apm['id_district']): ?>
							<div class="card mt-1 address-item-block" id="item-<?= $item_apm['id'] ?>">
							    <!-- item one -->
							    <?php 
							    	$this->load->view('components/apm-address-item-block', $data);
							    	$this->load->view('components/apm-address-item-block-collapse', $data);
							    ?>
							</div>
			            <?php endif; ?>
			        <?php endforeach; ?>
			        </div>
            	<?php endforeach; ?>
            	
            </div>

		</div> <!-- end col -->
	</div>
	<div class="d-none d-md-block col-md-10 col-lg-3  <?= $this->session->userdata('status') == 'consultant' ? 'd-none':'' ?>">
		<div class="card-box">
			<ul class="list-group">
			<?php foreach ($apartment_tag as $row): ?>
					<li class="list-group-item">
						<?= $row['name'] ?>
						<span class="float-right"><i class="mdi mdi-city"></i></span>		
					</li>
			<?php endforeach ?>
			</ul>
			<form action="<?= base_url().'Apartment/add_catelog/apartment_tag' ?>" method="post" accept-charset="utf-8" class="form-horizontal mt-3" role="form">
                <div class="form-group">
                        <input type="text" name="apartment_tag-new" class="form-control border border-success" placeholder="Tag mới">
                </div>
                <div class="form-group mb-0 justify-content-start row">
                    <div class="col-9">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Ok</button>
                    </div>
                </div>
            </form>
		</div>
	</div>
</div> 
<!-- end row -->