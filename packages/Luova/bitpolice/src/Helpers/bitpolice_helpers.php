<?php


use Luova\Bitpolice\Models\BitpoliceGroup;
use App\Post;

if (!function_exists('get_bitpolice_array')) {
    function get_bitpolice_array()
    {

        $datas =  BitpoliceGroup::where('is_active', 'Yes')->whereNull('parent')->get();
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
if (!function_exists('get_add_bitpolice_array')) {
    function get_add_bitpolice_array()
    {

        $datas =  BitpoliceGroup::where('is_active', 'Yes')->whereNull('parent')->get();
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
if (!function_exists('get_bitpolice_master_array')) {
    function get_bitpolice_master_array()
    {

        $datas =  BitpoliceGroup::where('is_active', 'Yes')->whereNull('parent')->get();
        $output = [];

        foreach ($datas as $key => $data) {
            $output[$data->id] = $data->name;
        }

        return $output;
    }
}

if (!function_exists('get_bitpolice_table')) {
    function get_bitpolice_table($data, $name)
    {   
        
        $heml = '<div class="single-pt postBody"><table class="table table-bordered"> <thead> <tr>';
        $heml .= ' <th>Bit No.</th>';
        $heml .= ' <th>Address</th>';
        $heml .= ' <th>Location</th>';
        $heml .= ' <th>Designation</th>';
        $heml .= ' <th>Name</th>';
        $heml .= ' <th>Mobile</th>';
        $heml .= ' <th>Photo </th>';
        $heml .= ' <th>Action </th>';
        $heml .= '</tr></thead>';
        $heml .= ' <tbody>';
        foreach ($data as $list) {
            $posts = Post::where('author_id', $list->user_id)->take(3)->get();
            $post_count = $posts->count();
            if ($post_count ==3) {
                $col_span = 4;
            }elseif($post_count ==2){
                $col_span = 5;
            }elseif($post_count ==1){
                $col_span = 6;
            }
            $heml .= ' <tr>';
            $heml .= ' <td style="vertical-align: middle" >' . $list->bit_name . '</td>';
            $heml .= ' <td style="vertical-align: middle" >' . $list->address . '</td>';
            $heml .= ' <td style="vertical-align: middle" >' . $list->location . '</td>';
            $heml .= ' <td style="vertical-align: middle" >' . $list->designation . '</td>';
            $heml .= ' <td style="vertical-align: middle">' . $list->name . '</td>';
            $heml .= ' <td style="vertical-align: middle">' . $list->mobile . '</td>';
            if ($list->photo) {
                $heml .= ' <td style="vertical-align: middle">
                <img src="' . asset('storage/' . $list->photo) . '" style="height:80px; width: auto">
                </td>';
            } else {
                $heml .= ' <td></td>';
            }
            $heml .= ' <td style="vertical-align: middle">
                        <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="viewBitpolicModel(' . $list->id . ')"> Details</a>
                    </td></tr><tr>';
            foreach ($posts as $post) {
                if($post->image){
                $heml .= '
                    <td style="background: #ddd;">
                        <a href="'. url('post/'. $post->slug) . '">
                            <img style="width:135px;height:95px;float:left;margin-right: 7px;" src="'.url('public/storage/'.$post->image).'">
                            '.$post->title . '
                        </a>
                    </td>
                    ';
                }else{
                    $heml .= '
                    <td style="background: #ddd;">
                        <a href="'. url('post/'. $post->slug) . '">
                        <img style="width:135px;height:95px;float:left;margin-right: 7px;" src="'.url('public/dist/img/nimage.jpg').'">
                            '.$post->title . '
                        </a>
                    </td>
                    ';
                } 
            }
            if($list->user_id){
                $heml .= '<td colspan="'.$col_span.'"></td><td><a class="btn btn-sm btn-success" href="'. url('post_author/'. $list->user_id) . '">Show All</a></td></tr>';
            }else{
                $heml .= '</tr>';
            }
        }

        $heml .= '</tbody></table></div>';
        return $heml;
    }
}
if (!function_exists('get_bitpolice_model')) {
    function get_bitpolice_model($list)
    {



        $heml = '<table class="table table-bordered"><tbody>';

        if ($list->photo) {
            $heml .= '<tr>  <td>Photo</td>  <td style="vertical-align: middle">
                        <img src="' . asset('storage/' . $list->photo) . '" style="height:120px; width: auto">
                        </td></tr>';
        }

        $heml .= ' <tr> 
                        <td>Bit No.	</td> 
                        <td>' . $list->bit_name . '</td>
                    </tr> ';
        $heml .= ' <tr> 
                        <td>Address</td> 
                        <td>' . $list->address . '</td>
                    </tr> ';
        $heml .= ' <tr> 
                        <td>Location</td> 
                        <td>' . $list->location . '</td>
                    </tr> ';
        $heml .= ' <tr> 
                        <td>Designation</td> 
                        <td>' . $list->designation . '</td>
                    </tr> ';
        $heml .= ' <tr> 
                        <td>Name</td> 
                        <td>' . $list->name . '</td>
                    </tr> ';
        $heml .= ' <tr> 
                        <td>Mobile</td> 
                        <td>' . $list->mobile . '</td>
                    </tr> ';
        $heml .= ' <tr> 
                        <td>Phone</td> 
                        <td>' . $list->phone . '</td>
                    </tr> ';
        $heml .= ' <tr> 
                        <td>Fax</td> 
                        <td>' . $list->fax . '</td>
                    </tr> ';
        $heml .= ' <tr> 
                        <td>Dmail</td> 
                        <td>' . $list->email . '</td>
                    </tr> ';

        $heml .= '</tbody></table>';
        $heml .= ' <div class="map"> ' . $list->map . '</div>';



        return $heml;
    }
}


if (!function_exists('get_bitpolice_menu')) {
    function get_bitpolice_menu($id, $name)
    {
        $html = '';


        $menu =  BitpoliceGroup::where('id', $id)->first();


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
