<script type="text/javascript">
  $(document).ready(function() {
    $.fn.dataTable.ext.errMode = 'none';
    $('.datatable').DataTable({
        "info": false,
        "pageLength": 5,
        "language": {
            "paginate": {
              "next" : " >>",
              "previous": "<< "
            },
            "search":""
        }
    });

});


</script>