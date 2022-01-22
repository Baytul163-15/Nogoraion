<?php

use Luova\Contactlist\Models\ContactMenu;

if (!function_exists('get_contactlist_array')) {
    function get_contactlist_array()
    {

        $datas =  ContactMenu::where('is_active', 'Yes')->whereNull('parent')->get();
        $output = [];

        foreach ($datas as $key => $data) {
            $output[$data->id] = $data->name;
            if ($data->children && $data->children->isNotEmpty()) {
                foreach ($data->children as $childer) {
                    $output[$childer->id] = ' -- ' . $childer->name;
                    if ($childer->children && $childer->children->isNotEmpty()) {
                        foreach ($childer->children as $child) {
                            $output[$child->id] = ' -- -- ' . $child->name;
                        }
                    }
                }
            }
        }

        return $output;
    }
}
if (!function_exists('get_add_contactlist_array')) {
    function get_add_contactlist_array()
    {

        $datas =  ContactMenu::where('is_active', 'Yes')->whereNull('parent')->get();
        $output = [];

        foreach ($datas as $key => $data) {
            $output[$data->id] = $data->name;
            if ($data->children && $data->children->isNotEmpty()) {
                foreach ($data->children as $childer) {
                    $output[$childer->id] = ' -- ' . $childer->name;
                }
            }
        }

        return $output;
    }
}
if (!function_exists('get_contactlist_master_array')) {
    function get_contactlist_master_array()
    {

        $datas =  ContactMenu::where('is_active', 'Yes')->whereNull('parent')->get();
        $output = [];

        foreach ($datas as $key => $data) {
            $output[$data->id] = $data->name;
        }

        return $output;
    }
}

if (!function_exists('get_data_to_table')) {
    function get_data_to_table($data, $name)
    {
        $heml = '<div class="single-pt postBody"><table class="table table-bordered"> <thead> <tr>';
        $heml .= ' <th>Designation</th>';
        $heml .= ' <th>Name</th>';
        $heml .= ' <th>Phone</th>';
        $heml .= ' <th>Mobile</th>';
        $heml .= ' <th>Fax</th>';
        $heml .= ' <th>E-mail </th>';
        $heml .= ' <th>Photo </th>';
        $heml .= '</tr></thead>';
        $heml .= ' <tbody>';
        foreach ($data as $list) {


            $heml .= ' <tr>';
            $heml .= ' <td style="vertical-align: middle" >' . $list->designation . '</td>';
            $heml .= ' <td style="vertical-align: middle">' . $list->name . '</td>';
            $heml .= ' <td style="vertical-align: middle">' . $list->phone . '</td>';
            $heml .= ' <td style="vertical-align: middle">' . $list->mobile . '</td>';
            $heml .= ' <td style="vertical-align: middle">' . $list->fax . '</th>';
            $heml .= ' <td style="vertical-align: middle">' . $list->email . '</td>';

            if ($list->photo) {
                $heml .= ' <td style="vertical-align: middle">
                <img src="' . asset('storage/' . $list->photo) . '" style="height:80px; width: auto">
                </td>';
            } else {
                $heml .= ' <td></td>';
            }


            $heml .= '</tr>';
        }

        $heml .= '</tbody></table></div>';
        return $heml;
    }
}
if (!function_exists('get_contactlist_menu')) {
    function get_contactlist_menu($id, $name)
    {
        $html = '';


        $menu =  ContactMenu::where('id', $id)->first();


        if ($menu) {

            $html .= '<select id="' . $name . '" class="form-control" name="' . $name . '">';
            $html .= '<option selected="selected" value="" disabled>--Select--</option>';
            foreach ($menu->children as $list) {
                $html .= '<option value="' . $list->id . '">' . $list->name . '</option>';
            }

            $html .= '</select>';
        }


        return $html;
    }
}
