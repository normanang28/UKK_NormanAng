<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LogActivity extends BaseController
{
    public function index()
    {
        $model=new M_model();
        $on='log_activity.id_user_log=user.id_user';
        $data['data'] = $model->fusion('log_activity', 'user', $on);

        $id=session()->get('id');
        $where=array('id_user'=>$id);

        $where=array('id_user' => session()->get('id'));
        $data['foto']=$model->getRow('user',$where);

        echo view ('layout/header', $data);
        echo view ('layout/menu');
        echo view ('log_activity/log_activity');
        echo view ('layout/footer');
    }
}