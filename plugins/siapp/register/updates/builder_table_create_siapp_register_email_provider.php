<?php namespace siapp\Register\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSiappRegisterEmailProvider extends Migration
{
    public function up()
    {
        Schema::create('siapp_register_email_provider', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255);
            $table->string('key', 255);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('siapp_register_email_provider');
    }
}
