<?php

namespace App\Http\View\Composers;

use App\Banner;
use App\Section;
use Illuminate\View\View;

class FrontPageComposer
{
    private $frontBanners;
    private $frontSidebars;

    public function __construct()
    {
        $this->frontBanners = cache()->remember('frontBanners', 3600, function () {
            return Banner::where('status',1)->get();
        });

        $this->frontSidebars = cache()->remember('frontSidebars', 3600, function () {
            return Section::sections();
        });
    }

    public function compose(View $view)
    {
        $view->with([ 'frontBanners' => $this->frontBanners, 'frontSidebars' => $this->frontSidebars ]);
    }
}
