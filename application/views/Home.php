<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Top Navigation</title>
    <link rel="shortcut icon" type="" href="<?= base_url('assets/'); ?>dist/img/logoSIA.png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/fonts/font.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
    <style>
        .list-link {
            padding: 0;
        }

        .link {
            display: inline-block;
            list-style-type: none;
            margin: 0 20px;
        }

        .link:nth-child(1) a {
            background: #2d6a4f;
        }

        .link:nth-child(2) a {
            background: #40916c;
        }

        /* .link:nth-child(2) a {
            background: #FF1654;
        } */

        .link:nth-child(3) a {
            background: #52b788;
        }

        .link:nth-child(4) a {
            background: #74c69d;
        }

        .btn_link {
            position: relative;
            background: rebeccapurple;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 5px solid white;
            color: white;
            font-family: Verdana;
            font-weight: bold;
            font-size: 50px;
            cursor: pointer;
            padding: 0;
            vertical-align: middle;
            text-align: center;
            left: 10%;
            display: table-cell;
        }

        .list-link:hover .link {
            filter: blur(3px);
            opacity: .5;
            transform: scale(.98);
            box-shadow: none;
        }

        .list-link:hover .link:hover {
            transform: scale(1);
            filter: blur(0px);
            opacity: 1;
            /* box-shadow: 0 8px 20px 0px rgba(0, 0, 0, 0.125); */
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="" class="navbar-brand">
                    <img src="<?= base_url(); ?>assets/dist/img/logoSIA.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Apotek Ajwa</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class=" nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>

                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown ">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('Login/logout'); ?>" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>

                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row ">
                        <div class="col mt-5 text-center">
                            <ul class="list-link">
                                <li class="link">
                                    <a href="<?= base_url('kasir'); ?>" data-toggle="tooltip" data-placement="top" title="Kasir" class="btn btn_link"><i class=" fas fa-cash-register fa-lg"></i></a>
                                </li>
                                <li class="link">
                                    <a href="<?= base_url('user/dataObat'); ?>" class="btn btn_link" data-toggle="tooltip" data-placement="top" title="Data Obat"><i class="fas fa-briefcase-medical fa-lg"></i></a>
                                </li>
                                <li class="link">
                                    <a href="<?= base_url('user/trxPenjualan'); ?>" class="btn btn_link" data-toggle="tooltip" data-placement="top" title="Transakasi Penjualan Hari Ini"><i class="fas fa-exchange-alt fa-lg"></i></a>
                                </li>
                                <li class="link">
                                    <a href="<?= base_url('Dashboard'); ?>" class="btn btn_link" data-toggle="tooltip" data-placement="top" title="Dashboard"><i class="fas fa-tachometer-alt fa-lg"></i></a>
                                </li>
                                <div class="mt-3">
                                    <li class="link">
                                        <a style="background: #2b9348;" href="<?= base_url('admin/viewFaktuPembelian'); ?>" data-toggle="tooltip" data-placement="top" title="Faktur Pembelian" class="btn btn_link"><i class=" fas fa-file-invoice fa-lg"></i></a>
                                    </li>
                                    <li class="link">
                                        <a style="background: #55a630;" href="<?= base_url('admin/viewUserManagement'); ?>" class="btn btn_link" data-toggle="tooltip" data-placement="top" title="User Management"><i class="fas fa-users-cog fa-lg"></i></a>
                                    </li>
                                    <li class="link">
                                        <a style="background: #80b918;" href="<?= base_url('admin/viewMasterObat'); ?>" class="btn btn_link" data-toggle="tooltip" data-placement="top" title="Master Obat"><i class="fas fa-briefcase-medical fa-lg"></i>
                                            <p style="font-size: 19px;">Master</p>
                                        </a>
                                    </li>
                                    <li class="link">
                                        <a style="background: #aacc00;" href="<?= base_url('admin/viewMasterTrxPenjualan'); ?>" class="btn btn_link" data-toggle="tooltip" data-placement="top" title="Master Transaksi Penjualan"><i class="fas fa-exchange-alt fa-lg"></i>
                                            <p style="font-size: 19px;">Master</p>
                                        </a>
                                    </li>
                                    <li class="link">
                                        <a style="background: #aacc00;" href="<?= base_url('admin/masterFaktuPembelian'); ?>" class="btn btn_link" data-toggle="tooltip" data-placement="top" title="Master Faktur Pembelian"><i class="fas fa-file-invoice fa-lg"></i>
                                            <p style="font-size: 19px;">Master</p>
                                        </a>
                                    </li>
                                    <li class="link">
                                        <a style="background: #aacc00;" href="<?= base_url('admin/viewMasterSupplier'); ?>" class="btn btn_link" data-toggle="tooltip" data-placement="top" title="Master Supplier"><i class="fas fa-user-tie fa-lg"></i>
                                            <p style="font-size: 19px;">Master</p>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
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
            <strong>Copyright &copy; <?= date('Y'); ?> <a href="#">Apotek Najwa</a>.</strong>
        </footer>
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
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        class HoverButton {
            constructor(el) {
                this.el = el;
                this.hover = false;
                this.calculatePosition();
                this.attachEventsListener();
            }

            attachEventsListener() {
                window.addEventListener('mousemove', e => this.onMouseMove(e));
                window.addEventListener('resize', e => this.calculatePosition(e));
            }

            calculatePosition() {
                gsap.set(this.el, {
                    x: 0,
                    y: 0,
                    scale: 1
                });
                const box = this.el.getBoundingClientRect();
                this.x = box.left + (box.width * 0.5);
                this.y = box.top + (box.height * 0.5);
                this.width = box.width;
                this.height = box.height;
            }

            onMouseMove(e) {
                let hover = false;
                let hoverArea = (this.hover ? 0.7 : 0.5);
                let x = e.clientX - this.x;
                let y = e.clientY - this.y;
                let distance = Math.sqrt(x * x + y * y);
                if (distance < (this.width * hoverArea)) {
                    hover = true;
                    if (!this.hover) {
                        this.hover = true;
                    }
                    this.onHover(e.clientX, e.clientY);
                }

                if (!hover && this.hover) {
                    this.onLeave();
                    this.hover = false;
                }
            }

            onHover(x, y) {
                gsap.to(this.el, {
                    x: (x - this.x) * 0.4,
                    y: (y - this.y) * 0.4,
                    scale: 1.15,
                    ease: 'power2.out',
                    duration: 0.4
                });
                this.el.style.zIndex = 10;
            }
            onLeave() {
                gsap.to(this.el, {
                    x: 0,
                    y: 0,
                    scale: 1,
                    ease: 'elastic.out(1.2, 0.4)',
                    duration: 0.7
                });
                this.el.style.zIndex = 1;
            }
        }
    </script>
</body>

</html>