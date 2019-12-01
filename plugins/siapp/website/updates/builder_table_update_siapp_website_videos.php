<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappWebsiteVideos extends Migration
{
    public function up()
    {
        Schema::table('siapp_website_videos', function($table)
        {
            $table->dateTime('start_date')->nullable()->change();
            $table->dateTime('end_date')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('siapp_website_videos', function($table)
        {
            $table->dateTime('start_date')->nullable(false)->change();
            $table->dateTime('end_date')->nullable(false)->change();
        });
    }
}
