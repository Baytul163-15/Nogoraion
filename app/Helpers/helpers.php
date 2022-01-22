<?php

use Carbon\Carbon;
use Voerro\Laravel\VisitorTracker\Facades\VisitStats;
use Voerro\Laravel\VisitorTracker\Models\Visit;

if (!function_exists('test')) {
    function test()
    {


        return 'test successfully';
    }
}

if (!function_exists('get_cat_post')) {
    function get_cat_post(array $options = array())
    {

        $default = array(
            'slug' => null,
            'limit' => 6,
            'pagination' => 'No',
            'desc' => 'desc'
        );
        $cat_image = false;

        $new = array_merge($default, $options);

        if ($new['slug']) {
            $cat_info = App\Categorie::where('slug', $new['slug'])->first();
            $cat_image = $cat_info->cat_image;

            if ($cat_info) {
                $posts = App\Post::select('posts.*')
                    ->join('category_post', 'category_post.post_id', '=', 'posts.id')
                    ->where('category_post.category_id', $cat_info->id);
                $posts = $posts->orderBy('posts.id', $new['desc']);
                if ($new['pagination'] == 'No') {
                    $posts = $posts->take($new['limit'])->get();
                } else {
                    $posts = $posts->paginate($new['limit']);
                }
            } else {

                $posts = collect([]);
            }
        } else {
            $posts = collect([]);
        }

        $post_count = $posts->count();

        return ['data' => $posts, 'data_count' => $post_count, 'cat_image' => $cat_image];
    }
}


if (!function_exists('bndatetime')) {
    function bndatetime($str)
    {
        $time = strtotime($str);
        $str = date('d F Y, h:i a', $time);
        return en2bnSomeCommonString(bn2enNumber($str));
    }
}
if (!function_exists('bntime')) {
    function bntime($str)
    {
        $time = strtotime($str);
        $str = date('h:i a', $time);
        return en2bnSomeCommonString(bn2enNumber($str));
    }
}
if (!function_exists('bndate')) {
    function bndate($str = null)
    {
        if ($str) {
            $time = strtotime($str);
            $str = date('l, F d, Y', $time);
        } else {
            $str = date('l, F d, Y');
        }




        return en2bnSomeCommonString(bn2enNumber($str));
    }
}
if (!function_exists('en2bnSomeCommonString')) {
    function en2bnSomeCommonString($string)
    {
        $search_array = ['Female', 'Male', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'pm', 'am', 'Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
        $replace_array = ['মহিলা', 'পুরুষ', 'জানুয়ারী', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'পিএম', 'এএম', 'শনিবার', 'রোববার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার'];
        $en_number = str_replace($search_array, $replace_array, $string);
        return $en_number;
    }
}
if (!function_exists('bn2enNumber')) {
    function bn2enNumber($number)
    {
        $search_array = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', '-'];
        $replace_array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '-'];
        $en_number = str_replace($replace_array, $search_array, $number);
        return $en_number;
    }
}

if (!function_exists('year_part')) {
    function year_part($content)
    {
        if ($content == 'Monthly') {
            return 1;
        } elseif ($content == 'Quarterly') {
            return 3;
        } elseif ($content == 'Half Yearly') {
            return 6;
        } elseif ($content == 'Yearly') {
            return 12;
        } elseif ($content == '2 Yearly') {
            return 24;
        } elseif ($content == '5 Yearly') {
            return 24;
        } else {
            return false;
        }
    }
}


