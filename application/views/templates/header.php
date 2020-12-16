<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>
    <!-- select2 -->
    <link href="<?= base_url(); ?>/assets/vendor/select2/css/select2.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/select2/css/select2-bootstrap4.css">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/assets/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.min.css">
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
    </style>

</head>

<body id="page-top">