<?php

namespace App\Http\Controllers;

use App\Menulist;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menulist::where('parent_id', '=', 0)->get();
        $allMenus = Menulist::pluck('title','id')->all();
        return view('menu.menuTreeview',compact('menus','allMenus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        Menulist::create($input);
        return back()->with('success', 'Menu added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $menus = Menulist::where('parent_id', '=', 0)->get();
        return view('menu.dynamicMenu',compact('menus'));
    }
    public function edit(Menulist $menu)
    {
        $menus = Menulist::where('parent_id', '=', 0)->get();
        $allMenus = Menulist::pluck('title','id')->all();
        return view('menu.edit', compact('menu','menus','allMenus'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   

        $request->validate([
            'title' => 'required',
        ]);
        $input = $request->except(['_token']);
        $input['parent_id'] = intval($input['parent_id']);

        Menulist::whereId($id)->update($input);
    
        return redirect()->route('menus.index')->with('success', 'Menu updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $menu = Menulist::find($id);
        $menu->delete();

        return redirect()->route('menus.index')
                        ->with('success', 'Menu deleted successfully');
    }

}
