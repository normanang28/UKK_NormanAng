<?php

namespace App\Controllers;
use CodeIgniter\Controllers;
use App\Models\M_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Laporan extends BaseController
{
    public function print_nota()
    {
        $model=new M_model();
        $username = session()->get('username');
        $data['data'] = $model->print_nota('penjualan_barang', $username);

        echo view('kasir/print_nota',$data);
    }

    public function laporan_penjualan()
    {
        $model=new M_model();
        $data['kunci']='view_penjualan';

        $id=session()->get('id');
        $where=array('id_user'=>$id);
        $data['foto']=$model->getRow('user',$where);

        echo view('layout/header',$data);
        echo view('layout/menu');
        echo view('laporan/filter');
        echo view('layout/footer');
    }

    public function print_penjualan()
    {
        $model=new M_model();
        $awal= $this->request->getPost('awal');
        $akhir= $this->request->getPost('akhir');
        $data['data']=$model->filter_laporan_pengeluaran('barang_keluar',$awal,$akhir);

        $data2=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"menampilkan laporan penjualan dalam format print",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data2);

        echo view('laporan/laporan_penjualan',$data);
    }

    public function pdf_penjualan()
    {
        $model=new M_model();
        $awal= $this->request->getPost('awal');
        $akhir= $this->request->getPost('akhir');
        $data['data']=$model->filter_laporan_pengeluaran('barang_keluar',$awal,$akhir);


        $data2=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"menampilkan laporan penjualan dalam format PDF",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data2);

        $dompdf = new\Dompdf\Dompdf();
        $dompdf->loadHtml(view('laporan/laporan_penjualan',$data));
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $dompdf->stream('my.pdf', array('Attachment'=>false));
        exit();    
    }

    public function excel_penjualan()
    {
        $model = new M_model();
        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        $data = $model->filter_laporan_pengeluaran('barang_keluar', $awal, $akhir);

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Nama Barang')
            ->setCellValue('C1', 'QTY')
            ->setCellValue('D1', 'Total Harga Pengeluaran');

        $styleArrayHeader = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'C0C0C0'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        $spreadsheet->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleArrayHeader);

        $column = 2;
        $totalTotal = 0;
        $totalQTY = 0;
        foreach ($data as $item) {
            $totalTotal += $item->total_harga; 
            $totalQTY += $item->qty; 

            $total_harga_formatted = number_format($item->total_harga, 2, ',', '.');

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, ucwords(strtolower($item->tanggal_laporan)))
                ->setCellValue('B' . $column, ucwords(strtolower($item->nama_barang)))
                ->setCellValue('C' . $column, ucwords(strtolower($item->qty)))
                ->setCellValue('D' . $column, 'Rp ' . $total_harga_formatted . ',00');

            $styleArrayData = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ];

            $spreadsheet->getActiveSheet()->getStyle('A' . $column . ':D' . $column)->applyFromArray($styleArrayData);

            $column++;
        }

        $totalTotal_formatted = number_format($totalTotal, 2, ',', '.');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . $column, 'TOTAL:')
            ->setCellValue('C' . $column, $totalQTY)
            ->setCellValue('D' . $column, 'Rp ' . $totalTotal_formatted . ',00');

        $styleArrayTotal = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'FFFF00'], 
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        $spreadsheet->getActiveSheet()->getStyle('B' . $column . ':D' . $column)->applyFromArray($styleArrayTotal);

        foreach (range('A', 'D') as $col) {
            $spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }


        $data2=array(
            'id_user_log'=>session()->get('id'),
            'aktifitas'=>"menampilkan laporan penjualan dalam format excel",
            'waktu'=>date('Y-m-d H:i:s')
        );
        $model->simpan('log_activity',$data2);

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan Kasir Baju - Penjualan Barang';

        header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
