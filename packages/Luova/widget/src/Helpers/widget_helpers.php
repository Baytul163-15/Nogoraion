<?php

use Luova\Widget\Models\WidgetDetail;
use Luova\Widget\Models\WidgetGroup;

if (!function_exists('getWidgetGroup_array')) {
    function getWidgetGroup_array()
    {

        $datas =  WidgetGroup::where('is_active', 'Yes')->get();
        $output = [];

        foreach ($datas as $key => $data) {
            $output[$data->id] = $data->titel;
        }

        return $output;
    }
}
if (!function_exists('getWidgetType')) {
    function getWidgetType()
    {

        $output = [
            'default' => 'Default',
            'listing' => 'Listing',
            'banner' => 'Banner',
            'function' => 'Function'

        ];
        // 'slider' => 'Slider',
        // 'single_image' => 'single image',
        // 'multiple_image' => 'multiple image'

        return $output;
    }
}
if (!function_exists('WidgetGroup')) {
    function WidgetGroup($id = null)
    {

        if ($id) {
            $datas =  WidgetGroup::where(['id' => $id, 'is_active' => 'Yes'])->first();
            if ($datas && $datas->children) {
                foreach ($datas->children as $children) {
                    WidgetSingle($children);
                }
            }
            return null;
        }
    }
}
if (!function_exists('GetWidgetSingle')) {
    function GetWidgetSingle($id = null)
    {

        if ($id) {
            $datas =  WidgetDetail::where(['id' => $id, 'is_active' => 'Yes'])->first();
            if ($datas) {

                WidgetSingle($datas);
            }
            return null;
        }

        return null;
    }
}
if (!function_exists('WidgetSingle')) {
    function WidgetSingle($data = null)
    {


        if ($data) {
            if ($data->type == 'default') {
                WidgetDefault($data);
            } elseif ($data->type == 'listing') {
                WidgetListing($data);
            } elseif ($data->type == 'banner') {
                WidgetBanner($data);
            } elseif ($data->type == 'function') {

                $name = $data->description;
                if (function_exists($name)) {
                    echo $name();
                }
            }
        }
        return null;
    }
}
if (!function_exists('WidgetDefault')) {
    function WidgetDefault($data = null)
    {
        if ($data) {
            $html = '';
            $html .= '<div class="lvw lvw-default ' . (($data->class) ? $data->class : '') . '">';
            if ($data->title_visible == 'Yes') {
                $html .= '<h2 class="lvw-title">' . $data->titel . '</h3>';
            }
            if ($data->photo) {
                $html .= '<div class="lvw-img"><img src="' . asset('storage/' . $data->photo) . '" alt=""></div>';
            }
            if ($data->description) {
                $html .= '<div class="lvw-description">' . $data->description . '</div>';
            }
            if ($data->link) {
                $html .= '<a class="lvw-link" href="' . $data->link . '">বিস্তারিত</a>';
            }

            $html .= '</div>';

            echo $html;
        }

        return null;
    }
}
if (!function_exists('WidgetBanner')) {
    function WidgetBanner($data = null)
    {
        if ($data) {
            $html = '';
            $html .= '<div class="lvw lvw-banner ' . (($data->class) ? $data->class : '') . '">';
            if ($data->title_visible == 'Yes') {
                $html .= '<h2 class="lvw-title">' . $data->titel . '</h3>';
            }
            if ($data->photo) {
                if ($data->link) {
                    $html .= '<a class="lvw-imglink"  href="' . $data->link . '" target="_blank">';
                }
                $html .= '<img src="' . asset('storage/' . $data->photo) . '" alt="">';
                if ($data->link) {
                    $html .= '</a>';
                }
            }
            if ($data->description) {
                $html .= '<div class="lvw-description">' . $data->description . '</div>';
            }

            $html .= '</div>';

            echo $html;
        }

        return null;
    }
}
if (!function_exists('WidgetListing')) {
    function WidgetListing($data = null)
    {
        if ($data) {
            $html = '';
            $html .= '<div class="lvw lvw-listing ' . (($data->class) ? $data->class : '') . '">';
            if ($data->title_visible == 'Yes') {
                $html .= '<h3 class="lvw-title">' . $data->titel . '</h3>';
            }
            if ($data->listing) {
                $lists = json_decode($data->listing, true);
                $html .= '<ul class="lvw-ul">';
                foreach ($lists as $list) {
                    $html .= '<li>';
                    $html .= '<a href="' . (($list['link']) ?  $list['link'] : '#') . '" ' . (($list['target']) ? 'target="' . $list['target'] . '"' : '') . '>';

                    $html .= '<span class="list-icone"><img src="' . asset('/frontend/img/list_icon.png') . '" /></span>';
                    $html .= $list['title'];

                    $html .= '</a>';
                    $html .= '</li>';
                }
                $html .= '</ul>';
            }
            $html .= '</div>';
            echo $html;
        }
        return null;
    }
}
