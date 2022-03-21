<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="shortcut icon" type="" href="<?= base_url('assets/'); ?>dist/img/logoSIA.png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/fonts/font.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
    <style>

    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="" class="navbar-brand">
                    <img src="<?= base_url(); ?>assets/dist/img/logoSIA.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Monitoring Pelaporan Antasena</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>



            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <form id="form_get" class="form-inline mt-3">
                        <!-- <label class="sr-only" for="inlineFormInputName2">ID PELAPOR</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe"> -->
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="sr-only" for="inlineFormCustomSelectPref">ID PELAPOR</label>
                            <select class="custom-select my-1 mr-sm-2" name="idPelapor" id="idPelapor" required>
                                <option value="135000000">135000000</option>
                                <option value="135001000">135001000</option>
                                <option value="135002000">135002000</option>
                                <option value="135003000">135003000</option>
                                <option value="135004000">135004000</option>
                                <option value="135005000">135005000</option>
                                <option value="135006000">135006000</option>
                                <option value="135008000">135008000</option>
                                <option value="135009000">135009000</option>
                                <option value="135010000">135010000</option>
                                <option value="135011000">135011000</option>
                                <option value="135012000">135012000</option>
                                <option value="135013000">135013000</option>
                                <option value="135014000">135014000</option>
                            </select>
                        </div>
                        <label class="sr-only" for="inlineFormInputName2">ID PELAPOR</label>
                        <input type="date" class="form-control mb-2 mr-sm-2" name="periodeData" id="periodeData" required>

                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </form>
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 id="Jumlah_kirim"></h3>

                                    <p>Saldo</p>
                                </div>
                                <div class="icon">
                                    <i class="far fa-money-bill-alt"></i>
                                </div>
                                <a href="<?= base_url('user'); ?>/trxPenjualan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 id="r_trx"></h3>

                                    <p>Jumlah Transaksi</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <a href="<?= base_url('user'); ?>/trxPenjualan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 id="r_stok"></h3>

                                    <p>Stok Obat Kosong</p>
                                </div>
                                <div class="icon">
                                    <i class="far fa-meh-blank"></i>
                                </div>
                                <a href="<?= base_url('user'); ?>/dataObat" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>40</h3>

                                    <p>Total Obat Expired</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-skull-crossbones"></i>
                                </div>
                                <a href="#" onclick="get_data_expired()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-auto">

                        </div>
                        <!-- ./col -->
                    </div>
                    <div class="table-responsive-sm ">
                        <table id="tabel_data" class="table table-responsive table-bordered table-sm">
                            <thead>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; <?= date('Y'); ?> <a href="#">Monitoring Pelaporan Antasena</a>.</strong>
        </footer>
    </div>

    <!-- modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

    <!-- Modal -->
    <div class="modal fade" id="rincianGagal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLongTitle">No Faktur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="table_detail" class="table table-striped table-bordered table-responsive-sm  table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No Faktur</th>
                                <th>Tanggl Exp Obat</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url(); ?>assets/dist/js/demo.js"></script>
    <!-- <script src="<?= base_url(); ?>assets/js/gsap.min.js"></script> -->
    <script>
        async function getdata(idpelapor, periodedata) {
            var cekHed = true,
                header, idInformasi = [],
                dataGagal = [],
                allData = [];
            // for (informasi of skema) {
            try {
                let getajax = await $.ajax({
                    url: '<?= base_url('Monitoring/getApi/'); ?>' + idpelapor + '/' + periodedata,
                    type: "GET",
                    dataType: 'json',
                    // data: {
                    //     idpelapor,
                    //     informasi
                    // },
                    success: function(response) {
                        return response
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {

                        return textStatus
                    }

                });

                // if (getajax['response']['code'] !== '00') {

                //     // break;
                // }
                // console.log(getajax)
                if (getajax.status == 'Success') {
                    if (getajax.results.length > 0) {
                        // create header
                        if (cekHed) {
                            header = Object.keys((getajax.results[0]));
                            header.unshift('Rincian');
                            let thead = '';
                            console.log(header);
                            for (const hd of header) {
                                thead += `<th>${hd}</th>`;
                            }
                            $('#tabel_data thead').html(`<tr>${thead}</tr>`);
                            cekHed = false;
                        }
                        header.shift(); //remove first header array
                        let addrow = '';
                        let tbody = '';
                        for (let i = 0; i < getajax.results.length; i++) {
                            const element = getajax.results[i];

                            // add di body
                            // addrow += `<td><a class="btn btn-sm btn-info" data-toggle="modal" data-target="#rincianGagal" href="javascript:void(0)" title="No_Faktur"
                            //  onclick="getRincian(this)"><i class="far fa-eye"></i> Detail</a></td>`;
                            // for (const row of header) {
                            //     addrow += `<td>${element[row]}</td>`;
                            // }
                            // tbody += `<tr>${addrow}</tr>`;
                            // addrow = '';


                            if (element['status_proses'] != 'Selesai') { //ambil data yang  gagal
                                dataGagal.push(element)
                            }

                            if (!idInformasi.includes(element['IdInformasi'])) { //untuk jumlah laporan yang di kirim
                                idInformasi.push(element['IdInformasi']); //get informasi
                            }
                        } //end loop

                        $('#tabel_data tbody').html(tbody);


                        // console.log(allInformasi);

                        // console.log(allInformasi.length);

                        // let IdInformasi = [...new Set(allInformasi)];
                        // console.log(allInformasi.length);


                        // for dashboar
                        document.getElementById('Jumlah_kirim').innerHTML = `${idInformasi.length} || 42`;
                        // document.getElementById('r_trx').innerHTML = realtrx();
                        // document.getElementById('r_stok').innerHTML = realstok();


                    } else {
                        console.log('data kosong');

                    }
                }

            } catch (error) {
                console.log(error)
            }
            // }
        }


        function getRincian(param) {
            console.log(param);

        }


        $("#form_get").submit(function(e) {
            e.preventDefault();
            let idpel = $('#idPelapor').val();
            let perDat = $('#periodeData').val();
            if (idpel == '' || perDat == '') {
                alert('lengkapi data');
            } else {
                getdata(idpel, perDat);
            }
        });
    </script>
</body>

</html>