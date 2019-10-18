<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappWebsitePlans2 extends Migration
{
    public function up()
    {
        Schema::table('siapp_website_plans', function($table)
        {
            $table->string('desciption', 2000)->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('siapp_website_plans', function($table)
        {
            $table->text('desciption')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
