 <!-- select2 -->
 <script src="<?= base_url(); ?>assets/vendor/datatables/datatables.min.js"></script>
 <script>
     function detail_trx(id) {
         save_method = 'detail';
         //  $("#form_obat").trigger('reset'); // reset form on modals
         $('.row_trx').remove();
         //Ajax Load data from ajax
         $.ajax({
             url: "<?php echo site_url('user/detailTrxPenjualan') ?>/" + id,
             type: "GET",
             dataType: "JSON",
             success: function(data) {
                 for (let index = 0; index < data.length; index++) {
                     $('#table_detail_trx').append(`<tr class="row_trx">
                         <td>${data[index].kd_transaksi}</td>
                         <td>${data[index].nama_obat}</td>
                         <td>${data[index].qty}</td>
                         <td>${data[index].sub_total}</td>
                     </tr>`);
                 }


                 $('#modal_detail_trx').modal('show'); // show bootstrap modal when complete loaded
                 $('.modal-title').text('Detail Transaksi'); // Set title to Bootstrap modal title
             },
             error: function(jqXHR, textStatus, errorThrown) {
                 alert('Error get data from ajax');
             }
         });
     }
 </script>
 <script>
     $(document).ready(function() {

         //datatables
         table = $('#table_trx').DataTable({

             //  "processing": true, //Feature control the processing indicator.
             //  "serverSide": true, //Feature control DataTables' server-side processing mode.
             //  "order": [], //Initial no order.
             autoWidth: true,
             responsive: true,

             // Load data for the table's content from an Ajax source
             "ajax": {
                 "url": "<?= base_url('user/ajax_trx_penjualan'); ?>",
                 "type": "POST",
             },
             "order": [
                 [0, "desc"]
             ]

             //Set column definition initialisation properties.
             //  "columnDefs": [{
             //          "targets": [-1], //last column
             //          "orderable": true, //set not orderable
             //      },

             //  ],

         });

     });
 </script>