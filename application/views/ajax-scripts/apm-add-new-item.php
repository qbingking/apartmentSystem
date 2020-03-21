<script type="text/javascript">
  $(document).ready(function() {
    $.fn.dataTable.ext.errMode = 'none';

    $('.datatable').DataTable({
        "dom" : "<'row'<'col-md-12 col-12'ftr>>" +
                "<'row mb-2'<'col-4'><'col-4'B>>" +
            "<'row'<'col-5'l><'col-md-2'><'col-5'p>>",
        buttons: [
            {
                extend: 'excel',
                text: 'Exce',
                title: 'DS Phòng <?= date('d-m-Y') ?>' 
            },
            {
                extend: 'copy',
                text: 'copy'
            },
        ],
        "info": false,
        "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
        "pageLength": 5,
        "oLanguage": {
            "sLengthMenu": "Xổ _MENU_ phòng",
            "oPaginate": {
                "sNext": ">>", 
                "sPrevious": "<<"
            }
        }
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