<?php namespace Siapp\Website\Components;

use siapp\Website\Models\Video;
use Cms\Classes\ComponentBase;

class Videos extends ComponentBase
{
    public $videos;


    public function componentDetails()
    {
        return [
            'name' => 'Videos',
            'description' => 'Permite exibir uma listagem de vídeos no site',
        ];
    }

    public function onRun()
    {

        $this->videos = Video::all();
        
    }

}

?>