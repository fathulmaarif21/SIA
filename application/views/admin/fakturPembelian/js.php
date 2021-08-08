<!-- Select2 -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script>
    document.addEventListener('keydown', function(e) {

        if (e.which === 113 || e.keyCode === 113) {
            // alert("1234");
            $('#id_select_obat').select2('open');
            e.preventDefault();
        }
        //  if (e.which === 9 || e.keyCode === 9) {
        //      $('#totalBayar').focus();
        //      e.preventDefault();
        //  }
    });
    //  navigasi
    $('#bologna-list a').on('click', function(e) {
        e.preventDefault()
        $(this).tab('show')
    });
    //  delete list
    $("#keranjangList").on('click', '.delRow', function() {
        $(this).closest('tr').remove();
        updateTotalTagihan();
    });
    // handle ppn cked
    function enablePPn() {
        var checkBox = document.getElementById("myCheck");
        if (checkBox.checked == true) {
            $('#PPn').val(10);
            hitungPpn(true, 10)

            $('#PPn').prop('readonly', false);
            $('#div_ppn').show();
        } else {
            $('#PPn').val(0);
            hitungPpn(false, 0)

            $('#PPn').prop('readonly', true);
            $('#div_ppn').hide();
        }
    }
    $('#PPn').on('keyup change', function() {
        hitungPpn(true, $(this).val())
    });

    function hitungPpn(cek, ppn) {
        let val_jumlah = $('#jml_harga').val();
        let jml_h = parseInt(remove_str(val_jumlah));
        let total = jml_h,
            resultPPn = 0;
        if (cek) {
            let int_ppn = parseInt(ppn);
            resultPPn = jml_h * int_ppn / 100;
            let t_tagihan = jml_h + resultPPn;
            total = t_tagihan;

            console.log(jml_h);
            console.log(t_tagihan);
        } else {
            console.log('jmlbayar sama dengan total')
        }
        $('#resultPPn').val(formatRupiah(resultPPn, ''));
        $('#totalTagihan').html(formatRupiah(total, ''));

        // let ppn = parseInt($('#PPn').val());
        // let t_tagihan = (jml_h * ppn / 100)
        // console.log(t_tagihan);
    }
