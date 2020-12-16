<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ObatModel');
        $this->load->model('TrxPenjualanModel');
        // $this->load->model('SupplierModel');
        $this->load->model('FakturPembelianModel');
        // $this->load->model('UserModel');
        date_default_timezone_set('Asia/Ujung_Pandang');
    }

    public function index()
    {
        // dd($this->ObatModel->findAll());
        $this->load->view('admin/dashboard/index');
    }

    // Master Obat
    public function viewMasterObat()
    {
        $data['title'] = 'Data Master Obat';
        $this->load->view('admin/masterObat/index', $data);
    }

    function getObatById($kdObat)
    {
        $data =  $this->ObatModel->obatById($kdObat);
        echo json_encode($data);
    }

    public function updateObat()
    {
        $kd_obat = $this->input->post('kd_obat');
        $nama_obat = $this->input->post('nama_obat');
        $harga_jual = $this->input->post('harga_jual');
        $stok = $this->input->post('stok');
        // $autokode = $this->ObatModel->autoKdObat();
        // echo 'O' . date('dm') . $autokode;
        $update = [
            "nama_obat" => $nama_obat,
            "harga_jual" => $harga_jual,
            "stok" => $stok
        ];
        $this->ObatModel->updateObat($kd_obat, $update);
        echo json_encode(array("status" => TRUE));
    }
    public function deleteObatById($id)
    {
        $this->ObatModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
    public function saveObat()
    {
        $autoKdObat = $this->ObatModel->autoKdObat();
        $ObatModel = [
            'kd_obat' => date('dm') . 'O' . $autoKdObat,
            'nama_obat' => $this->request->getVar('addNamaObat'),
            'harga_jual' => $this->request->getVar('addHargaJual'),
            'stok' => 0
        ];

        $this->ObatModel->addObat($ObatModel);
        $data = ['status' => true];
        echo json_encode($data);
    }
    // master obat
    public function getDatatableObat()
    {

        $lists =  $this->ObatModel->get_datatables();
        $data = [];
        $no = $this->input->post("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];
            $row[] = $list->kd_obat;
            $row[] = $list->nama_obat;
            $row[] = $list->harga_jual;
            $row[] = $list->stok;
            $row[] = $list->waktu_input;
            //add html for action
            $row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_obat(' . "'" . $list->kd_obat . "'" . ')"><i class="far fa-edit"></i> Edit</a>
                <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteObat(' . "'" . $list->kd_obat . "'" . ')"><i class="far fa-trash-alt"></i> Delete</a>';

            $data[] = $row;
        }
        $output = [
            "draw" => $this->input->post('draw'),
            "recordsTotal" =>  $this->ObatModel->count_all(),
            "recordsFiltered" =>  $this->ObatModel->count_filtered(),
            "data" => $data
        ];
        echo json_encode($output);
    }
    // end of master obat
    //--------------------------------------------------------------------
    // master trx penjualan
    public function viewMasterTrxPenjualan()
    {
        $data['title'] = 'Master Trx Penjualan';
        $this->load->view('admin/masterTrxPenjualan/index', $data);
    }
    public function masterTrxPenjualanModel()
    {
        $lists =  $this->TrxPenjualanModel->get_datatables();
        $data = [];
        $no = $this->input->post("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];
            $row[] = $list->kd_transaksi;
            $row[] = $list->nama_pembeli;
            $row[] = $list->alamat_pembeli;
            $row[] = $list->note;
            $row[] = $list->total_trx;
            $row[] = $list->total_bayar;
            $row[] = $list->kembalian;
            $row[] = $list->waktu_trx;
            //add html for action
            // onclick="detail_trx(' . "'" . $value->kd_transaksi . "'" . ')"
            $row[] = '
            <a class="btn btn-sm btn-info" href="javascript:void(0)" onclick="detail_trx(' . "'" . $list->kd_transaksi . "'" . ')" title="detail" ><i class="fas fa-info"></i> Detail</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="deleteTrx(' . "'" . $list->kd_transaksi . "'" . ')" title="Delete" ><i class="fas fa-trash"></i> Delete</a>
            ';
            $data[] = $row;
        }
        $output = [
            "draw" => $this->input->post('draw'),
            "recordsTotal" =>  $this->TrxPenjualanModel->count_all(),
            "recordsFiltered" =>  $this->TrxPenjualanModel->count_filtered(),
            "data" => $data
        ];
        echo json_encode($output);
        // getTrxPenjualanModelByTime
    }
    public function deleteTrxPenjualanModel($kd_transaksi)
    {
        $this->TrxPenjualanModel->delete_by_id($kd_transaksi);
        echo json_encode(array("status" => TRUE));
    }

    // faktur pembelian
    public function viewFaktuPembelian()
    {
        $data['title'] = 'Transaksi Faktur Pembelian';
        $this->load->view('admin/fakturPembelian/index', $data);
    }
    public function masterFaktuPembelian()
    {
        $data['title'] = 'Master Faktur Pembelian';
        $this->load->view('admin/masterFakturPembelian/index', $data);
    }
    public function detailFakturPembelian($kdFaktur)
    {
        $data = $this->FakturPembelianModel->getDetailFaktur($kdFaktur)->result();
        echo json_encode($data);
    }
    public function deleteFakturPembelian($id)
    {
        $this->FakturPembelianModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
    public function deleteDetailFaktur($id)
    {
        $this->FakturPembelianModel->deleteDtlFakturPembelian($id);
        echo json_encode(array("status" => TRUE));
    }
    // dattable faktur
    public function dtFaktuPembelian()
    {
        $lists =  $this->FakturPembelianModel->get_datatables();
        $data = [];
        $no = $this->input->post("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];
            $row[] = $list->no_faktur;
            $row[] = $list->id_suplier;
            $row[] = $list->total_trx;
            $row[] = $list->tgl_beli;
            $row[] = $list->waktu_input;
            //add html for action
            // onclick="detail_trx(' . "'" . $value->no_faktur . "'" . ')"
            $row[] = '
            <a class="btn btn-sm btn-info" href="javascript:void(0)" onclick="detail_trx(' . "'" . $list->no_faktur . "'" . ')" title="detail" ><i class="fas fa-info"></i> Detail</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="deleteTrx(' . "'" . $list->no_faktur . "'" . ')" title="Delete" ><i class="fas fa-trash"></i> Delete</a>
            ';
            $data[] = $row;
        }
        $output = [
            "draw" => $this->input->post('draw'),
            "recordsTotal" =>  $this->FakturPembelianModel->count_all(),
            "recordsFiltered" =>  $this->FakturPembelianModel->count_filtered(),
            "data" => $data
        ];
        echo json_encode($output);
        // getTrxPenjualanModelByTime
    }
    public function saveFakturPembelian()
    {
        $noFaktur = $this->input->post('NomorFaktur');
        $suplier = $this->input->post('suplier');
        $tglFaktur = $this->input->post('tglFaktur');
        $totaltrx = str_replace(".", "", $this->input->post('totaltrx'));
        $arr_kd_obat = $this->input->post('kd_obat');
        $arr_qty = $this->input->post('qty');
        $arr_harga_beli = $this->input->post('harga_beli');
        $arr_sub_total = str_replace(".", "", $this->input->post('subTotal'));
        $arr_tglExp = $this->input->post('tglExp');
        $dataFaktur = [
            "no_faktur" => $noFaktur,
            "id_suplier " => $suplier,
            "total_trx" => $totaltrx,
            "tgl_beli" => $tglFaktur,
        ];
        $detailTrx = [];
        for ($i = 0; $i < count($arr_kd_obat); $i++) {
            $detail = [
                "no_faktur" => $noFaktur,
                "kd_obat" => $arr_kd_obat[$i],
                "qty" => $arr_qty[$i],
                "harga_beli" => $arr_harga_beli[$i],
                "sub_total" => $arr_qty[$i] * $arr_harga_beli[$i],
                "tgl_expired" => $arr_tglExp[$i]
            ];
            array_push($detailTrx, $detail);
        }
        $this->FakturPembelianModel->addFakturPembelian($dataFaktur, $detailTrx);

        echo json_encode($dataFaktur);
    }

    // supplier
    public function getSupplier()
    {
        echo json_encode($this->SupplierModel->findAll());
    }
    public function saveSupplier()
    {
        $this->SupplierModel->save([
            'nama_supplier' => $this->request->getVar('nama_supplier'),
            'hp' => $this->request->getVar('no_hp'),
            'alamat' => $this->request->getVar('alamat'),
        ]);
        $data = ['status' => true];
        echo json_encode($data);
    }
    public function deleteSupplierById($id)
    {
        $this->SupplierModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    // Master Supplier
    public function viewMasterSupplier()
    {
        $data['title'] = 'Data Master Supplier';
        $this->load->view('admin/masterSupplier/index', $data);
    }

    public function getSupplierById($kdSupplier)
    {
        $data =  $this->SupplierModel->geySupplierbyid($kdSupplier)->getRow();
        echo json_encode($data);
    }

    public function updateSupplier()
    {
        $id_suplier = $this->input->post('id_suplier');
        $nama_supplier = $this->input->post('nama_supplier');
        $hp = $this->input->post('hp');
        $alamat = $this->input->post('alamat');
        // $autokode = $this->SupplierModel->autoKdSupplier();
        // echo 'O' . date('dm') . $autokode;
        $update = [
            "nama_supplier" => $nama_supplier,
            "hp" => $hp,
            "alamat" => $alamat
        ];
        $this->SupplierModel->updateSupplier($id_suplier, $update);
        echo json_encode(array("status" => TRUE));
    }

    // Master Supplier
    public function getDatatableSupplier()
    {
        if ($this->request->getMethod(true) == 'POST') {
            $lists =  $this->SupplierModel->get_datatables();
            $data = [];
            $no = $this->input->post("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $list->nama_supplier;
                $row[] = $list->hp;
                $row[] = $list->alamat;
                //add html for action
                $row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $list->id_suplier . "'" . ')"><i class="far fa-edit"></i> Edit</a>
                <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteSupplier(' . "'" . $list->id_suplier . "'" . ')"><i class="far fa-trash-alt"></i> Delete</a>';

                $data[] = $row;
            }
            $output = [
                "draw" => $this->input->post('draw'),
                "recordsTotal" =>  $this->SupplierModel->count_all(),
                "recordsFiltered" =>  $this->SupplierModel->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }
    // end of Master Supplier

    // UserManagement
    public function viewUserManagement()
    {
        $data['users'] = $this->UserModel->getAllUser()->result();
        // dd($data);
        $data['title'] = 'User Management';
        $this->load->view('admin/userManagement/index', $data);
    }
    public function getUserByid($id)
    {

        echo json_encode($this->UserModel->find($id));
    }

    // public function addUser()
    // {
    //     $userName = $this->input->post('username');

    //     $validated = $this->validate([
    //         'file' => [
    //             'uploaded[file]',
    //             'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
    //             'max_size[file,4096]',
    //         ],
    //     ]);
    //     $cekUsername = $this->UserModel->where('username', $userName)->find();
    //     if ($cekUsername) {
    //         if ($userName == $cekUsername[0]->username) {
    //             return $this->response->setJSON([
    //                 'success' => false,
    //                 'data' => $cekUsername[0]->username,
    //                 'msg' => "username Sudah Ada !"
    //             ]);
    //         }
    //     }

    //     $data = [
    //         'nama' => $this->input->post('nama'),
    //         'username'  => $userName,
    //         'foto'  => 'undraw_profile.svg',
    //         'password'  =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
    //         'role_id'  => $this->input->post('role')
    //     ];

    //     $avatar = $this->request->getFile('file');
    //     if ($avatar != '') {
    //         if ($validated) {
    //             $avatar->move('img');
    //             $data['foto']  = $avatar->getName();
    //             $save = $this->UserModel->save($data);
    //             $response = [
    //                 'success' => true,
    //                 'data' => $save,
    //                 'msg' => "Image has been uploaded successfully"
    //             ];
    //         } else {
    //             $response = [
    //                 'success' => false,
    //                 'data' => $avatar,
    //                 'msg' => "Gagal Upload File"
    //             ];
    //         }
    //     } else {
    //         $save = $this->UserModel->save($data);
    //         $response = [
    //             'success' => true,
    //             'data' => $save,
    //             'msg' => "berhasil tambah user"
    //         ];
    //     }
    //     return $this->response->setJSON($response);
    // }

    // public function updateUser()
    // {
    //     $id_user = $this->input->post('id_user');
    //     $old_fileName = $this->input->post('old_fileName');
    //     $usernameUpdate = $this->input->post('usernameUpdate');
    //     helper(['form', 'url']);
    //     $validated = $this->validate([
    //         'fileUpdate' => [
    //             'uploaded[fileUpdate]',
    //             'mime_in[fileUpdate,image/jpg,image/jpeg,image/gif,image/png]',
    //             'max_size[fileUpdate,4096]',
    //         ],
    //     ]);
    //     $cekUsername = $this->UserModel->cekUserUpdate($id_user, $usernameUpdate)->resultArray();
    //     if ($cekUsername) {
    //         if (count($cekUsername) > 0) {
    //             return $this->response->setJSON([
    //                 'success' => false,
    //                 'data' => $usernameUpdate,
    //                 'msg' => "username Sudah Ada !"
    //             ]);
    //         }
    //     }

    //     $data = [
    //         'nama' => $this->input->post('namaUpdate'),
    //         'username'  => $usernameUpdate,
    //         'foto'  => $old_fileName,
    //         'role_id'  => $this->input->post('roleUpdate')
    //     ];

    //     $avatar = $this->request->getFile('fileUpdate');
    //     if ($avatar != '') {
    //         if ($validated) {
    //             $avatar->move('img');
    //             $data['foto']  = $avatar->getName();
    //             $save = $this->UserModel->update($id_user, $data);;
    //             $response = [
    //                 'success' => true,
    //                 'data' => $save,
    //                 'msg' => "Image has been uploaded successfully"
    //             ];
    //         } else {
    //             $response = [
    //                 'success' => false,
    //                 'data' => $avatar->getName(),
    //                 'msg' => "Gagal Upload File"
    //             ];
    //         }
    //     } else {
    //         $save = $this->UserModel->update($id_user, $data);;
    //         $response = [
    //             'success' => true,
    //             'data' => $save,
    //             'msg' => "berhasil Ubah"
    //         ];
    //     }
    //     return $this->response->setJSON($response);
    // }
    public function deleteUserById($id)
    {
        // $img = $this->UserModel->where('id', $id)->find();
        // unlink("img/" . $img);
        $this->UserModel->where('id', $id)->delete();
        echo json_encode(array("status" => TRUE));
    }
}
