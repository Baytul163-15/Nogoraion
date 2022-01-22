<?php

namespace Luova\Bitpolice\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Luova\Bitpolice\Http\Requests\BitpoliceFV;
use Luova\Bitpolice\Models\Bitpolice;
use Luova\Bitpolice\Models\BitpoliceGroup;
use Validator;
use File;
use DB;
use Post;

class BitpoliceController extends Controller
{

    public function __construct()
    {
        // $this->middleware('outlet');
    }

    public function index(Request $request)
    {
        $mdata = DB::table('bitpolices')
            ->join('users', 'users.phone', '=', 'bitpolices.mobile')
            ->select('bitpolices.*', 'users.mobile')
            ->get();

        // dd($mdata);
        return view('bitpolice::index')->with(['mdata' => $mdata]);

        // return 'Bitpolice';
    }

    public function front_view(Request $request)
    {

        return view('bitpolice::frontend.index')->with(['mdata' => null]);
    }

    public function group(Request $request)
    {
        $mdata =  BitpoliceGroup::where('is_active', 'Yes')->whereNull('parent')->get();

        return view('bitpolice::menu_add')->with(['fdata' => null, 'mdata' => $mdata]);

        // return 'Bitpolice';
    }
    public function edit_group(Request $request, $id)
    {
        $fdata =   BitpoliceGroup::findOrFail($id);

        $mdata =  BitpoliceGroup::where('is_active', 'Yes')->whereNull('parent')->get();

        return view('bitpolice::menu_add')->with(['fdata' => $fdata, 'mdata' => $mdata]);

        // return 'Bitpolice';
    }

    public function add()
    {
        $id = null;

        return view('bitpolice::add')->with(['fdata' => null, 'mdata' => null, 'id' => $id]);
    }


    public function edit($id)
    {
        $fdata =   Bitpolice::findOrFail($id);

        $id = $fdata->id;


        return view('bitpolice::add')->with(['fdata' => $fdata, 'mdata' => null, 'id' => $id]);
    }

    public function delete($id)
    {
        $fdata = Bitpolice::find($id);

        $fdata->delete();

        return redirect()->route('bitpolice.index')->with('success', 'Successfully Delete');
    }
    public function group_delete($id)
    {
        $fdata = BitpoliceGroup::find($id);

        $fdata->delete();

        return redirect()->route('bitpolice.group.index')->with('success', 'Successfully Delete');
    }

