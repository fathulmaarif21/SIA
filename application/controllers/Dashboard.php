<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
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

	//--------------------------------------------------------------------

}
