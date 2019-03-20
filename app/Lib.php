<?php
namespace App;

use Carbon\Carbon;
use Image;

class Lib
{

    static function compress($path, $file, $name, $thum = false)
    {
        //initialize
        $img = Image::make($file);
        $height = $img->height();
        $width = $img->width();

        //xl file
        if ($height >= 620) {
            $xlheight = round((620 / $width) * $height, 0);
            $img->fit(620, $xlheight);
            $img->save($path . 'xl-' . $name);
        } else {
            $img->fit($width, $height);
            $img->save($path . 'xl-' . $name);
        }

        $mdheight = round((320 / $width) * $height, 0);
        $img->fit(320, $mdheight);
        $img->save($path . 'md-' . $name);

        //sm file
        $smallheight = round((110 / $width) * $height, 0);
        $img->fit(110, $smallheight);
        $img->save($path . 'sm-' . $name);

        //xs file
        if ($thum == true) {
            $img = Image::make($file);
            $img->fit(60);
            $img->save($path . 'xs-' . $name);
        }
    }

    static function convertdate($date)
    {
        setlocale(LC_ALL, 'IND');
        $carbon = Carbon::createFromFormat('Y-m-d', $date)->formatLocalized('%d %B %Y');
        echo $carbon;
    }

    static function gender($g)
    {
        $gender = ['Laki-Laki', 'Perempuan'];
        return $gender[$g];
    }

    static function status($s)
    {
        $status = ['Belum Kawin', 'Kawin'];
        return $status[$s];
    }

    static function agama($a)
    {
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Kong Hu Cu'];
        return $agama[$a];
    }
}
