<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" type="" href="<?= base_url('assets/'); ?>dist/img/logoSIA.png">
    <!-- select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/datatables/datatables.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css"> -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/fonts/font.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #printThis,
            #printThis * {
                visibility: visible;
            }

            #printThis {
                position: absolute;
                left: 0;
                top: 0;
            }
        }

        #rowNota tr {
            line-height: 14px;
        }

        .setImg {
            width: 200px;
            height: 200px;
        }

        .select2-search {
            background-color: #01ff70;
        }

        .select2-container--bootstrap4 .select2-results__option--highlighted,
        .select2-container--bootstrap4 .select2-results__option--highlighted.select2-results__option[aria-selected=true] {
            background-color: #01ff70;
            color: black;
        }

        .text-info {
            color: black !important;
        }

        .nav-link {
            color: #343a40;
        }

        .nav-pills .nav-link:not(.active):hover {
            color: #343a40;
        }
    </style>
</head>
<!-- control-sidebar-slide-open  untuk custome sidebar open -->

<body class="sidebar-mini accent-success" style="height: auto;">
    <!-- Site wrapper -->
    <div class="wrapper">