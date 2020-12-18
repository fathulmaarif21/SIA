<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/datatables/datatables.min.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet"> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/fonts/font.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/mycss.css">
    <style>
        /* body {
            font-family: 'Open Sans', sans-serif;
        } */

        #chartdiv {
            width: 100%;
            height: 300px;
        }

        #chartSaldo {
            width: 100%;
            height: 500px;
            max-width: 100%;
        }

        #controls {
            overflow: hidden;
            padding-bottom: 3px;
        }

        .nav-link {
            color: #343a40;
        }

        .nav-pills .nav-link:not(.active):hover {
            color: #343a40;
        }
    </style>
</head>

<body class="sidebar-mini accent-success" style="height: auto;">
    <!-- Site wrapper -->
    <div class="wrapper">