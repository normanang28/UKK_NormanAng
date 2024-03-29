<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kasir extends BaseController
{
    public function index()
    {
        $model=new M_model();

        $where2=array('username'=>session()->get('username'));

        $on='penjualan_barang.id_barang_pp=barang.id_barang';
        $on2='penjualan_barang.maker_pp=user.id_user';
        $data['data']=$model->superWithWhere('penjualan_barang', 'barang', 'user', $on, $on2, $where2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        $data['p']=$model->tampil('barang');

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('kasir/kasir');
        echo view('layout/footer'); 
    }

    public function tambah_kasir()
    {
        $model = new M_model();
        $model2 = new M_model();
        $model3 = new M_model();
        $id_barang = $this->request->getPost('id_barang');
        $nama_customer = $this->request->getPost('nama_customer');
        $qty = $this->request->getPost('qty');
        $dibayar = $this->request->getPost('dibayar');
        $kembalian = $this->request->getPost('kembalian');
        
        $total_harga = $dibayar - $kembalian;

        $maker_pp = session()->get('id');
        $data = array(
            'id_barang_pp' => $id_barang,
            'nama_customer' => $nama_customer,
            'qty' => $qty,
            'dibayar' => $dibayar,
            'kembalian' => $kembalian,
            'total_harga' => $total_harga,
            'maker_pp' => $maker_pp
        );

        $data2 = array(
            'id_barang_pp' => $id_barang,
            'nama_customer' => $nama_customer,
            'qty' => $qty,
            'dibayar' => $dibayar,
            'kembalian' => $kembalian,
            'total_harga' => $total_harga,
            'maker_pp' => $maker_pp
        );
        
        $data3=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Menambah Data Penjualan Barang/Kasir Dengan ID barang ". $id_barang."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data3);

        $model->simpan('penjualan_barang',$data);
        $model->simpan('barang_keluar',$data2);
        return redirect()->to('/Kasir');
    }

    public function hapus($id)
    {
        $model=new M_model();
        $model2=new M_model();
        $where=array('id_penjualan_barang'=>$id);

        $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Menghapus Data Penjualan Barang/Kasir Dengan ID ". $id."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        $model->hapus('penjualan_barang',$where);
        $model2->hapus('barang_keluar',$where);
        return redirect()->to('/Kasir');
    }

    public function clear()
    {
        $model=new M_model();
        $where=array('penjualan_barang.maker_pp'=>session()->get('id'));

        $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Clear Data Penjualan Barang/Kasir ",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        $model->hapus('penjualan_barang', $where);
        return redirect()->to('/Kasir');
    }
}
