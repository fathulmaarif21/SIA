<script src="<?= base_url(); ?>assets/vendor/datatables/datatables.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script>
    $('#id_select_obat').select2({
        theme: "bootstrap4",
        width: '100%',
        ajax: {
            url: "<?= base_url('Kasir/getObat'); ?>",
            dataType: 'json',
            type: "post",
            delay: 250,
            data: function(params) {
                return {
                    search: params.term,
                }
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true,
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        },
        placeholder: 'Ketik Nama Obat Atau kd Obat',
        minimumInputLength: 3,
    }).on('#id_select_obat select2:select', function(evt) {
        let kd_o = $("#id_select_obat option:selected").val();
        $('#addkd_obat').val(kd_o);

    });

    function detail_trx(id) {
        save_method = 'detail';
        //  $("#form_obat").trigger('reset'); // reset form on modals
        $('.row_trx').remove();
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo base_url('admin/detailFakturPembelian') ?>",
            type: "POST",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(data) {
                for (let index = 0; index < data.length; index++) {
                    $('#table_detail_trx').append(`<tr class="row_trx">
                         <td>${data[index].no_faktur}</td>
                         <td>${data[index].nama_obat}</td>
                         <td>${data[index].no_batch}</td>
                         <td>${data[index].qty}</td>
                         <td>${formatRupiah(data[index].harga_beli)}</td>
                         <td>${formatRupiah(data[index].sub_total)}</td>
                         <td>${data[index].tgl_expired}</td>
                         <td> <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="deleteDtlTrx(${data[index].id_dtl_pembelian})" title="Delete" ><i class="fas fa-trash"></i> Delete</a></td>
                        
                     </tr>`);
                }
                $('#addno_faktur').val(data[0].no_faktur);
                //  tombol delete sa kome dlu
                //  <td> <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="deleteDtlTrx(${data[index].id_dtl_pembelian})" title="Delete" ><i class="fas fa-trash"></i> Delete</a></td>


                $('#modal_detail_trx').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Detail Faktur'); // Set title to Bootstrap modal title
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
                    url: "<?= base_url('/admin/deleteFakturPembelian') ?>",
                    type: "POST",
                    data: {
                        id: id
                    },
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
                    url: "<?= base_url('/admin/deleteDetailFaktur') ?>",
                    type: "POST",
                    data: {
                        id: id
                    },
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
    $('#addqty').on('keyup change', function() {
        //  ini subtotal
        let hargaBeli = $('#addharga_beli').val();
        let qty = $(this).val();
        $(`#addsub_total`).val(formatRupiah(hargaBeli * qty, ''));
    });

    $("#formSubmitAddDetailFaktur").submit(function(e) {
        e.preventDefault();
        if ($("#id_select_obat").val()) {
            Swal.fire(
                'Obat Belum diisi!',
                'Silahkan Pilih Obat',
                'warning'
            )
            return
        }
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/addDetailFaktur'); ?>",
            data: $('form').serialize(),
            dataType: "JSON",
            success: function(res) {
                // console.log(res);
                $('#formSubmitAddDetailFaktur').each(function() {
                    this.reset();
                });
                $("#id_select_obat").val('').trigger('change');
                Swal.fire(
                    'Success',
                    'Data Tersimpan',
                    'success'
                )
                $('.modal').modal('hide');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                Swal.fire(
                    'Error!',
                    'coba cek dulu',
                    'error'
                )
            }
        });
    });
</script>