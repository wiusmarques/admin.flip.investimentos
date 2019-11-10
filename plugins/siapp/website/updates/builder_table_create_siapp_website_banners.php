<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSiappWebsiteBanners extends Migration
{
    public function up()
    {
        Schema::create('siapp_website_banners', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('location_id');
            $table->string('name', 30)->nullable();
            $table->string('url', 255)->nullable();
            $table->boolean('status');
            $table->boolean('open_new_tab');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('siapp_website_banners');
    }
}
