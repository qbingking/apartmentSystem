<script type="text/javascript">
	$(document).ready(function() {
    	//modify buttons style
        $.fn.editableform.buttons =
            '<button type="submit" class="btn btn-success editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button>' +
            '<button type="button" class="btn btn-light editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>';
            
    	$('.address-editable').editable({
            type: 'textarea',
            mode: 'inline',
            inputclass: 'form-control-sm',
            rows: 2,
            emptytext: "chưa có dữ liệu",
            url: "<?= base_url() ?>Apartment/updateWithoutRoom"
            
        });

        $('.service-info-editable div').editable({
            type: 'text',
            mode: 'inline',
            inputclass: 'form-control-sm',
            emptytext: "chưa có dữ liệu",
            url: "<?= base_url() ?>Apartment/updateWithoutRoom"
        });
        $('.note-editable div').editable({
            type: 'textarea',
            mode: 'inline',
            inputclass: 'form-control-sm',
            emptytext: "chưa có dữ liệu",
            url: "<?= base_url() ?>Apartment/updateWithoutRoom"
        });

        $('.apm_room td').focusout(function(){
            var id = $(this).attr('id');
            if(typeof id === 'undefined')
            {
                console.log(">>> confliting even forcusout");
                return;
            }
            var splited_id = id.split('-');
            var content = $(this).text();
            var apm_id = $(this).closest('.apm_room.datatable').attr('id').split('_')[2];
            console.log('apm id: ' + apm_id);
            field_name = splited_id[0];
            room_id = splited_id[1];
            console.log("room id: " + room_id + " ||  content: " + content + " || field: " + field_name);
            $.ajax({
                url: '<?= base_url() ?>Apartment/updateRoom',
                type:'post',
                data: {id: room_id, fieldName: field_name, content: content, apm_id: apm_id },
                success:function(){
                    console.log(`>>>Room - Updated
                        id = ${room_id}
                        field name = ${field_name}
                        value = ${content}`);
                }
            });
            $("body").unbind('click');

        });

        $('.room-status').click(function(){
            var content = $(this).text();
            console.log("content current is: " + content);
            var apm_id = $(this).closest('.apm_room').attr('id').split('_')[2];
            var room_id = $(this).attr('id').split('-')[1];
            if (content === "") {
                content = "trống";
                $(this).text('trống');
            } else {
                content ="";
                $(this).text('');
            }

            $.ajax({
                method: 'post',
                url: "<?= base_url() ?>Apartment/updateRoom",
                data: {fieldName: 'id_status',content: content, apm_id: apm_id, id: room_id },
                success: function(){
                    console.log('Status room to: '+ content);
                }
            })
        });

    });
</script>