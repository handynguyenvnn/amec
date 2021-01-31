<?php

namespace App\Http\Controllers;

use App\Repositories\Tips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReportAccessTipController extends Controller
{

    public function index(Tips $tips, Request $request)
    {
        $data = $tips->search($request->all());
        $params = $request->except('current_id');
        return view('report_access.list', compact('data', 'params'));
    }
    public function download( Tips $tips)
    {
        $table = $tips->getAll();
        $filename = "access_analysis.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['id', 'chapter_id', 'language_id', 'name', 'file_id', 'created_at', 'updated_at']);
        foreach($table as $row) {
            fputcsv($handle, [$row['id'], $row['chapter_id'], $row['language_id'], $row['name'], $row['file_id'],$row['created_at'],$row['updated_at']]);
        }
        fclose($handle);
        return Response::download($filename, 'access_analysis_'.date("d_m_Y_H_i_s").'.csv', ['Content-Type' => 'text/csv']);
    }
}
