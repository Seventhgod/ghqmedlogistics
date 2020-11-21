<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\DrugRequests;
use App\Projects;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class ProjectsController extends Controller
{
    public function filter(Request $request)
    {
        $query = Projects::query();
        //$query = DB::table('projects');

        if($request->search){
            $query->where('project_name', 'LIKE', '%'.$request->search.'%');
        }
        if (Auth::user()->role_name == "Admin"){
            $projects = $query->orderBy($request->input('orderBy.column'), $request->input('orderBy.direction'))
                ->paginate($request->input('pagination.per_page'));
        }
        else{
            $projects = $query->where('unit','=', Auth::user()->unit)->orderBy($request->input('orderBy.column'), $request->input('orderBy.direction'))
                ->paginate($request->input('pagination.per_page'));
        }

        return $projects;
        //return json_encode($query);
    }

    public function index()
    {
        return view('projects.index');
    }

    public function addRequest($project)
    {
        $project_code = Projects::findOrFail($project);
        $items = DB::table('itemList')->select('ProductName')->where('drugcategory', 'DRUGS')->get();
        $category = DB::table('categories')->select('name')->get();
        if(empty($project_code)){
            Flash::error('No Request Has been Made');

            return redirect()->back();
        }

        return view('projects.addrequest', compact('project_code', 'items', 'category'));
    }
    public function getItem($category)
    {
        $item = DB::table('itemList')->select('ProductName')->where('drugcategory', $category)->get();
        return $item;
    }
    public function show($project)
    {
        $project = Projects::findOrFail($project);

        if(empty($project)){
            Flash::error('No Request Has been Made');

            return redirect()->back();
        }

        return view('projects.show', compact('project'));
    }

    public function projectdetails(Request $request)
    {
        $projectid = Projects::findOrFail($request->id);

        $getReq = DrugRequests::all()->where('projectName', $projectid->project_name);

        return view('projects.projectdetails', compact('getReq', 'projectid'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'project_code',
            'project_name' => 'required|string|max:255',
            'date',
            'type' => 'required|string|max:255',
            'initiator' => 'required|string|max:255',
            'unit'=> 'required|string|max:255',
            'file_number' => 'required|string|max:255',
            'mission_code' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'init_contact' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'pharmacist' => 'required|string|max:255',
            'exchange_rate' => 'required|numeric',
            'order_number' => 'required|string|max:255',
            'reference' => 'required|string|max:255',
        ]);
        $input = $request->all();
        $first_string = "PROJ";
        $input['project_code'] = $first_string.mt_rand(0000, 99999);
        $input['date'] = Carbon::now();
        $projects = new Projects();
        $projects->save($input);

        Flash::success('Data Saved Successfully');

        return redirect()->route('projects.index');
    }
    public function update($id, Request $request){
        $this->validate($request, [
            'project_code'=>'required',
            'project_name' => 'required',
            'date' => 'required',
            'type' => 'required',
            'initiator' => 'required',
            'unit'=> 'required',
            'file_number' => 'required',
            'mission_code' => 'required',
            'status' => 'required',
            'init_contact' => 'required',
            'email' => 'required',
            'pharmacist' => 'required',
            'exchange_rate' => 'required',
            'order_number' => 'required',
            'reference' => 'required',
        ]);

        $input = $request->all();
        $projects = Projects::find($id);
        $projects->update($input);
        return view('projects.index');
    }

    public function getProject($project){
        $project=Projects::findOrFail($project);
        return $project;
    }
    public function count ()
    {
        return Projects::count();
    }

    public function destroy($id){
        $project = Projects::findOrFail($id);

        if (empty($project)){
            Flash::error('Request Data Not Found');

            return redirect(route('adminrequests.index'));
        }

        $project = Projects::destroy($id);

        Flash::success('Data Deleted Successfully');

        return redirect(route('projects.index'));
    }
}
