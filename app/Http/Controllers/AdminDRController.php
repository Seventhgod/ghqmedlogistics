<?php

namespace App\Http\Controllers;

use App\Models\DrugRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;
use App\DataTables\DrugRequestDataTable;

class AdminDRController extends Controller
{
    public function index(Request $request){
        /*if($request->ajax()){
            return DataTables::of(DrugRequests::query())
                ->addColumn('action', 'ADDTactions')
                ->addColumn('status','statusflag')
                ->editColumn('status', function (){
                    return $data = DrugRequests::all();
                })
                ->addColumn('approval_status', '')
                ->editColumn('approval_status', function (){
                    return $data = DrugRequests::all();
                })
                ->rawColumns(['action', 'status', 'approval_status'])
                ->make(true);
        }
        return view('adminrequest.index');*/
        $data = DrugRequests::get();
        return response()->json($data);
    }

    public function testIndex()
    {
        return view ('adminrequest.index');
    }

    public function create(){
        return view('adminrequest.show');
    }

    public function store(Request $request){
        $this->validate($request,[
            'project_name' => 'required',
            'project_date' => 'required',
            'initiator' => 'required',
            'unit' => 'required',
            'pharmacist' => 'required',
            'file_number' => 'required',
            'indent_number' => 'required',
            'mission_code' => 'required',
            'status' => 'required'
        ]);
        $input = $request->all();

        DrugRequests::create($input);

        Flash::success('Data Saved Successfully');

        return redirect(route('adminrequests.show'));
    }


    public function show($id){
        $adminrequest = DrugRequests::findOrFail($id);

        if(empty($adminrequest)){
            Flash::error('No Request Has been Made');

            return redirect(route('adminrequests.index'));
        }
        return view('adminrequest.show')->with('adminrequest',$adminrequest);
    }

    public function edit($id){
        $adminrequest = DrugRequests::findOrFail($id);

        if (empty($drugRequests)) {
            Flash::error('Drug Requests not found');

            return redirect(route('adminrequests.index'));
        }

        return view('adminrequest.edit')->with('adminrequest', $adminrequest);
    }

    public function update($id, Request $request){
        $adminrequest = DrugRequests::findOrFail($id);
        if (empty($adminrequest)) {
            Flash::error('Drug Requests not found');

            return redirect(route('adminrequests.index'));
        }
        $this->validate($request,[
            'project_name' => 'required',
            'project_date' => 'required',
            'initiator' => 'required',
            'unit' => 'required',
            'pharmacist' => 'required',
            'file_number' => 'required',
            'indent_number' => 'required',
            'mission_code' => 'required',
            'status' => 'required'
        ]);
        $input = $request->all();
        $adminrequest = DrugRequests::update($input, $id);
        Flash::success('Data Updated Successfully');

        return redirect(route('adminrequests.index'));
    }

    public function destroy($id){
        $adminrequest = DrugRequests::findOrFail($id);

        if (empty($adminrequest)){
            Flash::error('Request Data Not Found');

            return redirect(route('adminrequests.index'));
        }

        $adminrequest = DrugRequests::destroy($id);

        Flash::success('Data Deleted Successfully');

        return redirect(route('adminrequests.index'));
    }

}
