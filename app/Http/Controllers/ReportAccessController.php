<?php

namespace App\Http\Controllers;

use App\Repositories\ReportAccess;
use App\Repositories\ChapterNames;
use App\Repositories\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReportAccessController extends Controller
{

    public function index(ReportAccess $reportAccess, Languages $languages, Request $request)
    {
        $data = $reportAccess->search($request->all());
        $lang = $languages->getAll();
        $total = $reportAccess->totalSmallTestStudents();
        $params = $request->except('current_id');
        return view('report_access.list', compact('data','lang', 'total',  'params'));
    }

    public function bigTests(ReportAccess $reportAccess, Request $request)
    {
        $data = $reportAccess->searchBigTests($request->all());
        $total = $reportAccess->totalBigTestStudents()->total;
        $params = $request->except('current_id');
        return view('report_access.big_test', compact('data', 'total',  'params'));
    }

    public function certifications(ReportAccess $reportAccess)
    {
        $dataMonths = $reportAccess->reportCertificatesByMonth();
        $dataYears = $reportAccess->reportCertificatesByYear();

        $reportMonths = array();
        for($i = 1; $i <= 12; $i++) {
            foreach($dataMonths as  $item) {
                if ($item->month == $i) {
                    $reportMonths[$i] = array('month' => $i, 'value' => $item->value);
                }
                else {
                    $reportMonths[$i] = array('month' => $i, 'value' => 0);
                }
            }

        }

        $total = $reportAccess->totalCertificatesIssuers()->total;
        return view('report_access.certification', compact('reportMonths','total',  'dataYears'));
    }

    public function download(ReportAccess $reportAccess)
    {
        $tables = $reportAccess->getSmallTestsCSV();
        $file = 'report_access_'.date("d_m_Y_H_i_s").'.csv';
//        $doc = new \DomDocument('1.0', 'UTF-8');
        header ('<meta http-equiv="Content-Type" content="text/html; charset=UTF16-LE">');
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-type: application/octet-stream; charset=UTF16-LE");
        header("Content-Disposition: attachment; filename=$file; charset=UTF16-LE");
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Content-Transfer-Encoding: binary");
        $results = 'ID'."\t".'チャプター名'."\t"."言語"."\t"."受講人数"."\t\n";
        foreach ($tables as $key => $table){
            $results .=  $table['id']."\t";
            $results .=  $table['name']."\t";
            $results .=  $table['lang']."\t";
            $results .=  $table['result']."\t\n";
        }
        print_r (chr(255).chr(254).mb_convert_encoding($results, "UTF-16LE", "UTF-8"));die;
//        $filename = "access_analysis.csv";
//        $handle = fopen($filename, 'w+');
//        fputcsv($handle, ['ID', 'チャプター名', '言語', '受講人数']);
//        foreach($table as $row) {
//            fputcsv($handle, [$row['id'], $row['name'], $row['lang'], $row['result']]);
//        }
//        fclose($handle);
//        return Response::download($filename, 'access_analysis_'.date("d_m_Y_H_i_s").'.csv', ['Content-Type' => 'text/csv']);
    }

    public function downloadBigTests(ReportAccess $report) {
        $tables = $report->getBigTestsCSV();
        $file = 'big_tests_'.date("d_m_Y_H_i_s").'.csv';
        header ('<meta http-equiv="Content-Type" content="text/html; charset=UTF16-LE">');
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-type: application/octet-stream; charset=UTF16-LE");
        header("Content-Disposition: attachment; filename=$file; charset=UTF16-LE");
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Content-Transfer-Encoding: binary");
        $results = 'ID'."\t".'大テスト名'."\t"."言語"."\t"."受講人数(合格/不合格)"."\t\n";
        foreach ($tables as $key => $table){
            $results .=  $table['id']."\t";
            $results .=  $table['name']."\t";
            $results .=  $table['lang']."\t";
            $results .=  $table['result']."\t\n";
        }
        print_r (chr(255).chr(254).mb_convert_encoding($results, "UTF-16LE", "UTF-8"));die;
    }

}
