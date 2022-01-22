<?php

namespace Luova\Widget\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use File;
use Luova\Widget\Models\WidgetDetail;
use Luova\Widget\Models\WidgetGroup;

class WidgetController extends Controller
{

    public function __construct()
    {
        // $this->middleware('outlet');
    }

    public function index(Request $request)
    {
        $mdata =  WidgetDetail::where('is_active', 'Yes')->get();

        return view('widget::index')->with(['fdata' => null, 'mdata' => $mdata]);

        // return 'lvwidget';
    }

    public function unit_contact(Request $request)
    {

        return view('widget::frontend.unit_contact')->with(['mdata' => null]);
    }

    public function group(Request $request)
    {
        $mdata =  WidgetGroup::where('is_active', 'Yes')->get();

        return view('widget::menu_add')->with(['fdata' => null, 'mdata' => $mdata]);
    }
    public function edit_group(Request $request, $id)
    {
        $fdata =   WidgetGroup::findOrFail($id);

        $mdata =  WidgetGroup::where('is_active', 'Yes')->whereNull('parent')->get();

        return view('widget::menu_add')->with(['fdata' => $fdata, 'mdata' => $mdata]);
    }

    public function add()
    {
        $id = null;

        return view('widget::add')->with(['fdata' => null, 'mdata' => null, 'id' => $id]);
    }


    public function edit($id)
    {
        $fdata =   WidgetDetail::findOrFail($id);

        $id = $fdata->id;


        return view('widget::add')->with(['fdata' => $fdata, 'mdata' => null, 'id' => $id]);
    }

    public function delete($id)
    {
        $fdata = WidgetDetail::find($id);
        // dd($fdata);

        $fdata->delete();

        return redirect()->route('lvwidget.index')->with('success', 'Successfully Delete');
    }
    public function group_delete($id)
    {
        $fdata = WidgetGroup::find($id);

        $fdata->delete();

        return redirect()->route('lvwidget.group.index')->with('success', 'Successfully Delete');
    }

    public function store(Request $request)
    {
        $id = $request->get('id');
        $existing = null;

        if ($id) {
            $existing =  WidgetDetail::findOrFail($id);
        }

        if ($existing) {
            if ($request->file('photo')) {
                $photo = $this->uploadImage($request);
            } else {
                $photo = $existing->photo;
            }
        } else {
            $photo = $this->uploadImage($request);
        }



        $attributes = [

            'titel' => $request->get('titel'),
            'title_visible' => ($request->title_visible) ? $request->title_visible : 'Yes',
            'group_id' => $request->get('group_id'),
            'type' => $request->get('type'),
            'type_id' => $request->get('type_id'),
            'type_slug' => $request->get('type_slug'),
            'description' => $request->get('description'),
            'listing' => ($request->listing) ? json_encode($request->listing) : null,
            'images' => $request->get('images'),
            'photo' => $photo,
            'link' => $request->get('link'),
            'class' => $request->get('class'),

            'is_active' => $request->get('is_active'),
            'remarks' => $request->get('remarks'),
            'sort_by' => $request->get('sort_by'),
            'is_active' => ($request->is_active) ? $request->is_active : 'Yes',
            'modified_by' => auth()->user()->id,

        ];

        if (!$id) {
            $attributes['create_by']  = auth()->user()->id;
        }
        // dd($attributes);




        try {

            if ($id) {

                $data =  WidgetDetail::where('id', $id)->update($attributes);
                return redirect()->route('lvwidget.index')->with('success', 'Successfully save changed');
            } else {
                $data =  WidgetDetail::create($attributes);
                return redirect()->route('lvwidget.edit', $data->id)->with('success', 'Successfully save changed');
            }
        } catch (\Illuminate\Database\QueryException $ex) {

            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function copy($id)
    {
        $fdata =   WidgetDetail::findOrFail($id);

        $attributes = [

            'titel' => $fdata->titel,
            'title_visible' => $fdata->title_visible,
            'group_id' => $fdata->group_id,
            'type' => $fdata->type,
            'type_id' => $fdata->type_id,
            'type_slug' => $fdata->type_slug,
            'description' => $fdata->description,
            'listing' => $fdata->listing,
            'images' => null,
            'photo' => null,
            'link' => $fdata->link,
            'class' => $fdata->class,

            'is_active' => $fdata->is_active,
            'remarks' => $fdata->remarks,
            'sort_by' => $fdata->sort_by,
            'is_active' => $fdata->is_active,
            'modified_by' => auth()->user()->id,
            'create_by' => auth()->user()->id,

        ];


        try {


            $data =  WidgetDetail::create($attributes);
            return redirect()->route('lvwidget.index', $data->id)->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {

            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function store_group(Request $request)
    {
        $id = $request->get('id');
        // store
        $attributes = [
            'titel' => $request->get('titel'),

            'is_active' => $request->get('is_active'),

            'remarks' => $request->get('remarks'),
            'sort_by' => $request->get('sort_by'),
            'is_active' => $request->get('is_active'),
            'modified_by' => auth()->user()->id,

        ];

        if (!$id) {
            $attributes['create_by']  = auth()->user()->id;
        }
        //  dd($attributes);




        try {

            if ($id) {

                $data =  WidgetGroup::where('id', $id)->update($attributes);
            } else {
                WidgetGroup::create($attributes);
            }


            return redirect()->route('lvwidget.group.index')->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {

            return redirect()->back()->withErrors($ex->getMessage());
        }
    }



    public function uploadImage($request)
    {
        if ($request->file('photo')) {

            $file = $request->file('photo');
            // generate a new filename. getClientOriginalExtension() for the file extension
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $folder = date('FY');
            // save to storage/app/public/lvwidget/MonthYear as the new $filename
            $url = 'lvwidget/' . $folder . '/' . $filename;
            $path = $file->storeAs('public/lvwidget/' . $folder, $filename);
            return $url;
        }
        return null;
    }
    public function photodetele(Request $request, $id)
    {
        $data = WidgetDetail::findOrFail($id);
        //dd(storage_path('app/public/' . $data->photo));
        $file_path = 'app/public/' . $data->photo;
        if (File::exists($file_path)) {
            unlink(storage_path($file_path));
        }


        $attributes = [
            'photo' => null,
            'modified_by' => auth()->user()->id,
        ];
        WidgetDetail::where('id', $id)->update($attributes);
        return redirect()->back();
    }


    public function ajax_rowitem(Request $request)
    {
        $html = null;
        if ($request->rows) {
            $html = view('widget::part.row')->with(['i' => $request->rows])->render();
        }
        return response()->json(['html' => $html]);
    }

    public function licence(Request $request)
    {
        return view('widget::licence');
    }
}
