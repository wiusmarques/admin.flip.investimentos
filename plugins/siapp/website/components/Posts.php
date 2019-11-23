<?php namespace Siapp\Website\Components;

use siapp\Website\Models\Post;
use Cms\Classes\ComponentBase;

class Posts extends ComponentBase
{
    public $posts;


    public function componentDetails()
    {
        return [
            'name' => 'Banners',
            'description' => 'Permite exibir uma listagem de banners do site',
        ];
    }

    public function onRun()
    {
        $this->posts = Post::all();
    }

}

?>