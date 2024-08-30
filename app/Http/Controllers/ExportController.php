<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Shipment;
use App\Models\Activity;
use Carbon\Carbon; // Pastikan Anda mengimpor Carbon

class ExportController extends Controller
{
    public function index()
    {
        return view('index'); // Pastikan Anda memiliki view 'index' yang sesuai
    }

    public function export($id)
    {
        // Mengambil data dari database berdasarkan ID kegiatan
        $activity = Activity::with('shipments')->findOrFail($id);
        $activity = Activity::with('roas')->findOrFail($id);
        $activity = Activity::with('coas')->findOrFail($id);
        $shipments = $activity->shipments;
        $roas = $activity->roas;
        $coas = $activity->coas;

        // Konversi activity_date menjadi objek Carbon jika belum
        $activityDate = Carbon::parse($activity->activity_date);

        // Memuat template Excel
        $templatePath = public_path('Template.xlsx'); // Ganti dengan path template Anda
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan data ke spreadsheet
        $row = 4;
        foreach ($shipments as $shipment) {
            $sheet->setCellValue('A' . $row, $shipment->gar);
            $sheet->setCellValue('B' . $row, $shipment->type);
            $sheet->setCellValue('C' . $row, $shipment->mv ?? '-');
            $sheet->setCellValue('D' . $row, $shipment->bg ?? '-');
            $sheet->setCellValue('E' . $row, $shipment->sp);
            $sheet->setCellValue('F' . $row, $shipment->fv);
            $sheet->setCellValue('G' . $row, $shipment->fd);
            $sheet->setCellValue('H' . $row, $shipment->bf);
            $sheet->setCellValue('I' . $row, $shipment->rc);
            $sheet->setCellValue('J' . $row, $shipment->ss);
            $sheet->setCellValue('K' . $row, Carbon::parse($shipment->arrival_date)->format('Y-m-d'));
            $sheet->setCellValue('L' . $row, Carbon::parse($shipment->departure_date)->format('Y-m-d'));
            $sheet->setCellValue('M' . $row, $shipment->duration ?? 'N/A');
            $sheet->setCellValue('N' . $row, $shipment->cargo);
            $sheet->setCellValue('O' . $row, $shipment->company ? $shipment->company->name : 'N/A');
            $sheet->setCellValue('P' . $row, $shipment->dt);
            $sheet->setCellValue('Q' . $row, $shipment->tg);
            $sheet->setCellValue('R' . $row, $shipment->sv);

            $row++;
        }
        $row = 4;
        foreach ($roas as $roa) {
            $sheet->setCellValue('S' . $row, $roa->tm);
            $sheet->setCellValue('T' . $row, $roa->im);
            $sheet->setCellValue('U' . $row, $roa->ash);
            $sheet->setCellValue('V' . $row, $roa->ash2);
            $sheet->setCellValue('W' . $row, $roa->vm);
            $sheet->setCellValue('X' . $row, $roa->fc);
            $sheet->setCellValue('Y' . $row, $roa->ts);
            $sheet->setCellValue('Z' . $row, $roa->Adb);
            $sheet->setCellValue('AA' . $row,  $roa->Arb);
            $sheet->setCellValue('AB' . $row, $roa->Daf);
            $sheet->setCellValue('AC' . $row, $roa->Analisis_Standar);

            $row++;
        }
        $row = 4;
        foreach ($coas as $coa) {
            $sheet->setCellValue('AD' . $row, $coa->number);
            $sheet->setCellValue('AE' . $row, $coa->tm2);
            $sheet->setCellValue('AF' . $row, $coa->im2);
            $sheet->setCellValue('AG' . $row, $coa->ash1);
            $sheet->setCellValue('AH' . $row, $coa->ash3);
            $sheet->setCellValue('AI' . $row, $coa->vm2);
            $sheet->setCellValue('AJ' . $row, $coa->fc2);
            $sheet->setCellValue('AK' . $row, $coa->ts3);
            $sheet->setCellValue('AL' . $row, $coa->ts2);
            $sheet->setCellValue('AM' . $row,  $coa->adb);
            $sheet->setCellValue('AN' . $row, $coa->arb);
            $sheet->setCellValue('AO' . $row, $coa->daf);

            $sheet->getStyle('A' . $row . ':AO' . $row)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ]);
            

            $row++;
        }

        // Membuat file Excel
        $writer = new Xlsx($spreadsheet);

        // Nama file yang akan didownload
        $fileName = 'shipments_export_' . $activityDate->format('Y-m') . '.xlsx';

        // Mengatur header untuk download file
        $response = Response::streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName);

        // Mengatur tipe konten
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return $response;
    }
}