    public function store(BitpoliceFV $request)
    {
        $id = $request->get('id');
        if ($id) {
            $existing =  Bitpolice::findOrFail($id);
            if ($request->file('photo')) {
                $photo = $this->uploadImage($request);
            } else {
                $photo = $existing->photo;
            }
        } else {
            $photo = $this->uploadImage($request);
        }


        $attributes = [

            'menu_id' => $request->get('menu_id'),
            'designation' => $request->get('designation'),
            'phone' => $request->get('phone'),
            'bit_name' => $request->get('bit_name'),
            'address' => $request->get('address'),
            'location' => $request->get('location'),
            'mobile' => $request->get('mobile'),
            'fax' => $request->get('fax'),
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'photo' => $photo,
            'map' => $request->get('map'),
            'map_photo' => $request->get('map_photo'),
            'is_active' => $request->get('is_active'),
            'remarks' => $request->get('remarks'),
            'sort_by' => $request->get('sort_by'),
            'is_active' => $request->get('is_active'),
            'last_modified' => auth()->user()->id,

        ];


        if (!$id) {
            $attributes['create_date']  = date('Y-m-d');
            $attributes['create_by']  = auth()->user()->id;
        }
        // dd($attributes);




        try {

            if ($id) {

                $data =  Bitpolice::where('id', $id)->update($attributes);
            } else {
                Bitpolice::create($attributes);
            }


            return redirect()->route('bitpolice.index')->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {

            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
    public function store_group(Request $request)
    {
        $id = $request->get('id');
        // store
        $attributes = [
            'name' => $request->get('name'),
            'parent' => $request->get('parent'),
            'is_active' => $request->get('is_active'),

            'remarks' => $request->get('remarks'),
            'sort_by' => $request->get('sort_by'),
            'is_active' => $request->get('is_active'),
            'last_modified' => auth()->user()->id,

        ];

        if (!$id) {
            $attributes['create_date']  = date('Y-m-d');
            $attributes['create_by']  = auth()->user()->id;
        }
        //  dd($attributes);




        try {

            if ($id) {

                $data =  BitpoliceGroup::where('id', $id)->update($attributes);
            } else {
                BitpoliceGroup::create($attributes);
            }


            return redirect()->route('bitpolice.group.index')->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {

            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function find(Request $request)
    {
        //return $request;
        $parent = '';
        $child = '';
        $final_data = '';
        $data = [];
        $menuArr = [];
        $title = '';

        $menu_id = $request->get('id');
        if ($menu_id) {
            $menu =  BitpoliceGroup::where('id', $menu_id)->first();
            $title = ($menu_id) ? (($menu) ? 'Contact List Of ' . $menu->name : 'Not found Category') : 'All Contact List';

            if ($request->get('type') == 'master') {
                if ($menu->children && $menu->children->isNotEmpty()) {
                    $parent = get_bitpolice_menu($menu_id,  'menu_parent');
                }
            }
            if ($request->get('type') == 'parent') {
                if ($menu->children && $menu->children->isNotEmpty()) {
                    $child = get_bitpolice_menu($menu_id, 'menu_child');
                }
            }


            if ($menu) {
                $menuArr[] = $menu->id;
                if ($menu->children && $menu->children->isNotEmpty()) {
                    foreach ($menu->children as $menu) {
                        $menuArr[] = $menu->id;
                        if ($menu->children && $menu->children->isNotEmpty()) {
                            foreach ($menu->children as $menu) {
                                $menuArr[] = $menu->id;
                            }
                        }
                    }
                }
            }
        }

        if (!empty($menuArr)) {

            $data =  Bitpolice::whereIn('menu_id', $menuArr)
                ->where(['is_active' =>  'Yes'])->get();
            $final_data = get_bitpolice_table($data, $title);
        }
        if (!$menu_id) {
                    $data = DB::table('bitpolices')
                            ->leftJoin('users', 'users.phone', '=', 'bitpolices.mobile')
                            ->select('bitpolices.*', 'users.id as user_id')
                            ->get();

            $final_data = get_bitpolice_table($data, $title); 
            
        }
         // dd($posts);
        return response()->json(['data' => $final_data, 'parent' => $parent, 'child' => $child]);
    }
    public function front_details(Request $request)
    {
        $id = $request->get('id');
        $data =  Bitpolice::where('id', $id)->first();

        if ($data) {


            $final_data = get_bitpolice_model($data);

            return response()->json(['html' => $final_data, 'has_data' => 'Yes']);
        } else {
            return response()->json(['html' => '', 'has_data' => 'No']);
        }
    }

    public function uploadImage($request)
    {
        if ($request->file('photo')) {

            $file = $request->file('photo');
            // generate a new filename. getClientOriginalExtension() for the file extension
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $folder = date('FY');
            // save to storage/app/public/bitpolice/MonthYear as the new $filename
            $url = 'bitpolice/' . $folder . '/' . $filename;
            $path = $file->storeAs('public/bitpolice/' . $folder, $filename);
            return $url;
        }
        return null;
    }
    public function photodetele(Request $request, $id)
    {
        $data = Bitpolice::findOrFail($id);
        //dd(storage_path('app/public/' . $data->photo));
        $file_path = 'app/public/' . $data->photo;
        if (File::exists($file_path)) {
            unlink(storage_path($file_path));
        }


        $attributes = [
            'photo' => null,
            'last_modified' => auth()->user()->id,
        ];
        Bitpolice::where('id', $id)->update($attributes);
        return redirect()->back();
    }
}
