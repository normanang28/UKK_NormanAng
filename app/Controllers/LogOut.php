<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LogOut extends BaseController
{
    public function index()
    {
        if(session()->get('id') > 0) {
            $model = new M_model();
            $id = session()->get('id');

            $data=array(
                'id_user_log'=>session()->get('id'),
                'aktifitas'=>"LogOut dengan ID ". $id."",
                'waktu'=>date('Y-m-d H:i:s')
            );
            $model->simpan('log_activity',$data);

            session()->destroy();
            return redirect()->to('/');
        } else {
            return redirect()->to('/Dashboard');
        }
    }
}
