<?php
    require 'connDB.php';
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'ID Penjualan');
    $sheet->setCellValue('C1', 'Nama');
    $sheet->setCellValue('D1', 'Alamat');
    $sheet->setCellValue('E1', 'HP');
    $sheet->setCellValue('F1', 'Kodepos');
    $sheet->setCellValue('G1', 'Tanggal Transaksi');
    $sheet->setCellValue('H1', 'Status');
    
    $sql = "SELECT * FROM penjualan INNER JOIN pembeli ON penjualan.idPembeli=pembeli.idPembeli";
    $i = 2;
    $no = 1;
    if ($result = $conn->query($sql)){
        while ($row = $result->fetch_assoc()){
            $status = $row["status"];
            $sheet->setCellValue('A'.$i, $no++);
            $sheet->setCellValue('B'.$i, $row['idPenjualan']);
            $sheet->setCellValue('C'.$i, $row['nama']);
            $sheet->setCellValue('D'.$i, $row['alamat']);
            $sheet->setCellValue('E'.$i, $row['hp']);
            $sheet->setCellValue('F'.$i, $row['kodepos']);
            $sheet->setCellValue('G'.$i, $row['tglTransaksi']);
            switch ($status) {
                case '0':
                    $sheet->setCellValue('H'.$i, 'Belum bayar');
                    break;
                case '1':
                    $sheet->setCellValue('H'.$i, 'Sudah bayar');
                    break;
                case '2':
                    $sheet->setCellValue('H'.$i, 'Sudah kirim');
                    break;
            }	
            $i++;
        }
        $result->free();
    }

    $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
    $i = $i - 1;
    $sheet->getStyle('A1:H'.$i)->applyFromArray($styleArray);


    $writer = new Xlsx($spreadsheet);
    $writer->save('Data Penjualan.xlsx');

    header("location:template.php?content=admin.php");
?>