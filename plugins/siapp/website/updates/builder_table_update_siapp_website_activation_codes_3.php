<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappWebsiteActivationCodes3 extends Migration
{
    public function up()
    {
        Schema::table('siapp_website_activation_codes', function($table)
        {
            $table->dateTime('valid_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('siapp_website_activation_codes', function($table)
        {
            $table->dropColumn('valid_at');
        });
    }
}
