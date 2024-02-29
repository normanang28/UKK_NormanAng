<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Barang extends BaseController
{
    public function data_barang()
    {
        $model=new M_model();
        $on='barang.maker_barang=user.id_user';
        $data['data']=$model->fusion('barang', 'user', $on);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('barang/barang');
        echo view('layout/footer'); 
    }

    public function tambah_barang()
    {
        $model=new M_model();
        $nama_barang=$this->request->getPost('nama_barang');
        $harga_barang=$this->request->getPost('harga_barang');
        $maker_barang=session()->get('id');
        $data=array(

            'nama_barang '=>$nama_barang,
            'harga_barang'=>$harga_barang,
            'jumlah'=>'0',
            'maker_barang'=>$maker_barang
        );
        
        $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Menambah Data Barang ". $nama_barang."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        $model->simpan('barang',$data);
        return redirect()->to('/Barang/data_barang');
    }

    public function edit_barang($id)
    {
        $model=new M_model();
        $where2=array('barang.id_barang'=>$id);

        $on='barang.maker_barang=user.id_user';
        $data['data']=$model->edit_user('barang', 'user',$on, $where2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('barang/edit');
        echo view('layout/footer');
    }

    public function aksi_edit_barang()
    {
        $model=new M_model();
        $id=$this->request->getPost('id');
        $nama_barang=$this->request->getPost('nama_barang');
        $harga_barang=$this->request->getPost('harga_barang');
        $maker_barang=session()->get('id');

        $tanggal_barang = date('Y-m-d H:i:s');

        $data=array(
            'nama_barang'=>$nama_barang,
            'harga_barang'=>$harga_barang,
            'maker_barang'=>$maker_barang,
            'tanggal_barang' => $tanggal_barang,
        );

        $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Mengedit Data Barang ". $nama_barang." Dengan ID ". $id."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        $where=array('id_barang'=>$id);
        $model->edit('barang',$data,$where);
        return redirect()->to('/Barang/data_barang');
    }

    public function hapus_barang($id)
    {
        $model=new M_model();
        $where=array('id_barang'=>$id);

        $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Menghapus Data Barang Dengan ID ". $id."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        $model->hapus('barang',$where);
        return redirect()->to('/Barang/data_barang');
    }

    public function pendataan_barang()
    {
        $model=new M_model();
        $on='pendataan_barang.id_barang_pb=barang.id_barang';
        $on2='pendataan_barang.maker_pb=user.id_user';
        $data['data']=$model->super('pendataan_barang', 'barang', 'user', $on, $on2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        $data['p']=$model->tampil('barang');

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('pendataan_barang/pendataan_barang');
        echo view('layout/footer'); 
    }

    public function stok_barang()
    {
        $model=new M_model();
        $on='pendataan_barang.id_barang_pb=barang.id_barang';
        $on2='pendataan_barang.maker_pb=user.id_user';
        $data['data']=$model->super('pendataan_barang', 'barang', 'user', $on, $on2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('pendataan_barang/stok');
        echo view('layout/footer'); 
    }

    public function tambah_pendataan_barang()
    {
        $model=new M_model();
        $id_barang=$this->request->getPost('id_barang');
        $stok=$this->request->getPost('stok');
        $maker_pb=session()->get('id');
        $data=array(

            'id_barang_pb '=>$id_barang,
            'stok'=>$stok,
            'maker_pb'=>$maker_pb
        );
        
        $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Menambah Data Pendataan Barang dengan ID barang ". $id_barang."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        $model->simpan('pendataan_barang',$data);
        return redirect()->to('/Barang/pendataan_barang');
    }

    public function hapus_pendataan_barang($id)
    {
        $model=new M_model();
        $where=array('id_pendataan_barang'=>$id);

        $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Menghapus Data Pendataan Barang dengan ID ". $id."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        $model->hapus('pendataan_barang',$where);
        return redirect()->to('/Barang/pendataan_barang');
    }
}