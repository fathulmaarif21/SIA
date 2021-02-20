 <!-- select2 -->
 <script src="<?= base_url(); ?>/assets/vendor/datatables/datatables.min.js"></script>
 <!-- InputMask -->
 <script src="<?= base_url(); ?>/assets/plugins/moment/moment.min.js"></script>
 <script src="<?= base_url(); ?>/assets/plugins/inputmask/jquery.inputmask.min.js"></script>
 <!-- date-range-picker -->
 <script src="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
 <script>
     //  navigasi
     $('#bologna-list a').on('click', function(e) {
         e.preventDefault()
         $(this).tab('show')
     });


     //  console.log($('#reservation').val());

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
                         <td>${formatRupiah(data[index].sub_total)}</td>
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

             "processing": true, //Feature control the processing indicator.
             "serverSide": true, //Feature control DataTables' server-side processing mode.
             //  "order": [
             //      [8, "desc"]
             //  ], //Initial no order.
             autoWidth: true,
             responsive: true,

             // Load data for the table's content from an Ajax source
             "ajax": {
                 "url": "<?= base_url('admin/masterTrxPenjualanModel'); ?>",
                 "type": "POST",
             },

             //Set column definition initialisation properties.
             "columnDefs": [{
                     "targets": [-1], //last column
                     "orderable": false, //set not orderable
                 },

             ],

         });



         function deleteTrx(id) {

             Swal.fire({
                 title: 'Yakin Hapus Transaksi?',
                 text: "Transaksi yang telah di Hapus akan mengembalikan stok obat",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Ya, Hapus!'
             }).then((result) => {
                 if (result.isConfirmed) {
                     // ajax delete data to database
                     $.ajax({
                         url: "<?= base_url('/admin/deleteTrxPenjualanModel') ?>/" + id,
                         type: "GET",
                         dataType: "JSON",
                         success: function(data) {
                             Swal.fire(
                                 'Terhapus!',
                                 'Transaksi Telah Terhapus',
                                 'success'
                             )
                             reload_table();
                         },
                         error: function(jqXHR, textStatus, errorThrown) {
                             alert('Error deleting data');
                         }
                     });

                 }
             })
         }

         // inquery by date
         var startDate;
         var endDate;
         //Date range picker
         $('#reservation').daterangepicker({
             locale: {
                 format: 'DD/MM/YYYY'
             },

         }, function(start, end) {
             //  ("#id").css("display", "none");
             $("#div_inquery").css("display", "block");
             startDate = start.format('DD/MM/YYYY');
             endDate = end.format('DD/MM/YYYY');
             dataTable.draw();
         })

         // DataTable
         var dataTable = $('#empTable').DataTable({
             'processing': true,
             'serverSide': true,
             autoWidth: true,
             responsive: true,
             //  'serverMethod': 'post',
             //  'searching': true, // Set false to Remove default Search Control
             'ajax': {
                 'url': '<?= base_url('admin/masterTrxPenjualanModel'); ?>',
                 "type": "POST",
                 'data': function(data) {
                     // Read values
                     //  var from_date = startDate;
                     //  var to_date = endDate;

                     // Append to data
                     data.searchByFromdate = startDate;
                     data.searchByTodate = endDate;
                 }
             },
         });
     });
 </script>