<?php

use Luova\Contactlist\Models\ContactMenu;

if (!function_exists('lv_contact')) {
    function lv_contact()
    {
        return true;
    }
}
if (!function_exists('ToMailList')) {
    function ToMailList()
    {
        $datas = config('contact.contact-list');
        //dd($datas);
        $result = [];
        foreach ($datas as $list) {
            $result[$list['email']] = $list['name'];
        }

        return $result;
    }
}
