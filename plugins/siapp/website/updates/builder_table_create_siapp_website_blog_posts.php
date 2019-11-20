<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSiappWebsiteBlogPosts extends Migration
{
    public function up()
    {
        Schema::create('siapp_website_blog_posts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('categoty_id')->unsigned();
            $table->string('title', 255);
            $table->string('short_description', 255);
            $table->text('content');
            $table->boolean('status');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->text('keywords');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('siapp_website_blog_posts');
    }
}
