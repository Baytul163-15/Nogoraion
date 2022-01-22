<?php

namespace Luova\Contactlist\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Luova\Contactlist\Http\Requests\ContactlistFV;
use Luova\Contactlist\Models\ContactList;
use Luova\Contactlist\Models\ContactMenu;
use Validator;
use File;

class ContactlistController extends Controller
{

    public function __construct()
    {
        // $this->middleware('outlet');
    }

    public function index(Request $request)
    {
        $mdata =  ContactList::where('is_active', 'Yes')->get();

        return view('contactlist::index')->with(['fdata' => null, 'mdata' => $mdata]);

        // return 'Contactlist';
    }

    public function unit_contact(Request $request)
    {

        return view('contactlist::frontend.unit_contact')->with(['mdata' => null]);
    }

    public function group(Request $request)
    {
        $mdata =  ContactMenu::where('is_active', 'Yes')->whereNull('parent')->get();

        return view('contactlist::menu_add')->with(['fdata' => null, 'mdata' => $mdata]);

        // return 'Contactlist';
    }
    public function edit_group(Request $request, $id)
    {
        $fdata =   ContactMenu::findOrFail($id);

        $mdata =  ContactMenu::where('is_active', 'Yes')->whereNull('parent')->get();

        return view('contactlist::menu_add')->with(['fdata' => $fdata, 'mdata' => $mdata]);

        // return 'Contactlist';
    }

    public function add()
    {
        $id = null;

        return view('contactlist::add')->with(['fdata' => null, 'mdata' => null, 'id' => $id]);
    }


    public function edit($id)
    {
        $fdata =   ContactList::findOrFail($id);

        $id = $fdata->id;


        return view('contactlist::add')->with(['fdata' => $fdata, 'mdata' => null, 'id' => $id]);
    }

    public function delete($id)
    {
        $fdata = ContactList::find($id);

        $fdata->delete();

        return redirect()->route('contactlist.index')->with('success', 'Successfully Delete');
    }
    public function group_delete($id)
    {
        $fdata = ContactMenu::find($id);

        $fdata->delete();

        return redirect()->route('contactlist.group.index')->with('success', 'Successfully Delete');
    }

    public function store(ContactlistFV $request)
    {
        $id = $request->get('id');
        if ($id) {
            $existing =  ContactList::findOrFail($id);
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
            'mobile' => $request->get('mobile'),
            'fax' => $request->get('fax'),
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'photo' => $photo,
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

                $data =  ContactList::where('id', $id)->update($attributes);
            } else {
                ContactList::create($attributes);
            }


            return redirect()->route('contactlist.index')->with('success', 'Successfully save changed');
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

                $data =  ContactMenu::where('id', $id)->update($attributes);
            } else {
                ContactMenu::create($attributes);
            }


            return redirect()->route('contactlist.group.index')->with('success', 'Successfully save changed');
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
            $menu =  ContactMenu::where('id', $menu_id)->first();
            $title = ($menu_id) ? (($menu) ? 'Contact List Of ' . $menu->name : 'Not found Category') : 'All Contact List';

            if ($request->get('type') == 'master') {
                if ($menu->children && $menu->children->isNotEmpty()) {
                    $parent = get_contactlist_menu($menu_id,  'menu_parent');
                }
            }
            if ($request->get('type') == 'parent') {
                if ($menu->children && $menu->children->isNotEmpty()) {
                    $child = get_contactlist_menu($menu_id, 'menu_child');
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

            $data =  ContactList::whereIn('menu_id', $menuArr)
                ->where(['is_active' =>  'Yes'])->get();
            $final_data = get_data_to_table($data, $title);
        }
        if (!$menu_id) {

            $data =  ContactList::where(['is_active' =>  'Yes'])->get();
            $final_data = get_data_to_table($data, $title);
        }



        //  dd($data);




        return response()->json(['data' => $final_data, 'parent' => $parent, 'child' => $child]);
    }

    public function uploadImage($request)
    {
        if ($request->file('photo')) {

            $file = $request->file('photo');
            // generate a new filename. getClientOriginalExtension() for the file extension
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $folder = date('FY');
            // save to storage/app/public/contactlist/MonthYear as the new $filename
            $url = 'contactlist/' . $folder . '/' . $filename;
            $path = $file->storeAs('public/contactlist/' . $folder, $filename);
            return $url;
        }
        return null;
    }
    public function photodetele(Request $request, $id)
    {
        $data = ContactList::findOrFail($id);
        //dd(storage_path('app/public/' . $data->photo));
        $file_path = 'app/public/' . $data->photo;
        if (File::exists($file_path)) {
            unlink(storage_path($file_path));
        }


        $attributes = [
            'photo' => null,
            'last_modified' => auth()->user()->id,
        ];
        ContactList::where('id', $id)->update($attributes);
        return redirect()->back();
    }
}
