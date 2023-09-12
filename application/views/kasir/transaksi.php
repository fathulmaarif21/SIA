<div class="row">
    <div class="col-sm-7">
        <div class="card border-primary mb-2 border-left-primary shadow ">
            <div class="card-body text-info">
                <h5>Search <i class="fas fa-search"></i></h5>
                <div class="input-group mb-3">
                    <select class="" id="id_select_obat">
                        <option selected>Ketik Nama Obat Atau kd Obat</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <!-- <div class="card text-white bg-info" style="max-width: 18rem;">
            <div class="card-header">Total</div>
            <div class="card-body">
                <h3>Rp. 0</h3>
            </div>
        </div> -->
        <div class="card  mb-2  shadow  mb-2 bg-success">
            <div class="card-body">
                <p class="card-text"><b>Total :</b></p>
                <h1 class="h2">Rp. <span id="totalTagihan">0</span></h1>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-9">
        <div class="card shadow text-center text-gray-800">
            <div class="card-body font-weight-bold">
                <div class="table-responsive-sm">
                    <table id="keranjangList" class="table table-responsive table-striped w-auto small" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Satuan</th>
                                <th scope="col" style="width: 25%;">Harga</th>
                                <th scope="col" style="width: 18%;">qty</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="addList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card  shadow">
            <div class="card-body">
                <form class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="totalBayar">Jumlah Bayar</label>
                        <input type="text" class="form-control form-control-lg" name="totalBayar" id="totalBayar" placeholder="Bayar" required>
                    </div>
                    <div class="form-group">
                        <label for="tampilan_kembalian">Kembalian</label>
                        <input type="text" class="form-control form-control-lg" name="tampilan_kembalian" id="tampilan_kembalian" placeholder="Rp. 0" readonly>
                        <input type="hidden" class="form-control" name="kembalian" id="kembalian" value="0" readonly>
                        <div class="invalid-feedback">
                            Uang Ta Kurang
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit <i class="fas fa-angle-double-right"></i></button>
                    <!-- <button type="button" onclick="showmodal()" class="btn btn-primary">print <i class="fas fa-angle-double-right"></i></button> -->
                </form>
            </div>
        </div>
    </div>
</div>

<div id="div_cetak" style="visibility: hidden;">

    <style>
        #ticket {
            font-size: 5px;
            font-family: 'Times New Roman';
        }

        /* #ticket table {
            border-top: 1px solid black;
            border-collapse: collapse;
        } */

        /* #ticket td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        #ticket td.quantity,
        th.quantity {
            max-width: 5px;
            word-break: break-all;
        }

        #ticket td.price,
        th.price {
            width: 25px;
            max-width: 25px;
            word-break: break-all;
        } */

        #ticket .centered {
            text-align: center;
            align-content: center;
        }

        #ticket .ticket {
            width: 155px;
            max-width: 155px;
        }

        #ticket img {
            /* max-width: inherit;
            width: inherit; */
            padding-left: 20px;
            width: 2%;

            /* background-size: 60px 60px; */
        }

        #ticket table {
            /* border-style: double none double none; */
            text-transform: uppercase;
            white-space: nowrap;
            font-weight: bold;
            border-collapse: collapse;
        }

        .center_logo {
            padding-left: 100px;
        }
    </style>
    <!-- 
                            <div id="legalcopy" class="tableitem">
                                <p class="legal"><strong>Log:</strong> <?= $this->session->userdata('nama'); ?>
                                    <br>
                                    <?= date("d-m-Y h:i:s"); ?>
                                </p>
                            </div> -->

    <div class="ticket" style="font-family: 'Times New Roman'; width: 300px;
            max-width: 300px;">
        <div class="center_logo">
            <img src="http://localhost/SIA/assets/dist/img/logoSIA.png" width="10%" alt="Logo">
        </div>
        <p style="padding-left:60px;">Apotek Kiya Medika</p>
        <div style="font-size: 13px;">
            <p>
                Address : Jl. Jend. Ahmad Yani, Pondambea</br>
                Phone : 0853-4269-7757</br>
            </p>
            <hr style="max-width: 220px; margin-left:0; border-top: 1px dashed">
            <p>
                Order ID : <span id="invoice_no_nota"></span> <br>
                Operator: <?= $this->session->userdata('nama'); ?> <br>
                Time : <?= date("d-m-Y h:i:s"); ?>
            </p>
            <hr style="max-width: 220px; margin-left:0; border-top: 1px dashed">
        </div>
        <div style="font-size: 10px;">
            <table style=" text-transform: uppercase; font-weight: bold; border-collapse: collapse; " width="100%" id="detaillist_nota">
                <tbody>
                    <tr>
                        <td colspan="3">nama obat sdsdsd</td>
                    </tr>
                    <tr>
                        <td>@ 1.000.000</td>
                        <td width="7%">1 x</td>
                        <td> 10.000.000</td>
                    </tr>
                    <tr>
                        <td colspan="3">nama obat sdsdsd</td>
                    </tr>
                    <tr>
                        <td>1 x</td>
                        <td> 1.000.000</td>
                        <td> 10.000.000</td>
                    </tr>
                    <tr>
                        <td colspan="3">nama obat sdsdsd</td>
                    </tr>
                    <tr>
                        <td>1 x</td>
                        <td> 1.000.000</td>
                        <td> 10.000.000</td>
                    </tr>
                    <tr>
                        <td colspan="3">nama obat sdsdsd</td>
                    </tr>
                    <tr>
                        <td>1 x</td>
                        <td> 1.000.000</td>
                        <td> 10.000.000</td>
                    </tr>
                    <!-- <tr>
                        <td>1.00</td>
                        <td>STICKER PACK</td>
                        <td class="price">$10.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>TOTAL</td>
                        <td>$55.00</td>
                    </tr> -->
                </tbody>
                <tfoot>
                    <tr>
                        <th align="right" colspan="2">Total :</th>
                        <td id="invoice_Total"></td>
                    </tr>
                    <tr>
                        <th align="right" colspan="2">Jumlah Bayar :</th>
                        <td id="invoice_bayar"></td>
                    </tr>
                    <tr>
                        <th align="right" colspan="2">Kembalian :</th>
                        <td id="invoice_kembali"></td>
                    </tr>
                </tfoot>
            </table>
            <hr style="max-width: 220px; margin-left:0; border-top: 1px dashed">
            <p class="centered">TERIMA KASIH
                <br>Semoga Sehat Selalu
            </p>
        </div>
    </div>

    <!--End Invoice-->

</div>


<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            ...
        </div>
    </div>
</div>

<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#success_tic">Open Modal</button> -->

<!-- Modal -->
<div id="success_tic" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-dialog-centered ">
        <!-- Modal content-->
        <div class="modal-content">
            <a class="close" href="#" data-dismiss="modal">&times;</a>
            <div class="page-body">
                <h1 style="text-align:center;">
                    <div class="checkmark-circle">
                        <div class="background"></div>
                        <div class="checkmark draw"></div>
                    </div>
                    <h1>
                        <div class="head">
                            <h4>Transaksi Berhasil!</h4>
                            <button type="button" onclick="klikbtnPrint()" id="btn_print" class="btn btn-success"><i class="fas fa-print"></i> Cetak Nota?</button>
                            <button type="button" onclick="klikbtnPrint_thermal()" class="btn btn-success"><i class="fas fa-print"></i> Print Thermal</button>
                        </div>
            </div>
        </div>
    </div>

</div>
<script>
    var logoprint = "<?= base_url('assets/'); ?>dist/img/logoSIA.png";
    console.log(logoprint)
</script>