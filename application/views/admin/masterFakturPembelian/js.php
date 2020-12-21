 <!-- select2 -->
 <script src="<?= base_url(); ?>assets/vendor/datatables/datatables.min.js"></script>
 <script>
     function detail_trx(id) {
         save_method = 'detail';
         //  $("#form_obat").trigger('reset'); // reset form on modals
         $('.row_trx').remove();
         //Ajax Load data from ajax
         $.ajax({
             url: "<?php echo base_url('admin/detailFakturPembelian') ?>/" + id,
             type: "GET",
             dataType: "JSON",
             success: function(data) {
                 for (let index = 0; index < data.length; index++) {
                     $('#table_detail_trx').append(`<tr class="row_trx">
                         <td>${data[index].no_faktur}</td>
                         <td>${data[index].nama_obat}</td>
                         <td>${data[index].qty}</td>
                         <td>${data[index].harga_beli}</td>
                         <td>${data[index].sub_total}</td>
                         <td>${data[index].tgl_expired}</td>
                         <td> <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="deleteDtlTrx(${data[index].id_dtl_pembelian})" title="Delete" ><i class="fas fa-trash"></i> Delete</a></td>
                        
                     </tr>`);
                 }
                 //  tombol delete sa kome dlu
                 //  <td> <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="deleteDtlTrx(${data[index].id_dtl_pembelian})" title="Delete" ><i class="fas fa-trash"></i> Delete</a></td>


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
             "order": [
                 [4, "desc"]
             ],
             autoWidth: true,
             responsive: true,

             // Load data for the table's content from an Ajax source
             "ajax": {
                 "url": "<?= base_url('admin/dtFaktuPembelian'); ?>",
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

     function deleteTrx(id) {

         Swal.fire({
             title: 'Yakin Hapus Faktur?',
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
                     url: "<?= base_url('/admin/deleteFakturPembelian') ?>/" + id,
                     type: "GET",
                     dataType: "JSON",
                     success: function(data) {
                         Swal.fire(
                             'Terhapus!',
                             'Faktur Telah Terhapus',
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

     function deleteDtlTrx(id) {

         Swal.fire({
             title: 'Yakin Hapus Detail Faktur?',
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
                     url: "<?= base_url('/admin/deleteDetailFaktur') ?>/" + id,
                     type: "GET",
                     dataType: "JSON",
                     success: function(data) {
                         Swal.fire(
                             'Terhapus!',
                             'Detail Faktur Telah Terhapus',
                             'success'
                         )
                         $('#modal_detail_trx').modal('hide');
                     },
                     error: function(jqXHR, textStatus, errorThrown) {
                         alert('Error deleting data');
                     }
                 });

             }
         })
     }
 </script>