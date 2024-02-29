<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Petugas extends BaseController
{
    public function index()
    {
        $model=new M_model();
        $on='petugas.maker_petugas=user.id_user';
        $data['data']=$model->fusion('petugas', 'user', $on);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('petugas/petugas');
        echo view('layout/footer'); 
    }

    public function tambah()
    {
        $nama_petugas=$this->request->getPost('nama_petugas');
        $alamat=$this->request->getPost('alamat');
        $no_telp=$this->request->getPost('no_telp');
        $username=$this->request->getPost('username');
        $level=$this->request->getPost('level');
        $maker_petugas=session()->get('id');

        $user=array(
            'username'=>$username,
            'password'=>md5('kasir'),
            'level'=>$level,
        );

        $model=new M_model();
        $model->simpan('user', $user);
        $where=array('username'=>$username);
        $id=$model->getarray('user', $where);
        $iduser = $id['id_user'];

        $pegawai = array(
            'nama_petugas' => $nama_petugas,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'id_user_petugas' => $iduser,
            'maker_petugas' => $maker_petugas,
        );

        $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"menambah data petugas dengan nama ". $nama_petugas."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        $model->simpan('petugas', $pegawai);
        return redirect()->to('/Petugas');
    }  

    public function reset_password($id)
    {
        $model=new M_model();
        $where=array('id_user'=>$id);
        $data=array(
            'password'=>md5('@dmin123')
        );

        $data2=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Mereset password dengan ID ". $id."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data2);

        $model->edit('user',$data,$where);

        return redirect()->to('/Petugas');
    }

    public function edit($id)
    {
        $model=new M_model();
        $where2=array('petugas.id_user_petugas'=>$id);

        $on='petugas.id_user_petugas=user.id_user';
        $data['data']=$model->edit_user('petugas', 'user',$on, $where2);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('petugas/edit');
        echo view('layout/footer');
    }

    public function aksi_edit()
    {
        $id = $this->request->getPost('id');
        $username = $this->request->getPost('username');
        $level = $this->request->getPost('level');
        $nama_petugas = $this->request->getPost('nama_petugas');
        $alamat = $this->request->getPost('alamat');
        $no_telp = $this->request->getPost('no_telp');
        $maker_petugas = session()->get('id');
        
        $tanggal_petugas = date('Y-m-d H:i:s');

        $where = array('id_user' => $id);
        $where2 = array('id_user_petugas' => $id);
        if ($password != '') {
            $user = array(
                'username' => $username,
                'level' => $level,
            );
        } else {
            $user = array(
                'username' => $username,
                'level' => $level,
            );
        }

        $model = new M_model();
        $model->edit('user', $user, $where);

        $petugas = array(
            'nama_petugas' => $nama_petugas,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'maker_petugas' => $maker_petugas,
            'tanggal_petugas' => $tanggal_petugas,
        );

        $data2=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"mengedit data petugas dengan nama ". $nama_petugas."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data2);

        $model->edit('petugas', $petugas, $where2);
        return redirect()->to('/Petugas');
    }

    public function hapus($id)
    {
        $model=new M_model();
        $where2=array('id_user'=>$id);
        $where=array('id_user_petugas'=>$id);

        $data2=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Menghapus data petugas dengan ID ". $id."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data2);

        $model->hapus('petugas',$where);
        $model->hapus('user',$where2);
        return redirect()->to('/Petugas');
    }
}