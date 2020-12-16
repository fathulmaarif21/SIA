 <!-- select2 -->
 <script src="<?= base_url(); ?>/vendor/datatables/datatables.min.js"></script>
 <script>
     $(document).ready(function() {

         //datatables
         table = $('#table').DataTable({

             "processing": true, //Feature control the processing indicator.
             "serverSide": true, //Feature control DataTables' server-side processing mode.
             "order": [], //Initial no order.
             autoWidth: true,
             responsive: true,

             // Load data for the table's content from an Ajax source
             "ajax": {
                 "url": "<?= base_url('obatDataTables'); ?>",
                 "type": "POST",
             },

             //Set column definition initialisation properties.
             "columnDefs": [{
                     "targets": [-1], //last column
                     "orderable": false, //set not orderable
                 },

             ],

         });

     });
 </script>