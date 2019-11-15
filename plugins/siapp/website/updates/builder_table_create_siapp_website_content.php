<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSiappWebsiteContent extends Migration
{
    public function up()
    {
        Schema::create('siapp_website_content', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('type', 255)->nullable();
            $table->string('text', 1200)->nullable();
            $table->string('code', 255)->nullable();
            $table->string('section', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('url', 1200)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('siapp_website_content');
    }
}
