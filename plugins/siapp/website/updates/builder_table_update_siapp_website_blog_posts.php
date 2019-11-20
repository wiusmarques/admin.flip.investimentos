<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappWebsiteBlogPosts extends Migration
{
    public function up()
    {
        Schema::table('siapp_website_blog_posts', function($table)
        {
            $table->renameColumn('categoty_id', 'category_id');
        });
    }
    
    public function down()
    {
        Schema::table('siapp_website_blog_posts', function($table)
        {
            $table->renameColumn('category_id', 'categoty_id');
        });
    }
}
