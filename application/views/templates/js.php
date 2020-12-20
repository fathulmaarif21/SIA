<!-- jQuery -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url(); ?>assets/js/sweetalert2@10.js"></script>
<!-- Bootstrap Switch -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>assets/dist/js/demo.js"></script>

<!-- sweetalert2 -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> -->


<script>
    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    function darkMode() {
        let dm = $('#dmode').is(':checked');
        dm ? $('body').addClass('dark-mode') : $('body').removeClass('dark-mode');
    }

    var table;

    function formatRupiah(angka, prefix) {
        let number_string = angka.toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix != undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    };


    function remove_str(str) {
        // var str = st.toString();
        var res = str.replace(/Rp.|\.| /g, "");
        return parseInt(res)
    }

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }
</script>

</body>

</html>