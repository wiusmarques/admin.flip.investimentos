<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappWebsiteBlogPosts2 extends Migration
{
    public function up()
    {
        Schema::table('siapp_website_blog_posts', function($table)
        {
            $table->string('slug', 255)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('siapp_website_blog_posts', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
