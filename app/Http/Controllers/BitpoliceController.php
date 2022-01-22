<?php

namespace App\Http\Controllers;

use App\Bitpolice;
use App\Categorybitpolice;
use App\Categorie;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class bitpoliceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //      $this->middleware('permission:bitpolice-list|bitpolice-create|bitpolice-edit|bitpolice-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:bitpolice-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:bitpolice-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:bitpolice-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bitpolices = Bitpolice::latest()
        ->orderBy('id', 'DESC')
        ->paginate(5);
        // dd($bitpolices);
        return view('bitpolices.index', compact('bitpolices'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Categorie::all('name', 'id');
        $selectedCategory = Categorie::first()->id;
        return view('bitpolices.create', compact('category', 'selectedCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image = $request->file('photo');
        if($image != '')
        {
            $request->validate([
                'designation'    =>  'required',
                'bit_name'     =>  'required',
                'mobile'     =>  'required|numeric',
                'name'     =>  'required',
                'photo'     =>  'required',
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage'), $image_name);

            $form_data = array(
                'designation'       =>   $request->designation,
                'bit_name'        =>   $request->bit_name,
                'address'        =>   $request->address,
                'location'        =>   $request->location,
                'phone'        =>   $request->phone,
                'mobile'        =>   $request->mobile,
                'fax'        =>   $request->fax,
                'email'        =>   $request->email,
                'remarks'        =>   $request->remarks,
                'name'        =>   $request->name,
                'map'        =>   $request->map,
                'is_active'        =>   $request->is_active,
                'photo'            =>   $image_name,
                'create_date'            =>   $request->create_date,
                'created_at'  =>   Carbon::now()
            );
        }
        else
        {
            $request->validate([
                'designation'    =>  'required',
                'bit_name'     =>  'required',
                'mobile'     =>  'required|numeric',
                'name'     =>  'required'
            ]);

            $form_data = array(
                'designation'       =>   $request->designation,
                'bit_name'        =>   $request->bit_name,
                'address'        =>   $request->address,
                'location'        =>   $request->location,
                'phone'        =>   $request->phone,
                'mobile'        =>   $request->mobile,
                'fax'        =>   $request->fax,
                'email'        =>   $request->email,
                'remarks'        =>   $request->remarks,
                'name'        =>   $request->name,
                'map'        =>   $request->map,
                'is_active'        =>   $request->is_active,
                'create_date'            =>   $request->create_date,
                'created_at'  =>   Carbon::now()
            );
        }

        Bitpolice::create($form_data);

        return redirect()->route('bitpolices.index')->with('success', 'bitpolice created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\bitpolice  $bitpolice
     * @return \Illuminate\Http\Response
     */
    public function show(Bitpolice $bitpolice)
    {
        return view('bitpolices.show', compact('bitpolice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\bitpolice  $bitpolice
     * @return \Illuminate\Http\Response
     */
    public function edit(Bitpolice $bitpolice)
    {
        $category = Categorie::all('name', 'id');
        return view('bitpolices.edit', compact('bitpolice', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\bitpolice  $bitpolice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image = $request->file('photo');
        if($image != '')
        {
            $request->validate([
                'bit_name'    =>  'required',
                'designation'     =>  'required',
                'name'     =>  'required',
                'phone'     =>  'required',
                'photo'         =>  'image|max:2048'
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage'), $image_name);

            $form_data = array(
                'designation'       =>   $request->designation,
                'bit_name'        =>   $request->bit_name,
                'address'        =>   $request->address,
                'location'        =>   $request->location,
                'phone'        =>   $request->phone,
                'mobile'        =>   $request->mobile,
                'fax'        =>   $request->fax,
                'email'        =>   $request->email,
                'remarks'        =>   $request->remarks,
                'name'        =>   $request->name,
                'map'        =>   $request->map,
                'is_active'        =>   $request->is_active,
                'photo'            =>   $image_name,
                'updated_at'=> now(),
                'create_date'  =>   Carbon::now(),
            );
        }
        else
        {
            $request->validate([
                'bit_name'    =>  'required',
                'designation'     =>  'required',
                'name'     =>  'required',
                'phone'     =>  'required'
            ]);

            $form_data = array(
            'designation'       =>   $request->designation,
            'bit_name'        =>   $request->bit_name,
            'address'        =>   $request->address,
            'location'        =>   $request->location,
            'phone'        =>   $request->phone,
            'mobile'        =>   $request->mobile,
            'fax'        =>   $request->fax,
            'email'        =>   $request->email,
            'remarks'        =>   $request->remarks,
            'name'        =>   $request->name,
            'map'        =>   $request->map,
            'is_active'        =>   $request->is_active,
            'updated_at'=> now(),
            'create_date'  =>   Carbon::now(),
            );
        }


        Bitpolice::whereId($id)->update($form_data);

        return redirect()->route('bitpolices.index')->with('success', 'bitpolice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\bitpolice  $bitpolice
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $status = Bitpolice::where('id',$id)->first();
        if ($status->is_active == 'Yes') {
            Bitpolice::where('id',$id)->update([
               'is_active' => 'No'
            ]);
        }else{
            Bitpolice::where('id',$id)->update([
               'is_active' => 'Yes'
            ]);
        }

        return redirect()->route('bitpolices.index')
                        ->with('success', 'bitpolice deleted successfully');
    }

}
