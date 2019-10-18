<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSiappWebsitePlans extends Migration
{
    public function up()
    {
        Schema::create('siapp_website_plans', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255)->nullable();
            $table->string('desciption', 2000)->nullable();
            $table->string('short_description', 500)->nullable();
            $table->decimal('old_price', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('sort_order')->nullable();
            $table->dateTime('validate')->nullable();
            $table->boolean('active')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('siapp_website_plans');
    }
}
