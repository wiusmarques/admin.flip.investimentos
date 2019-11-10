<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSiappWebsiteBannersLocations extends Migration
{
    public function up()
    {
        Schema::create('siapp_website_banners_locations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->string('name', 250);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->primary(['id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('siapp_website_banners_locations');
    }
}
