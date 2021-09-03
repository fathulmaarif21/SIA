<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Ujung_Pandang');
    }

    // Export ke excel
    public function exportObat()
    {
        $fileName = 'Master Obat';

        $this->load->model('ObatModel', 'dataObat');
        $data = $this->dataObat->getAllObat()->result_array();

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();


        // Add some data
        $spreadsheet->setActiveSheetIndex(0);

        if (!empty($data)) {
            $noObat = 1;
            $abjad = range('A', 'Z');
            $i = 2;
            $bol_header = true;
            $i2 = 0;
            $spreadsheet->getActiveSheet()->SetCellValue('A1',  'No.');
            foreach ($data as $key => $val) {
                $detailObat =  $this->dataObat->getNofaktur($val['kd_obat'])->result();
                foreach (array_keys($val) as $k => $key) {
                    $k++;
                    if ($bol_header === true) {
                        $spreadsheet->getActiveSheet()->SetCellValue($abjad[$k]  . '1',  strtoupper($key));
                    }
                    // untuk nomor
                    $spreadsheet->getActiveSheet()->SetCellValue('A' . $i,  $noObat);
                    // datanya
                    $spreadsheet->getActiveSheet()->SetCellValue($abjad[$k]  . $i,  $val[$key]);
                    $i2 = $k;
                }
                $i2++;
                // heder detail
                if ($bol_header === true) {
                    $spreadsheet->getActiveSheet()->SetCellValue($abjad[$i2]  . '1',  'NO_FAKTUR');
                    $spreadsheet->getActiveSheet()->SetCellValue($abjad[$i2 + 1]  . '1',  'TGL_EXP');
                }
                if (!empty($detailObat)) {
                    foreach ($detailObat as $value) {
                        $spreadsheet->getActiveSheet()->SetCellValue($abjad[$i2] . $i, $value->no_faktur);
                        $spreadsheet->getActiveSheet()->SetCellValue($abjad[$i2 + 1] . $i, $value->tgl_expired);
                        $i++;
                    }
                } else {
                    $i++;
                }

                $bol_header = false;
                $noObat++;
            }
            for ($col = 'A'; $col !== $abjad[$i2 + 2]; $col++) {
                $spreadsheet->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
            }
        }

        // Rename worksheet
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');    // download file 
        exit;
    }
    public function exporTrx()
    {
        $tgl_start = $this->input->post('tgl_start');
        $tgl_end = $this->input->post('tgl_end');

        if ($tgl_start == '' || $tgl_end == '') {
            exit;
            die;
        }
        $tgl_start = date('Y-m-d', strtotime(str_replace('/', '-', $tgl_start)));
        $tgl_end = date('Y-m-d', strtotime(str_replace('/', '-', $tgl_end)));
        $fileName = 'Transaksi Penjualan_' . $tgl_start . ' - ' . $tgl_end;
        $this->load->model('TrxPenjualanModel');
        $data = $this->TrxPenjualanModel->getTrxBetDate($tgl_start, $tgl_end)->result();
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        // Add some data
        $spreadsheet->setActiveSheetIndex(0);

        if (!empty($data)) {
            $no = 1;
            $i = 2;
            $spreadsheet->getActiveSheet()->SetCellValue('A1', 'No.');
            $spreadsheet->getActiveSheet()->SetCellValue('B1', 'kd_transaksi');
            $spreadsheet->getActiveSheet()->SetCellValue('C1', 'nama_pembeli');
            $spreadsheet->getActiveSheet()->SetCellValue('D1', 'alamat_pembeli');
            $spreadsheet->getActiveSheet()->SetCellValue('E1', 'note');
            $spreadsheet->getActiveSheet()->SetCellValue('F1', 'total_trx');
            $spreadsheet->getActiveSheet()->SetCellValue('G1', 'total_bayar');
            $spreadsheet->getActiveSheet()->SetCellValue('H1', 'kembalian');
            $spreadsheet->getActiveSheet()->SetCellValue('I1', 'waktu_trx');
            $spreadsheet->getActiveSheet()->SetCellValue('J1', 'list_obat_terjual');
            $spreadsheet->getActiveSheet()->SetCellValue('K1', 'qty');
            $spreadsheet->getActiveSheet()->SetCellValue('L1', 'sub_total');

            $tmp_kdtrx = $fileName;
            foreach ($data as  $val) {
                $detail = $this->TrxPenjualanModel->getDetailTrxPenjualanByID($val->kd_transaksi)->result();
                foreach ($detail as  $value) {

                    if ($val->kd_transaksi != $tmp_kdtrx) {
                        $spreadsheet->getActiveSheet()->SetCellValue('A' . $i, $no);
                        $spreadsheet->getActiveSheet()->SetCellValue('B' . $i, $val->kd_transaksi);
                        $spreadsheet->getActiveSheet()->SetCellValue('C' . $i, $val->nama_pembeli);
                        $spreadsheet->getActiveSheet()->SetCellValue('D' . $i, $val->alamat_pembeli);
                        $spreadsheet->getActiveSheet()->SetCellValue('E' . $i, $val->note);
                        $spreadsheet->getActiveSheet()->SetCellValue('F' . $i, $val->total_trx);
                        $spreadsheet->getActiveSheet()->SetCellValue('G' . $i, $val->total_bayar);
                        $spreadsheet->getActiveSheet()->SetCellValue('H' . $i, $val->kembalian);
                        $spreadsheet->getActiveSheet()->SetCellValue('I' . $i, $val->waktu_trx);
                        $no++;
                    }

                    $spreadsheet->getActiveSheet()->SetCellValue('J' . $i, $value->nama_obat);
                    $spreadsheet->getActiveSheet()->SetCellValue('K' . $i, $value->qty);
                    $spreadsheet->getActiveSheet()->SetCellValue('L' . $i, $value->sub_total);

                    $tmp_kdtrx = $val->kd_transaksi;
                    $i++;
                }
                // $spreadsheet->getActiveSheet()->SetCellValue('I1' . $i, $val->no_faktur);
            }
            for ($col = 'A'; $col !== 'L'; $col++) {
                $spreadsheet->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
            }
        }

        // die;

        // Rename worksheet
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');    // download file 
        exit;
    }
    public function exporFaktur()
    {
        $tgl_start = $this->input->post('tgl_start');
        $tgl_end = $this->input->post('tgl_end');
        // $tgl_start = '2000-01-01';
        // $tgl_end = '2012-09-01';

        if ($tgl_start == '' || $tgl_end == '') {
            exit;
            die;
        }
        $tgl_start = date('Y-m-d', strtotime(str_replace('/', '-', $tgl_start)));
        $tgl_end = date('Y-m-d', strtotime(str_replace('/', '-', $tgl_end)));
        $fileName = 'Faktur Pembelian_' . $tgl_start . ' - ' . $tgl_end;
        $this->load->model('FakturPembelianModel');
        $data = $this->FakturPembelianModel->getFakturBetDate($tgl_start, $tgl_end)->result();
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        // Add some data
        $spreadsheet->setActiveSheetIndex(0);

        if (!empty($data)) {
            $no = 1;
            $i = 2;
            $spreadsheet->getActiveSheet()->SetCellValue('A1', 'No.');
            $spreadsheet->getActiveSheet()->SetCellValue('B1', 'no_faktur');
            $spreadsheet->getActiveSheet()->SetCellValue('C1', 'nama_supplier');
            $spreadsheet->getActiveSheet()->SetCellValue('D1', 'tgl_faktur');
            $spreadsheet->getActiveSheet()->SetCellValue('E1', 'jt_tempo');
            $spreadsheet->getActiveSheet()->SetCellValue('F1', 'jml_harga');
            $spreadsheet->getActiveSheet()->SetCellValue('G1', 'ppn_persen');
            $spreadsheet->getActiveSheet()->SetCellValue('H1', 'ppn_rupiah');
            $spreadsheet->getActiveSheet()->SetCellValue('I1', 'total_trx');
            $spreadsheet->getActiveSheet()->SetCellValue('J1', 'waktu_input');

            $spreadsheet->getActiveSheet()->SetCellValue('K1', 'nama_obat');
            $spreadsheet->getActiveSheet()->SetCellValue('L1', 'no_batch');
            $spreadsheet->getActiveSheet()->SetCellValue('M1', 'harga_beli');
            $spreadsheet->getActiveSheet()->SetCellValue('N1', 'qty');
            $spreadsheet->getActiveSheet()->SetCellValue('O1', 'sub_total');
            $spreadsheet->getActiveSheet()->SetCellValue('P1', 'tgl_expired');

            $tmp_kdtrx = $fileName;
            foreach ($data as  $val) {
                $detail = $this->FakturPembelianModel->getDetailFaktur($val->no_faktur)->result();
                foreach ($detail as  $value) {

                    if ($val->no_faktur != $tmp_kdtrx) {
                        $spreadsheet->getActiveSheet()->SetCellValue('A' . $i, $no);
                        $spreadsheet->getActiveSheet()->SetCellValue('B' . $i, $val->no_faktur);
                        $spreadsheet->getActiveSheet()->SetCellValue('C' . $i, $val->nama_supplier);
                        $spreadsheet->getActiveSheet()->SetCellValue('D' . $i, $val->tgl_beli);
                        $spreadsheet->getActiveSheet()->SetCellValue('E' . $i, $val->jt_tempo);
                        $spreadsheet->getActiveSheet()->SetCellValue('F' . $i, $val->jml_harga);
                        $spreadsheet->getActiveSheet()->SetCellValue('G' . $i, $val->ppn_persen);
                        $spreadsheet->getActiveSheet()->SetCellValue('H' . $i, $val->ppn);
                        $spreadsheet->getActiveSheet()->SetCellValue('I' . $i, $val->total_trx);
                        $spreadsheet->getActiveSheet()->SetCellValue('J' . $i, $val->waktu_input);
                        $no++;
                    }

                    $spreadsheet->getActiveSheet()->SetCellValue('K' . $i, $value->nama_obat);
                    $spreadsheet->getActiveSheet()->SetCellValue('L' . $i, $value->no_batch);
                    $spreadsheet->getActiveSheet()->SetCellValue('M' . $i, $value->harga_beli);
                    $spreadsheet->getActiveSheet()->SetCellValue('N' . $i, $value->qty);
                    $spreadsheet->getActiveSheet()->SetCellValue('O' . $i, $value->sub_total);
                    $spreadsheet->getActiveSheet()->SetCellValue('P' . $i, $value->tgl_expired);

                    $tmp_kdtrx = $val->no_faktur;
                    $i++;
                }
                // $spreadsheet->getActiveSheet()->SetCellValue('I1' . $i, $val->no_faktur);
            }
            for ($col = 'A'; $col !== 'Q'; $col++) {
                $spreadsheet->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
            }
        }

        // die;

        // Rename worksheet
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');    // download file 
        exit;
    }
}
