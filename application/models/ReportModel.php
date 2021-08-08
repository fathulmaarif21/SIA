<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReportModel extends CI_Model
{
    public function periodeBulanan($bulan, $tahun)
    {

        // ini yg fix blum di ganti

        $MY = $bulan . $tahun;
        return  $this->db->query("SELECT sum(penambahan) as penambahan,SUM(pengurangan) as pengurangan, kd_obat,nama_obat
        from (
        SELECT a.kd_obat,c.nama_obat,a.qty AS penambahan, 0 as pengurangan FROM detail_pembelian a LEFT JOIN faktur_pembelian b on a.no_faktur = b.no_faktur LEFT JOIN master_obat c on c.kd_obat=a.kd_obat  where DATE_FORMAT(b.tgl_beli, '%m%Y') ='$MY'
        UNION
        SELECT z.kd_obat,x.nama_obat,0 AS penambahan, z.qty as pengurangan FROM  detail_trx_penjualan z LEFT JOIN transkasi_penjualan y on z.kd_transaksi = y.kd_transaksi LEFT JOIN master_obat x on x.kd_obat=z.kd_obat 
          LEFT JOIN detail_pembelian w on w.kd_obat = x.kd_obat
          where DATE_FORMAT(y.waktu_trx, '%m%Y') ='$MY'
        ) t
        GROUP BY kd_obat,nama_obat");
    }
    public function saldoawal($MY, $kd_obat, $harga)
    {
        // $MY = $bulan . $tahun;
        return  $this->db->query("SELECT sum(penambahan) as penambahan,SUM(pengurangan) as pengurangan, kd_obat,nama_obat,harga
        from (
        SELECT a.kd_obat,c.nama_obat,a.harga_beli as harga,a.qty AS penambahan, 0 as pengurangan FROM detail_pembelian a LEFT JOIN faktur_pembelian b on a.no_faktur = b.no_faktur LEFT JOIN master_obat c on c.kd_obat=a.kd_obat  where DATE_FORMAT(b.tgl_beli, '%m%Y') ='$MY'
        UNION
        SELECT z.kd_obat,x.nama_obat,x.harga_jual as harga,0 AS penambahan, z.qty as pengurangan FROM  detail_trx_penjualan z LEFT JOIN transkasi_penjualan y on z.kd_transaksi = y.kd_transaksi LEFT JOIN master_obat x on x.kd_obat=z.kd_obat 
          LEFT JOIN detail_pembelian w on w.kd_obat = x.kd_obat
          where DATE_FORMAT(y.waktu_trx, '%m%Y') ='$MY'
        ) t
        GROUP BY kd_obat,nama_obat,harga");
    }
    public function getHargaFaktur()
    {
        # code...
    }
}
