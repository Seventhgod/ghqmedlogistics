<?php

namespace App\Http\Controllers;

use App\Models\DrugRequests;
use App\Projects;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Jimmyjs\ReportGenerator\ReportMedia\ExcelReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PDFController extends Controller
{
    public function projectds(Request $request)
    {
        /*$this->validate($request,[
            'parameter'=> 'required',
        ]);*/
        $data = Projects::all();

        return view ('pdf.projects', compact('data'));
    }
    public function projectpdf()
    {
        $data = Projects::all();

        //$data = DB::table('projects')->select('*')->where('status', 'Pending')->get();
        view()->share('data', $data);

        $pdf = \PDF::loadView('pdf.projects', $data);

        return $pdf->download('projectpdf.pdf');
    }


    public function pendprojects()
    {
        $data = DB::table('projects')->select('*')->where('status', 'Pending')->get();
        view()->share('data', $data);

        $pdf = \PDF::loadView('pdf.projects', $data);

        return $pdf->download('pendingprojects.pdf');
    }

    public function projreqds(Request $request)
    {
        $project = Projects::findOrFail($request->id);
        $itemreq = DB::table('drugrequests')->select('project_code', 'projectName', 'ItemName', 'quantity', 'unit', 'Category')->where('projectName', $project->project_name)->get();
        return view('pdf.projectItemreq', compact('itemreq'));
    }
    public function projItemReq(Request $request)
    {
        $project = Projects::findOrFail($request->id);
        $data = DB::table('drugrequests')->select('project_code', 'projectName', 'ItemName', 'quantity', 'unit', 'Category')->where('projectName', $project->project_name)->get();

        view()->share('itemreq', $data);

        $pdf = \PDF::loadView('pdf.projectItemreq', $data);

        return $pdf->download('itemrequest.pdf');
    }

    public function excelReport(Request $request)
    {
        $project = Projects::findOrFail($request->id);

        $title = "Request Report";

        $meta = [ // For displaying filters description on header
            'Requests Under, ' => $project->project_name
        ];

        $queryBuilder = DB::table('drugrequests')->select('project_code', 'projectName', 'ItemName', 'quantity', 'unit', 'Category')->where('projectName', $project->project_name);

        $columns = [ // Set Column to be displayed
            'Project Code' => 'project_code',
            'Project Name' => 'projectName',
            'Item Name' => 'ItemName',
            'Quantity' => 'quantity',
            'Unit' => 'unit',
            'Category' => 'Category'
        ];

        return (new \Jimmyjs\ReportGenerator\ReportMedia\ExcelReport)->of($title, $meta, $queryBuilder, $columns)
            ->download('projrequest');
    }
}
