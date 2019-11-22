<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappWebsiteContent extends Migration
{
    public function up()
    {
        Schema::table('siapp_website_content', function($table)
        {
            $table->text('text')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('siapp_website_content', function($table)
        {
            $table->string('text', 1200)->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
