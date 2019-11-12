<?php namespace Siapp\Website\Components;

use siapp\Website\Models\Banner;
use Cms\Classes\ComponentBase;

class Banners extends ComponentBase
{
    public $banners;


    public function componentDetails()
    {
        return [
            'name' => 'Banners',
            'description' => 'Permite exibir uma listagem de banners do site',
        ];
    }

    public function onRun()
    {

        $this->banners = Banner::all();
        
        if ($this->property('bannerLocation')) {
            $locationID = $this->property('bannerLocation');
            $this->banners = Banner::where('location', $locationID)->get();
        }

        
    }

}

?>