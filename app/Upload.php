<?php

namespace App;

use File;

class Upload
{
    public static function create_folder($sPath)
    {

        if (!File::exists($sPath)) {
            File::makeDirectory($sPath, 0777, true);
        }
    }
}
