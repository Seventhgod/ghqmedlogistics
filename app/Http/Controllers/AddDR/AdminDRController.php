<?php

namespace App\Http\Controllers\AddDR;

use App\Models\DrugRequests;
use App\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;
use App\DataTables\DrugRequestDataTable;
use App\Http\Controllers\Controller;

class AdminDRController extends Controller
{
    /*public function index(Request $request){
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
        return view('adminrequest.index');
        $data = DrugRequests::get();
        return response()->json($data);
    }*/
    public function filter(Request $request)
    {
        $query = Projects::query();

        if($request->search){
            $query->where('project_name', 'LIKE', '%'.$request->search.'%');
        }
        $adminrequests = $query->where('status', 'Pending')->orderBy($request->input('orderBy.column'), $request->input('orderBy.direction'))
            ->paginate($request->input('pagination.per_page'));

        return $adminrequests;
        //return json_encode($query);
    }

    public function index()
    {
        return view ('adminrequest.index');
    }

    public function changeStatus(Request $request)
    {
        $adminrequest = Projects::find($request->id);
        $adminrequest->status = $request->status;
        $adminrequest->save();
        return response()->json(['Succesfully Updated']);
    }

    public function projectdetails(Request $request)
    {
        $projectid = Projects::findOrFail($request->id);

        $getReq = DrugRequests::all()->where('projectName', $projectid->project_name);

        return view('projects.projectdetails', compact('getReq', 'projectid'));
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

        Projects::create($input);

        Flash::success('Data Saved Successfully');

        return redirect(route('adminrequests.index'));
    }


    public function show($adminrequest){
        $adminrequest = Projects::findOrFail($adminrequest);

        if(empty($adminrequest)){
            Flash::error('No Request Has been Made');

            return redirect(route('adminrequests.index'));
        }
        return view('adminrequest.show', compact('adminrequest'));
    }

    public function edit($id){
        $adminrequest = Projects::findOrFail($id);

        if (empty($adminrequest)) {
            Flash::error('Drug Requests not found');

            return redirect(route('adminrequests.index'));
        }

        return view('adminrequest.edit')->with('adminrequest', $adminrequest);
    }

    public function update($id, Request $request){
        $adminrequest = Projects::findOrFail($id);
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
        $adminrequest = Projects::update($input, $id);
        Flash::success('Data Updated Successfully');

        return redirect(route('adminrequests.index'));
    }
    public function getAdminRequest($adminrequest){
        $adminrequest=Projects::findOrFail($adminrequest);
        return $adminrequest;
    }

    public function destroy($id){
        $adminrequest = Projects::findOrFail($id);

        if (empty($adminrequest)){
            Flash::error('Request Data Not Found');

            return redirect(route('adminrequests.index'));
        }

        $adminrequest = Projects::destroy($id);

        Flash::success('Data Deleted Successfully');

        return redirect(route('adminrequests.index'));
    }
    public function getUserUnit(){
        $unit = Auth::user()->unit;
        return $unit;
    }

}