if (!function_exists('dictionary_data')) {
    function dictionary_data()
    {
        $data = [
            'Building' => 'ভবন',
            'Semi-tin Seed' => 'আধা টিন সেড',
            'Tin Seed' => 'টিন সেড',
            'Yes' => 'হ্যাঁ',
            'No' => 'না',
            'Active' => 'সক্রিয়',
            'Inactive' => 'নিষ্ক্রিয়',
            'Monthly' => 'মাসিক',
            'Yearly' => 'বাৎসরিক',
            1 => '১',
            2 => '২',
            3 => '৩',
            4 => '৪',
            5 => '৫',
            6 => '৬',
            7 => '৭',
            8 => '৮',
            9 => '৯',
            0 => '০',
            'one' => 'এক',
            'two' => 'দুই',
            'three' => 'তিন',
            'four' => 'চার',
            'five' => 'পাঁচ',
            'six' => 'ছয়',
            'seven' => 'সাত',
            'eight' => 'আট',
            'nine' => 'নয়',
            'ten' => 'দশ',
            'zero' => 'শূন্য',
            'hundred' => 'শত',
            'thousand' => 'হাজার',
            'Friday' => 'শুক্রবার',
            'Saturday' => 'শনিবার',
            'Sunday' => 'রবিবার',
            'Monday' => 'সোমবার',
            'Tuesday' => 'মঙ্গলবার',
            'Wednesday' => 'বুধবার',
            'Thursday' => 'বৃহস্পতিবার',
            'January' => 'জানুয়ারী',
            'February' => 'ফেব্রুয়ারি',
            'March' => 'মার্চ',
            'April' => 'এপ্রিল',
            'May' => 'মে',
            'June' => 'জুন',
            'July' => 'জুলাই',
            'August' => 'অগাস্ট',
            'September' => 'সেপ্টেম্বর',
            'October' => 'অক্টোবর',
            'November' => 'নভেম্বর',
            'December' => 'ডিসেম্বর',
            'Applied' => 'ফলিত',
            'On Review' => 'পর্যালোচনা',
            'Pending' => 'মুলতুবি',
            'Granted' => 'অনুমোদিত',
            'Correction' => 'সংশোধন',
            'Cancel' => 'বাতিল',
            'Bank draft' => 'পে অর্ডার / ব্যাংক ড্রাফট',
            'Bkash' => 'বিকাশ',
            'Nagat' => 'নগদ',
            'dollars' => 'টাকা',
            'Alfadanga' => 'আলফাডাঙ্গা',
            'Bhanga' => 'ভাঙ্গা',
            'Boalmari' => 'বোয়ালমারী',
            'Charbhadrasan' => 'চরভদ্রাসন',
            'Faridpur Sadar' => 'ফরিদপুর সদর',
            'Madukhali' => 'মধুখালী',
            'Nagarkanda' => 'নগরকান্দা',
            'Sadarpur' => 'সদরপুর',
            'Shriangan' => 'শারিঙ্গন',
            'New' => 'নতুন',
            'Renewal' => 'নবায়ন',
            'Renew' => 'নবায়ন',
            'Proprietorship' => 'প্রোপ্রিয়েটরশীপ',
            'Partnerships' => 'পার্টনারশীপ',
            'Private Ltd' => 'প্রাইভেট লিঃ',
            'Bridge' => 'পূর্ত ( নির্মাণ, সংস্কার, কায়িক  সেবা )',
            'Mechanical' => 'যান্ত্রিক',
            'Electrical' => 'ইলেক্ট্রিক্যাল',
            'Others' => 'অন্যান্য / বিবিধ',
            'Agriculture' => 'কৃষি',
            'Commercial' => 'বাণিজ্যিক',
            'Residential' => 'আবাসিক',
            'Other' => 'অন্যান্য',
            'Transfer' => 'হস্তান্তর',
            'Gangni' => 'গাংনী',
            'Mujibnagar' => 'মুজিবনগর',
            'Meherpur Sadar' => 'মেহেরপুর সদর',
            'Shotangsho' => ' শতাংশ',
            'Sq Feet' => ' বর্গফুট',
            'Latest News' => 'সর্বশেষ সংবাদ',
            'Read More' => 'বিস্তারিত',
            'All' => 'সব',
            'Photo Gallery' => 'ফটো গ্যালারি',
            'Video Gallery' => 'ভিডিও গ্যালারি',
            'More Photo' => 'আরও ছবি',
            'Info' => 'তথ্য',
            'Facebook Page' => 'ফেসবুক পেজ',
            'E-Seba' => 'ই-সেবা',
            'Important Govt. Websites' => 'গুরুত্বপূর্ণ সরকারি ওয়েবসাইট',
            'List of Hot Line Number' => 'হটলাইন নম্বরের তালিকা',
            'Emergency hotline' => 'জরুরি হটলাইন'


        ];

        return $data;
    }
}

if (!function_exists('e_to_b')) {
    function e_to_b($data)
    {

        $dictionary_data = dictionary_data();
        $converted = strtr($data, $dictionary_data);
        return $converted;
    }
}
if (!function_exists('lv_lang')) {
    function lv_lang($data)
    {

        if (config('voyager.multilingual.default') == 'bn') {
            $dictionary_data = dictionary_data();
            $converted = strtr($data, $dictionary_data);
            return $converted;
        } else {
            return $data;
        }
    }
}
if (!function_exists('b_to_e')) {
    function b_to_e($data)
    {
        $dictionary_data = array_flip(dictionary_data());
        $converted = strtr($data, $dictionary_data);
        return $converted;
    }
}
if (!function_exists('lv_theme')) {
    function lv_theme()
    {
        if (setting('site.theme')) {
            return setting('site.theme');
        }
        return 'default';
    }
}



if (!function_exists('getvisitor')) {
    function getvisitor()
    {
        $visits24h = VisitStats::query()->visits()
            ->except(['ajax', 'bots'])
            ->period(Carbon::now()->subHours(24));

        //dd($visits24h);


        $visits24h = VisitStats::query()->visits()
            ->except(['ajax', 'bots'])
            ->period(Carbon::now()->subHours(24));

        $visits1w = VisitStats::query()->visits()
            ->except(['ajax', 'bots'])
            ->period(Carbon::now()->subDays(7));

        $visits1m = VisitStats::query()->visits()
            ->except(['ajax', 'bots'])
            ->period(Carbon::now()->subMonth(1));

        $visits1y = VisitStats::query()->visits()
            ->except(['ajax', 'bots'])
            ->period(Carbon::now()->subYears(1));

        return [


            'visits24h' => $visits24h->count(),
            'unique24h' => $visits24h->unique()->count(),

            'visits1w' => $visits1w->count(),
            'unique1w' => $visits1w->unique()->count(),

            'visits1m' => $visits1m->count(),
            'unique1m' => $visits1m->unique()->count(),

            'visits1y' => $visits1y->count(),
            'unique1y' => $visits1y->unique()->count(),

            'visitsTotal' => Visit::count(),
            'uniqueTotal' => VisitStats::query()->visits()->unique()->count(),
        ];
    }
}
