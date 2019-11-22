<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappWebsiteBanners6 extends Migration
{
    public function up()
    {
        Schema::table('siapp_website_banners', function($table)
        {
            $table->string('title', 255)->nullable();
            $table->string('subtitle', 255)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('siapp_website_banners', function($table)
        {
            $table->dropColumn('title');
            $table->dropColumn('subtitle');
        });
    }
}
