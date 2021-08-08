<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('ObatModel', 'dataObat');
		$this->load->model('TrxPenjualanModel', 'trxPenjualan');
		$this->load->model('SupplierModel');
		$this->load->model('FakturPembelianModel');
		// $this->load->model('UserModel');
		date_default_timezone_set('Asia/Ujung_Pandang');
	}
	public function index()
	{
		$data['jml_expired'] = $this->dataObat->get_obat_expired()->num_rows();
		$data['title'] = 'Data Master Obat';
		$this->load->view('admin/dashboard/index', $data);
	}
	public function get_obat_exp()
	{
		$data = $this->dataObat->get_obat_expired()->result();
		echo json_encode($data);
	}
	// real time saldo
	public function real_time_saldo()
	{
		$data = $this->trxPenjualan->sum_total_trx_hari_ini(date("Y-m-d"))->row();
		$data_saldo = empty($data->total_pertgl) ? $data_saldo = '0' : $data_saldo = $data->total_pertgl;
		echo json_encode($data_saldo);
	}
	public function real_time_trx()
	{
		$jml_trx = $this->trxPenjualan->data_transaksi(date("Y-m-d"));
		echo json_encode($jml_trx->num_rows());
	}
	public function real_time_stok()
	{
		$stok = $this->dataObat->stok_kosong();
		echo json_encode($stok->num_rows());
	}

	public function donat_chart()
	{
		$bulan = date('m');
		$data = $this->db->query("SELECT b.nama_obat, SUM(a.qty) as jml from detail_trx_penjualan a LEFT JOIN master_obat b on a.kd_obat = b.kd_obat
		LEFT JOIN transkasi_penjualan c ON c.kd_transaksi = a.kd_transaksi
	  WHERE month(c.waktu_trx) = '$bulan' GROUP by a.kd_obat ORDER by SUM(a.qty) desc limit 7")->result();
		$array_obat = array();
		foreach ($data as $value) {
			array_push($array_obat, ['obat' => $value->nama_obat, 'jml' => floatval($value->jml)]);
		}
		echo json_encode($array_obat);
	}
	public function bar_chart()
	{

		$data = $this->db->query("SELECT DATE(a.waktu_trx) as tgl, COUNT(a.kd_transaksi) as jml, SUM(total_trx) as saldo from transkasi_penjualan a GROUP BY DATE(a.waktu_trx)")->result();
		$array_trx = array();
		foreach ($data as $value) {
			// array_push($array_trx, ['trx' => $value->nama_trx, 'jml' => floatval($value->jml)]);
			array_push($array_trx, [
				'Date' => $value->tgl,
				'Open' => floatval($value->jml),
				'High' => floatval($value->jml),
				'Low' => floatval($value->jml),
				'Close' => floatval($value->jml),
				'Volume' => floatval($value->saldo),
				'Adj Close' => floatval($value->jml)
			]);
		}
		echo json_encode($array_trx);
	}
	public function tes()
	{
		$data['title'] = 'Data Master Obat';
		$this->load->view('tes', $data);
	}
	//--------------------------------------------------------------------

}
