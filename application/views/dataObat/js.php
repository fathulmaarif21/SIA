 <!-- select2 -->
 <script src="<?= base_url(); ?>assets/vendor/datatables/datatables.min.js"></script>
 <script>
     $(document).ready(function() {

         //datatables
         table = $('#table').DataTable({

             "processing": true, //Feature control the processing indicator.
             "serverSide": true, //Feature control DataTables' server-side processing mode.
             "order": [
                 [5, "asc"]
             ],
             autoWidth: true,
             responsive: true,

             // Load data for the table's content from an Ajax source
             "ajax": {
                 "url": "<?= base_url('user/ajax_list'); ?>",
                 "type": "POST",
             },

             //Set column definition initialisation properties.


         });

     });
 </script>