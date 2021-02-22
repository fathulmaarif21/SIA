<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReportModel extends CI_Model
{
    public function periodeBulanan($bulan, $tahun)
    {
        $MY = $bulan . $tahun;
        return  $this->db->query("SELECT 
        a.kd_obat,a.nama_obat,a.harga_beli, SUM(a.PENAMBAHAN) as penambahan,SUM(a.PENGURANGAN) as pengurangan
        FROM laporan1 a LEFT JOIN faktur_pembelian b on a.no_faktur=b.no_faktur LEFT JOIN transkasi_penjualan c ON a.kd_transaksi = c.kd_transaksi where DATE_FORMAT(b.tgl_beli, '%m%Y')='$MY' OR DATE_FORMAT(c.waktu_trx, '%m%Y') ='$MY'
        GROUP BY a.kd_obat,a.nama_obat,a.harga_beli");
    }
}
