 <!-- select2 -->
 <!-- modal cetak nota -->
 <div class="modal fade bd-example-modal-xl" id="modal_cetakNota" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <div class="modal-header bg-success">
                 <h5 class="modal-title">Cetak Nota</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div id="printThis">
                     <section class="content">
                         <div class="container-fluid">
                             <div class="row">
                                 <div class="col-12">
                                     <!-- Main content -->
                                     <div class="invoice p-3 mb-3">
                                         <!-- title row -->
                                         <div class="row invoice-info">
                                             <div class="col-12 invoice-col">
                                                 <h4>
                                                     <span> <img src="<?= base_url('assets/'); ?>dist/img/logoSIA.png" width="40"></span> Apotek Ajwa
                                                     <!-- <small class="float-right"><?= date("d/m/Y"); ?></small> -->
                                                 </h4>
                                             </div>
                                             <!-- /.col -->
                                         </div>
                                         <!-- info row -->
                                         <div class="row invoice-info">
                                             <div class="col-sm-4 invoice-col">
                                                 <address>
                                                     <strong>Jl. Daeng Pasau No. 9A Kel. Tahoa</strong><br>
                                                     No. Hp: 085241804046<br>
                                                     Email: rahmat.nur515@gmail.com
                                                 </address>
                                             </div>
                                         </div>
                                         <div class="row invoice-info">
                                             <div class="col-12 table-responsive invoice-col">
                                                 <table class="table table-borderless table-sm tableLine" id="tablenota" style="width: 100%;">
                                                     <tr>
                                                         <th style="width: 10%;">No. Nota :</th>
                                                         <td style="width: 40%;" id="invoice_no_nota"></td>
                                                         <th style="width: 15%;"> Nama :</th>
                                                         <td style="width: 35%;" id="invoice_nama"></td>
                                                     </tr>
                                                     <tr>
                                                         <th>Tgl. Nota :</th>
                                                         <td id="invoice_tgl_nota"></td>
                                                         <th> Alamat :</th>
                                                         <td id="invoice_alamat"></td>
                                                     </tr>
                                                     <tr>
                                                         <th colspan="2"></th>
                                                         <th>Keterangan :</th>
                                                         <td id="invoice_note"></td>
                                                     </tr>
                                                 </table>
                                             </div>
                                         </div>
                                         <!-- /.row -->

                                         <!-- Table row -->
                                         <div class="row nvoice-info">
                                             <div class="col-12 table-responsive invoice-col">
                                                 <table class="table table-borderless table-sm tableLine" id="detaillist_nota" style="width: 100%;" border="0">
                                                     <thead>
                                                         <tr>
                                                             <th>Kode</th>
                                                             <th>Nama Obat</th>
                                                             <th>Satuan</th>
                                                             <th>Harga @</th>
                                                             <th>qty</th>
                                                             <th>Subtotal</th>
                                                         </tr>
                                                     </thead>
                                                     <tbody>

                                                     </tbody>
                                                 </table>
                                             </div>
                                             <!-- /.col -->
                                         </div>
                                         <!-- /.row -->

                                         <div class="row nvoice-info">
                                             <!-- accepted payments column -->
                                             <div class="col-8">
                                             </div>
                                             <!-- /.col -->
                                             <div class="col-4 table-responsive invoice-col">
                                                 <table class="table table-borderless tableLine">
                                                     <tr>
                                                         <th style="width:50%">Total :</th>
                                                         <td id="invoice_Total"></td>
                                                     </tr>
                                                     <tr>
                                                         <th>Jumlah Bayar :</th>
                                                         <td id="invoice_bayar"></td>
                                                     </tr>
                                                     <tr>
                                                         <th>Kembalian :</th>
                                                         <td id="invoice_kembali"></td>
                                                     </tr>
                                                 </table>
                                             </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-7"></div>
                                             <div class="col-5" style="text-align:center">
                                                 Tanggal, <?= date("d/m/Y"); ?> <br><br><br><br><br>(_______________)
                                             </div>
                                         </div>
                                         <!-- /.row -->
                                     </div>
                                     <!-- /.invoice -->
                                 </div><!-- /.col -->
                             </div><!-- /.row -->
                         </div><!-- /.container-fluid -->
                     </section>
                 </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button id="btnPrint" type="button" class="btn btn-success">Print</button>
                 <button onclick="klikbtnPrint_thermal()" id="btn_thermal" type="button" class="btn btn-warning" disabled>Print Thermal</button>
             </div>
         </div>
     </div>
 </div>

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
     var dataPrint;
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


     async function CetakNota(param) {
         $('#btn_thermal').attr("disabled", true);
         let id = $(param).data('id');
         let nama = $(param).data('nama');
         let alamat = $(param).data('alamat');
         let note = $(param).data('note');
         let tot_trx = $(param).data('tot_trx');
         let tot_bayar = $(param).data('tot_bayar');
         let kembali = $(param).data('kembali');
         let tgl_nota = $(param).data('tgl_nota');
         $('.row_trx').remove();
         await $.ajax({
             url: "<?php echo site_url('user/detailTrxPenjualan') ?>/" + id,
             type: "GET",
             dataType: "JSON",
             success: function(data) {
                 let arrnama = [];
                 let satuanforNota = [];
                 let arr_qty = [];
                 let arr_harga = [];
                 let arr_subtotal = [];

                 for (let index = 0; index < data.length; index++) {
                     $("#detaillist_nota tbody").append(`<tr class="row_trx">
                     <td>${data[index].kd_transaksi}</td>
                     <td>${data[index].nama_obat}</td>
                     <td>${data[index].satuan}</td>
                     <td>${formatRupiah(data[index].harga_jual)}</td>
                     <td>${data[index].qty}</td>
                     <td>${formatRupiah(data[index].sub_total)}</td>
                     </tr>`);

                     arrnama.push(data[index].nama_obat)
                     satuanforNota.push(data[index].satuan)
                     arr_qty.push(data[index].qty)
                     arr_harga.push(data[index].harga_jual)
                     arr_subtotal.push(data[index].sub_total)
                 }
                 //  $("#detaillist_nota tbody").html(tableNota);

                 dataPrint = {
                     'order_id': id,
                     'tagihan_simpan': replaceRp(tot_trx),
                     'bayar_simpan': replaceRp(tot_bayar),
                     'kembalian_simpan': replaceRp(kembali),
                     'arrnama': arrnama,
                     'satuanforNota': satuanforNota,
                     'arr_qty': arr_qty,
                     'arr_harga': arr_harga,
                     'arr_subtotal': arr_subtotal,
                 };
                 $('#btn_thermal').removeAttr("disabled");

                 $("#invoice_nama").text(nama);
                 $("#invoice_alamat").text(alamat);
                 $("#invoice_note").text(note);
                 $("#invoice_bayar").text(tot_bayar);
                 $("#invoice_kembali").text(kembali);
                 $("#invoice_Total").text(tot_trx);
                 $("#invoice_tgl_nota").text(tgl_nota);

                 $('#invoice_no_nota ').text(id);


                 $('#modal_cetakNota').modal('show'); // show bootstrap modal when complete loaded
                 $('.modal-title').text('Cetak Nota : ' + id); // Set title to Bootstrap modal title
                 // print
                 printElement(document.getElementById("printThis"));
             },
             error: function(jqXHR, textStatus, errorThrown) {
                 alert('Error get data from ajax');
             }
         });
     }

     document.getElementById("btnPrint").onclick = function() {
         window.print();
     }

     function printElement(elem) {
         var domClone = elem.cloneNode(true);

         var $printSection = document.getElementById("printSection");

         if (!$printSection) {
             var $printSection = document.createElement("div");
             $printSection.id = "printSection";
             document.body.appendChild($printSection);
         }

         $printSection.innerHTML = "";
         $printSection.appendChild(domClone);
     }

     function klikbtnPrint_thermal() {
         //  window.print();
         $('#success_tic').modal('hide');

         $.ajax({
             type: "POST",
             url: "<?= base_url('Cetak/cetak'); ?>",
             data: dataPrint,
             dataType: "JSON",
             success: function(res) {
                 console.log(res);
                 //  if (res.code != "00") {
                 //      Swal.fire(
                 //          'Error!',
                 //          "gagal cetak Nota",
                 //          'error'
                 //      )
                 //  }

             },
             error: function(xhr, status, error) {
                 console.log(xhr.responseText);
                 Swal.fire(
                     'Error!',
                     xhr.responseText,
                     'error'
                 )

                 //  window.location.reload();
             }
         });
         $('#btn_thermal').attr("disabled", true);
     }

     function replaceRp(inputString) {
         // Input string
         // Remove non-numeric characters
         var numericString = inputString.replace(/\D/g, ''); // This removes all non-digit characters

         // Convert the numeric string to a number
         return parseInt(numericString, 10); // Parse as base 10


     }
 </script>