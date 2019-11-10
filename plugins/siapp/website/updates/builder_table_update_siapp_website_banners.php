<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappWebsiteBanners extends Migration
{
    public function up()
    {
        Schema::table('siapp_website_banners', function($table)
        {
            $table->integer('sort_order')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('siapp_website_banners', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}
