 <!-- select2 -->
 <script src="<?= base_url(); ?>/assets/vendor/datatables/datatables.min.js"></script>
 <script>
     var save_method; //for save method string
     var table;
     $(document).ready(function() {

         //datatables
         table = $('#table').DataTable({

             "processing": true, //Feature control the processing indicator.
             "serverSide": true, //Feature control DataTables' server-side processing mode.
             //  "order": [
             //      [6, "desc"]
             //  ],
             autoWidth: true,
             responsive: true,

             // Load data for the table's content from an Ajax source
             "ajax": {
                 "url": "<?= base_url('admin/getDatatableObat'); ?>",
                 "type": "POST",
             },

             //Set column definition initialisation properties.
             "columnDefs": [{
                 "targets": [-1], //last column
                 "orderable": false, //set not orderable
             }, ],

         });

     });

     function getFaktur(id) {
         $('.row_faktur').remove();
         $.ajax({
             url: "<?php echo base_url('admin/get_no_faktur') ?>/" + id,
             type: "GET",
             dataType: "JSON",
             success: function(data) {
                 for (let index = 0; index < data.length; index++) {
                     $('#table_detail_faktur').append(`<tr class="row_faktur">
                         <td>${index}</td>
                         <td>${data[index].no_faktur }</td>
                     </tr>`);
                 }
                 $('.modal-title').text('Faktur Obat');
             },
             error: function(jqXHR, textStatus, errorThrown) {
                 alert('Error get data from ajax');
             }
         });
     }

     function edit_obat(id) {
         save_method = 'update';
         $("#form_obat").trigger('reset'); // reset form on modals

         $('.form-group').removeClass('has-error'); // clear error class
         $('.help-block').empty(); // clear error string


         //Ajax Load data from ajax
         $.ajax({
             url: "<?php echo base_url('admin/getObatbyid') ?>/" + id,
             type: "GET",
             dataType: "JSON",
             success: function(data) {


                 $('[name="kd_obat"]').val(data.kd_obat);
                 $('[name="nama_obat"]').val(data.nama_obat);
                 $('[name="satuan"]').val(data.satuan);
                 $('[name="harga_jual"]').val(data.harga_jual);
                 $('[name="kemasan"]').val(data.kemasan);
                 $('[name="prinsipal"]').val(data.prinsipal);
                 $('[name="stok"]').val(data.stok);
                 $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                 $('.modal-title').text('Edit Obat'); // Set title to Bootstrap modal title


             },
             error: function(jqXHR, textStatus, errorThrown) {
                 alert('Error get data from ajax');
             }
         });
     }

     function deleteObat(id) {

         Swal.fire({
             title: 'Yakin Hapus Obat?',
             text: "",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Ya, Hapus!'
         }).then((result) => {
             if (result.isConfirmed) {
                 // ajax delete data to database
                 $.ajax({
                     url: "<?= base_url('admin/deleteObatById') ?>/" + id,
                     type: "GET",
                     dataType: "JSON",
                     success: function(data) {
                         Swal.fire(
                             'Terhapus!',
                             'Obat Telah Terhapus',
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

     function save() {
         $('#btnSave').text('saving...'); //change button text
         $('#btnSave').attr('disabled', true); //set button disable 


         // ajax adding data to database
         // var formData = new FormData($('#form')[0]);
         $.ajax({
             url: "<?= base_url('/admin/updateObat'); ?>",
             type: "POST",
             data: $("form").serialize(),
             dataType: "JSON",
             success: function(data) {
                 // console.log(data);

                 if (data.status) //if success close modal and reload ajax table
                 {
                     $('#modal_form').modal('hide');
                     reload_table();
                     Swal.fire(
                         'Sukses!',
                         'Data Telah diedit',
                         'success'
                     )
                 }
                 $('#btnSave').text('save'); //change button text
                 $('#btnSave').attr('disabled', false); //set button enable
             },
             error: function(xhr, status, error) {
                 console.log(xhr.responseText);
                 alert('Error adding / update data');
                 $('#btnSave').text('save'); //change button text
                 $('#btnSave').attr('disabled', false); //set button enable 

             }
         });
     }
 </script>