</script>
<script>
    var no = 1;
    //  $(document).ready(function() {

    $('.js-example-basic-single').select2({
        theme: "bootstrap4",
        width: '100%'
    });

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
        var nm = $("#id_select_obat option:selected").val();
        //   console.log(nm);
        $.ajax({
            type: 'POST',
            url: '<?= base_url('kasir/getObatById'); ?>',
            data: {
                data: nm
            },
            dataType: 'JSON',
            success: function(res) {
                $("#id_select_obat").val('').trigger('change');
                if (cekIdInLsit(res.id)) {
                    Swal.fire(
                        'Warning!',
                        'Obat atau Kode Obat sudah ada dilist',
                        'warning'
                    )
                    return false
                }
                $('#addList').append(`
                 <tr id="${res.id}">
                        <td scope="row">${res.id}</td>
                        <td class="namafornota">${res.nama_obat}</td>
                        <td><input type="text" class="form-control" name="no_batch[]"  required></td>
                        <td><input type="text" id="hb${res.id}" onkeyup="formathb(this)"  class="form-control harga_beli"   name="harga_beli[]"  required></td>
                        <td>
                            <div class="form-group col-auto">
                                <div class="">
                                    <input type="hidden" class="form-control" name="kd_obat[]" value="${res.id}" readonly>
                                    <input type="hidden" class="form-control" name="harga[]" value="${res.harga}" readonly>
                                    <input type="hidden" class="form-control" name="stok[]" value="${res.stok}" readonly>
                                    <input type="number"  class="form-control getData-FromInput"  data-nama_obat="${res.nama_obat}" data-kd_obat="${res.id}" data-stok="${res.stok}" data-harga="${res.harga}"  min="1" value='' name="qty[]"  required>
                                    <div class="invalid-tooltip">
                                        Qty Lebih Dari Jumlah Stok
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><input type="date" class="form-control" name="tglExp[]"  required></td>
                        <td><input type="text" class="form-control ${res.id} " name="subTotal[]" value="0" readonly required></td>
                        <td>
                            <button type="button" class="btn btn-danger delRow"> <i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                 `)

                handleSubTotal();
                updateTotalTagihan();
                $(`input[name ="no_batch[]"]:last`).focus();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // console.log(xhr.);
                console.log(xhr.responseText);
            }
        })
    });

    function formathb(params) {
        let hb = remove_str(params.value);
        params.value = formatRupiah(hb, '');
    }

    function handleSubTotal() {
        $('.getData-FromInput').on('keyup change', function() {
            let kd_obat = $(this).data('kd_obat');
            let hargaBeli = remove_str($(`#hb${kd_obat}`).val());
            let stok = parseInt($(this).data('stok'));
            let qty = parseInt($(this).val());

            //  ini subtotal
            $(`.${kd_obat}`).val(formatRupiah(hargaBeli * qty, ''));

            // update total tagihan
            updateTotalTagihan();
        });
        //  $('.harga_beli').on('keyup change', function() {
        //      countSubTotal(this);
        //  });
    }

    function cekIdInLsit(resId) {
        let cek = $('#keranjangList tr').map(function() {
            return this.id
        }).get();
        return cek.includes(resId);
    }

    function updateTotalTagihan() {
        if ($("#keranjangList tr").length > 1) {
            let arrSubTotal = $("input[name='subTotal[]']")
                .map(function() {
                    return remove_str($(this).val());
                }).get().reduce(function(total, num) {
                    return total + num;
                });
            // update total tagihan
            $('#jml_harga').val(formatRupiah(arrSubTotal, ''));
            $('#totalTagihan').html(formatRupiah(arrSubTotal, ''));
        }

    }
    $("#formSubmitFaktur").submit(function(e) {
        e.preventDefault();

        let totalRowCount = $("#keranjangList tr").length - 1;
        if (totalRowCount == 0) {
            Swal.fire(
                'Warning!',
                'Blum ada Obat Yg Di pilih!',
                'warning'
            )
        } else {
            Swal.fire({
                title: 'Yakin Simpan?',
                text: "Transaksi Akan Tersimpan Didatabase!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!'
            }).then((result) => {
                if (result.value) {
                    // console.log($('form').serialize());
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('admin/saveFakturPembelian'); ?>",
                        data: $('form').serialize() + "&totaltrx=" + $('#totalTagihan').text(),
                        dataType: "JSON",
                        success: function(data) {
                            if (data.success) {
                                $("#suplier").val('').trigger('change');
                                $('#addList tr').remove();
                                $('#jml_harga').val('0');
                                $('#totalTagihan').text('0');
                                $('#NomorFaktur').val('');
                                $('form').each(function() {
                                    this.reset();
                                });
                                Swal.fire(
                                    'Success',
                                    `${data.data} ${data.msg}`,
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Warning',
                                    `${data.data} ${data.msg}`,
                                    'warning'
                                )
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            Swal.fire(
                                'Error!',
                                'Report Server',
                                'error'
                            )
                        }
                    });
                }
            });
        }
    });

    function cetakArrSubmit(params) {
        let arrCetak = [];
        $(`input[name='${params}[]']`).each(function() {
            arrCetak.push(this.value);
        });
        return arrCetak;
    }
</script>

<!-- untuk suplier -->
<script>
    $(document).ready(function() {
        callSupplier();

        function callSupplier() {
            $.ajax({
                type: "GET",
                url: "<?= base_url('admin/getSupplier'); ?>",
                dataType: "JSON",
                async: false,
                success: function(res) {
                    for (let i = 0; i < res.length; i++) {
                        $('#suplier').append(`
                     <option value="${res[i].id_suplier}">${res[i].nama_supplier}</option>
                     `)
                    }
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
        }
    });

    $("#formSubmitSuplier").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/saveSupplier'); ?>",
            data: $('form').serialize(),
            dataType: "JSON",
            success: function(res) {
                $('#formSubmitSuplier').each(function() {
                    this.reset();
                });
                Swal.fire(
                        'Success',
                        'Data Tersimpan',
                        'success'
                    )
                    .then(() => {
                        location.reload();
                    });
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
<!-- form tambah obat -->
<script>
    $("#formSubmitAddObat").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/saveObat'); ?>",
            data: $('form').serialize(),
            dataType: "JSON",
            success: function(res) {
                console.log(res);
                $('#formSubmitAddObat').each(function() {
                    this.reset();
                });
                Swal.fire(
                    'Success',
                    'Data Tersimpan',
                    'success'
                )
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