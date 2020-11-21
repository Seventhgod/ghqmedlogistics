<?php

namespace App\Http\Controllers;

use App\Models\DrugRequests;
use App\Repositories\DrugRequestsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DrugRequestsController extends AppBaseController
{
    /** @var  DrugRequestsRepository */
    private $drugRequestsRepository;

    public function __construct(DrugRequestsRepository $drugRequestsRepo)
    {
        $this->drugRequestsRepository = $drugRequestsRepo;
    }

    /**
     * Display a listing of the DrugRequests.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        $drugRequests = DrugRequests::all();

        return view('drug_requests.index', compact('drugRequests'));
    }

    /**
     * Show the form for creating a new DrugRequests.
     *
     * @return Response
     */
    public function create()
    {
        return view('drug_requests.create');
    }

    /**
     * Store a newly created DrugRequests in storage.
     *
     * @param CreateDrugRequestsRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'projectName'=>'required',
            'project_code' => 'required',
            'ItemName'=> 'required',
            'quantity'=>'required',
            'unit' => 'required',
            'Category' => 'required'
        ]);
        $input = $request->all();

        //$drugrequest = new DrugRequests();
        //$drugrequest->save($input);
        DrugRequests::create($input);

        Flash::success('Drug Requests saved successfully.');

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified DrugRequests.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $drugRequests = $this->drugRequestsRepository->findWithoutFail($id);

        if (empty($drugRequests)) {
            Flash::error('Drug Requests not found');

            return redirect(route('drugRequests.index'));
        }

        return view('drug_requests.show')->with('drugRequests', $drugRequests);
    }

    /**
     * Show the form for editing the specified DrugRequests.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $drugRequests = $this->drugRequestsRepository->findWithoutFail($id);

        if (empty($drugRequests)) {
            Flash::error('Drug Requests not found');

            return redirect(route('drugRequests.index'));
        }

        return view('drug_requests.edit')->with('drugRequests', $drugRequests);
    }

    public function count(){
        return DrugRequests::count();
    }

    /**
     * Update the specified DrugRequests in storage.
     *
     * @param  int              $id
     * @param UpdateDrugRequestsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDrugRequestsRequest $request)
    {
        $drugRequests = $this->drugRequestsRepository->findWithoutFail($id);

        if (empty($drugRequests)) {
            Flash::error('Drug Requests not found');

            return redirect(route('drugRequests.index'));
        }

        $drugRequests = $this->drugRequestsRepository->update($request->all(), $id);

        Flash::success('Drug Requests updated successfully.');

        return redirect(route('drugRequests.index'));
    }
    //Status Changer
    public function changeStatus(Request $request)
    {
        $drugrequest = DrugRequests::find($request->id);
        $drugrequest->status = $request->status;
        $drugrequest->save();
        return response()->json(['Success'=>'Status Changed Successfully']);
    }

    /**
     * Remove the specified DrugRequests from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $drugRequests = $this->drugRequestsRepository->findWithoutFail($id);

        if (empty($drugRequests)) {
            Flash::error('Drug Requests not found');

            return redirect(route('drugRequests.index'));
        }

        $this->drugRequestsRepository->delete($id);

        Flash::success('Drug Requests deleted successfully.');

        return redirect(route('drugRequests.index'));
    }
}
