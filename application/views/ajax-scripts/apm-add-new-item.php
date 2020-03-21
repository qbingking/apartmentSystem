<script type="text/javascript">
  $(document).ready(function() {
    $.fn.dataTable.ext.errMode = 'none';
    $('.datatable').DataTable({

        "info": false,
        "lengthMenu": [ 10, 25, 50, 75, 100 ],
        "pageLength": 5,
        "language": {
            "paginate": {
              "next" : " >>",
              "previous": "<< "
            },
            "search":""
        },
        "oLanguage": {
            "sLengthMenu": "Xổ _MENU_ phòng"
        },
        buttons: [{extend: 'excelHtml5'}]
    });

    $('.addRow').click(function(){
        var idAddBtn = $(this).attr('id');
        var idTableRoom = $('#'+ idAddBtn).next().find('table').attr('id');
        console.log('id table room: '+ idTableRoom);
        $('#'+idTableRoom).dataTable().fnAddData( ['000','','','',''] );
        $.ajax({
            method: 'POST',
            url: '<?= base_url() ?>Apartment/newRoom',
            data: {apm_id:idTableRoom.split('_')[2]}
        });

    });

});


</script>