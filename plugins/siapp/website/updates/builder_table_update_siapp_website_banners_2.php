<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappWebsiteBanners2 extends Migration
{
    public function up()
    {
        Schema::table('siapp_website_banners', function($table)
        {
            $table->renameColumn('location_id', 'location');
        });
    }
    
    public function down()
    {
        Schema::table('siapp_website_banners', function($table)
        {
            $table->renameColumn('location', 'location_id');
        });
    }
}
