<script type="text/javascript">
	$(document).ready(function() {
		$('.apm-delete input').click(function() {
			var checkbox_id = $(this).attr('id');
			console.log(checkbox_id);
			console.log("This APM Checked? "+$('#'+checkbox_id).is(':checked'));

			if($('#'+checkbox_id).is(':checked') == true){
				$('#'+checkbox_id).addClass('d-none');
				$('#'+checkbox_id).next().addClass('d-none');
				var apm_id = checkbox_id.split('-')[2];

				$('#confirm-'+checkbox_id).append('<button class=" confirm-delete btn btn-warning">Oke chưa ?</button>');
				$('.confirm-delete').click(function() {
					$.ajax({
							type:'post',
							url: '<?= base_url() ?>Apartment/Delete',
							data: {apm_id: apm_id}
					});
					$(this).closest('.address-item-block').fadeOut(1000,function(){
			            $(this).closest('.address-item-block').remove();
			            console.log("remove this apm ! yeah ");
			        });
				});
				$('.confirm-delete').fadeOut(5000, function(){
					$('#'+checkbox_id).removeClass('d-none');
					$('#'+checkbox_id).next().removeClass('d-none');
					$(this).remove();
				});
			}

		});

		$('.room-delete input').click(function() {
			var checkbox_id = $(this).attr('id');
			console.log(checkbox_id);
			console.log("This Room Checked? "+$('#'+checkbox_id).is(':checked'));

			if($('#'+checkbox_id).is(':checked') == true){
				$('#'+checkbox_id).addClass('d-none');
				$('#'+checkbox_id).next().addClass('d-none');
				var room_id = checkbox_id.split('-')[2];

				$('#confirm-'+checkbox_id).append('<button class=" confirm-delete btn btn-warning">Oke chưa ?</button>');
				$('.confirm-delete').click(function() {
					 $(this).closest('tr').remove();
					$.ajax({
							type:'post',
							url: '<?= base_url() ?>Apartment/deleteRoom',
							data: {room_id: room_id},
							success: function(){
								console.log(`deleted room id = ${room_id}`);
							}
					});

				});
				$('.confirm-delete').fadeOut(3000, function(){
					$('#'+checkbox_id).removeClass('d-none');
					$('#'+checkbox_id).next().removeClass('d-none');
					$(this).remove();
				});
			}

		});

	})
</script>