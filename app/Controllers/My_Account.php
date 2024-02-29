<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class My_Account extends BaseController
{
    public function index()
    {
        $id=session()->get('id');
        $where2=array('id_user'=>$id);
        $where3=array('id_user_petugas'=>$id);
        $model=new M_model();
        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);
        $data['use']=$model->getRow('user',$where2);
        $data['petugas']=$model->getRow('petugas',$where3);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        echo view('layout/header', $data);
        echo view('layout/menu');
        echo view('My_Account/My_Account');
        echo view('layout/footer');
    }

    public function ganti_password()   
    {
        $pass=$this->request->getPost('pw');
        $id=session()->get('id');
        $model= new M_model();

        $data=array( 
            'password'=>md5($pass)
        );

        $data=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"Mengganti Password pada dengan ID akun ". $id."",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data);

        $where=array('id_user'=>$id);
        $model->edit('user', $data, $where);
        return redirect()->to('/My_Account');
    }
}
