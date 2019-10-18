<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappWebsiteActivationCodes extends Migration
{
    public function up()
    {
        Schema::table('siapp_website_activation_codes', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('valid_at');
        });
    }
    
    public function down()
    {
        Schema::table('siapp_website_activation_codes', function($table)
        {
            $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
            $table->dateTime('valid_at');
        });
    }
}
