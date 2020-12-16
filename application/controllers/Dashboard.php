<?php

namespace App\Controllers;

use App\Models\ObatModel;
use App\Models\SupplierModel;
use App\Models\TrxPenjualanModel;
use App\Models\FakturPembelianModel;
use App\Models\UserModel;
use Config\Services;

class Dashboard extends BaseController
{
	protected $dataObat;
	protected $supplierModel;
	protected $FakturPembelianModel;
	protected $UserModel;
	public function __construct()
	{
		$this->dataObat = new ObatModel(Services::request());
		$this->trxPenjualan = new TrxPenjualanModel(Services::request());
		$this->supplierModel = new SupplierModel(Services::request());
		$this->FakturPembelianModel = new FakturPembelianModel(Services::request());
		$this->UserModel = new UserModel();
		date_default_timezone_set('Asia/Ujung_Pandang');
	}
	public function index()
	{
		$data['jml_expired'] = count($this->dataObat->get_obat_expired()->getResultArray());
		$data['title'] = 'Data Master Obat';
		return view('admin/dashboard/index', $data);
	}
	public function get_obat_exp()
	{
		$data = $this->dataObat->get_obat_expired()->getResult();
		echo json_encode($data);
	}
	// real time saldo
	public function real_time_saldo()
	{
		$data = $this->trxPenjualan->sum_total_trx_hari_ini(date("Y-m-d"))->getRow();
		$data_saldo = empty($data->total_pertgl) ? $data_saldo = '0' : $data_saldo = $data->total_pertgl;
		echo json_encode($data_saldo);
	}
	public function real_time_trx()
	{
		$jml_trx = $this->trxPenjualan->data_transaksi(date("Y-m-d"))->getResultArray();
		echo json_encode(count($jml_trx));
	}
	public function real_time_stok()
	{
		$stok = $this->dataObat->stok_kosong()->getResultArray();
		echo json_encode(count($stok));
	}

	//--------------------------------------------------------------------

}
