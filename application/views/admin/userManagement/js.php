 <!-- select2 -->
 <script src="<?= base_url(); ?>/vendor/datatables/datatables.min.js"></script>
 <script>
     $('.custom-file-input').on('change', function() {
         let filename = $(this).val().split('\\').pop();
         $(this).next('.custom-file-label').addClass("selected").html(filename);
     });

     $(document).ready(function() {

         $('#bologna-list a').on('click', function(e) {
             e.preventDefault()
             $(this).tab('show')
         });
         //datatables
         table = $('#table').DataTable({
             //  "processing": true, //Feature control the processing indicator.
             //  "serverSide": true, //Feature control DataTables' server-side processing mode.
             //  "order": [], //Initial no order.
             autoWidth: true,
             responsive: true,
         });

     });
     $('#form_create').submit(function(e) {
         e.preventDefault();
         $.ajax({
             url: '<?= base_url('admin/userManagement'); ?>', //URL submit
             type: "post", //method Submit
             data: new FormData(this), //penggunaan FormData
             processData: false,
             contentType: false,
             cache: false,
             async: false,
             success: function(data) {
                 console.log(data)
                 if (data.success) {
                     Swal.fire(
                         'Berhasil Tambah User',
                         `${data.msg}`,
                         'success'
                     )
                 } else {
                     Swal.fire(
                         'Gagal!',
                         `${data.msg} ${data.data}`,
                         'error'
                     )
                 }
             },
             error: function(xhr, status, error) {
                 console.log(xhr.responseText);
                 alert('Error adding / update data');
             }
         });
     });


     function edit_user(id) {
         $("#form_user").trigger('reset'); // reset form on modals

         //Ajax Load data from ajax
         $.ajax({
             url: "<?php echo base_url('/admin/userById') ?>/" + id,
             type: "GET",
             dataType: "JSON",
             success: function(data) {

                 console.log(data);
                 $('[name="id_user"]').val(data.id);
                 $('[name="old_fileName"]').val(data.foto);
                 $('[name="namaUpdate"]').val(data.nama);
                 $('[name="usernameUpdate"]').val(data.username);
                 $('[name="roleUpdate"]').val(data.role_id).trigger('change');
                 $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                 $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title


             },
             error: function(jqXHR, textStatus, errorThrown) {
                 alert('Error get data from ajax');
             }
         });
     }

     function delete_user(id) {

         Swal.fire({
             title: 'Yakin Hapus User?',
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
                     url: "<?= base_url('/admin/deleteUser') ?>/" + id,
                     type: "GET",
                     dataType: "JSON",
                     success: function(data) {
                         Swal.fire(
                             'Terhapus!',
                             'User Telah Terhapus',
                             'success'
                         )
                         //  reload_table();
                     },
                     error: function(jqXHR, textStatus, errorThrown) {
                         alert('Error deleting data');
                     }
                 });

             }
         })
     }

     $('#form_user').submit(function(e) {
         e.preventDefault();

         $('#btnSave').text('saving...'); //change button text
         $('#btnSave').attr('disabled', true); //set button disable 
         // ajax adding data to database
         // var formData = new FormData($('#form')[0]);
         $.ajax({
             url: '<?= base_url('admin/editUser'); ?>', //URL submit
             type: "post", //method Submit
             data: new FormData(this), //penggunaan FormData
             processData: false,
             contentType: false,
             cache: false,
             async: false,
             success: function(data) {
                 console.log(data)
                 if (data.success) {
                     Swal.fire(
                         'Berhasil Tambah User',
                         `${data.msg}`,
                         'success'
                     )
                 } else {
                     Swal.fire(
                         'Gagal!',
                         `${data.msg} ${data.data}`,
                         'error'
                     )
                 }
             },
             error: function(xhr, status, error) {
                 console.log(xhr.responseText);
                 alert('Error adding / update data');
             }
         });
     });
 </script>