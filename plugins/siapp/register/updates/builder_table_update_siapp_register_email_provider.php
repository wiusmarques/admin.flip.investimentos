<?php namespace siapp\Register\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSiappRegisterEmailProvider extends Migration
{
    public function up()
    {
        Schema::table('siapp_register_email_provider', function($table)
        {
            $table->boolean('active')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('siapp_register_email_provider', function($table)
        {
            $table->dropColumn('active');
        });
    }
}
