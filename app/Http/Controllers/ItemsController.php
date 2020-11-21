<?php

namespace App\Http\Controllers;

use App\Items;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Items::paginate(50);
        return view('items.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

        ]);
        $input=$request->all();

        Items::create($input);

        Flash::success('Data Saved Successfully');

        return redirect(route('itemList.show'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Items::findOrFail($id);

        if(empty($item)){
            Flash::error('Item Doesnt Exist');

            return redirect(route('itemList.index'));
        }

        return view('items.show', compact('item'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Items::findOrFail($id);
        if(empty($item)){
            Flash::success("Item Does not Exist");

            return redirect(route('itemList.index'));
        }

        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $item = Items::findOrFail($id);

        if(empty($item)){
            Flash::error('Item Not Found');

            return redirect(route('itemList.index'));
        }
        $this->validate($request,[

        ]);

        $input = $request->all();

        $item = Items::update($input, $id);
        return redirect(route('itemList.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Items::findOrFail($id);
        if (empty($item))
        {
            Flash::error('Item Doesnt Exist');

            return redirect(route('itemList.index'));
        }
        $item = Items::destroy($id);
        Flash::success('Data Deleted Successfully');

        return redirect(route('itemList.index'));
    }
}
