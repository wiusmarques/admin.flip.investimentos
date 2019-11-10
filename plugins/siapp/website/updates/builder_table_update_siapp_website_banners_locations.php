<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappWebsiteBannersLocations extends Migration
{
    public function up()
    {
        Schema::table('siapp_website_banners_locations', function($table)
        {
            $table->increments('id')->change();
        });
    }
    
    public function down()
    {
        Schema::table('siapp_website_banners_locations', function($table)
        {
            $table->integer('id')->change();
        });
    }
}
