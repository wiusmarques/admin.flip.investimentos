<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappWebsiteActivationCodes2 extends Migration
{
    public function up()
    {
        Schema::table('siapp_website_activation_codes', function($table)
        {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('siapp_website_activation_codes', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
