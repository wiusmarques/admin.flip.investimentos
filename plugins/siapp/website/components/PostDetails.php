<?php namespace Siapp\Website\Components;

use siapp\Website\Models\Post;
use Cms\Classes\ComponentBase;

class PostDetails extends ComponentBase
{
    public $post = [];


    public function componentDetails()
    {
        return [
            'name' => 'Post Details',
            'description' => 'Permite exibir os detalhes de uma postagem',
        ];
    }

    public function onRun()
    {
        $slug = $this->param('slug');
        
        trace_log($slug);

        if(!empty($slug)){
            $this->post = Post::where('slug', $slug)->first();
        }
        trace_log($this->post);
    }

}

?>