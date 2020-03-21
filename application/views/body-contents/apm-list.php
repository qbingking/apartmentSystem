<!-- Page-Title -->
<link rel="stylesheet" href="<?= base_url() ?>templates/css/apartment-address-editable.css">
<link rel="stylesheet" href="<?= base_url() ?>templates/css/apartment-service-editable.css">
<link rel="stylesheet" href="<?= base_url() ?>templates/css/apartment-note-editable.css">

<?php $this->load->view('components/apm-contact'); ?>
<div class="row">
	<div class="offset-md-1 col-md-10 offset-xl-1 col-xl-8 col-12">
		<div class="card-box">
			<?php $this->load->view('components/apm-quotes', array('quote' => $quote)); ?>

			<?php 
        		$district_active = ($this->session->district_active != '') ? 
        							$this->session->district_active : 7;
         	?>

         	<?php 
         		$this->load->view('components/apm-districts-nav', 
         							array(
         								'list_district' => $list_district,
         								'district_active' => $district_active));	
         	?>

            <div class="tab-content">
            	<?php foreach ($list_district as $district_key => $district_text): ?>
            		<div class="apm-order tab-pane <?= $district_key == $district_active?'show active':'' ?>" id="quan_<?= $district_key ?>">
            		<?php 
						$data['list_service'] = $list_service;
						$data['district_key'] = $district_key;
						$data['list_district_editable'] = $list_district_editable;
					?>

            		<?php $this->load->view('components/apm-btn-addnew', $data); ?>

            		<?php foreach ($list_apm as $index => $item_apm): ?>
            			<?php $data['item_apm'] = $item_apm; ?>
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
</div> 
<!-- end row -->