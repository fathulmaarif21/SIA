<script src="<?= base_url(); ?>/assets/vendor/datatables/datatables.min.js"></script>
<script>
    var month = '<?= date('m'); ?>';
    var t_report = $('#laporan_bulanan').DataTable();
    // var t_report = '';
    $(document).ready(function() {
        $("#lap_bulan").val(month).trigger('change');

        $("#form_laporan").submit(function(e) {
            e.preventDefault();
            t_report.destroy();

            t_report = $('#laporan_bulanan').DataTable({
                "processing": true,
                "ajax": {
                    "url": '<?= base_url('report/getLaporanBulanan'); ?>',
                    "type": "POST",
                    "data": {
                        "bulan": $('#lap_bulan').val(),
                        "tahun": $('#lap_tahun').val(),
                    }
                }
            });
        });
    });
</script>