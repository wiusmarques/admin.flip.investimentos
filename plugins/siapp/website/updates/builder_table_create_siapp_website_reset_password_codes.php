<?php namespace siapp\Website\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSiappWebsiteResetPasswordCodes extends Migration
{
    public function up()
    {
        Schema::create('siapp_website_reset_password_codes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('hash', 32);
            $table->integer('user_id')->unsigned();
            $table->string('user_mail', 255);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->dateTime('valid_at')->nullable();
            $table->primary(['hash']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('siapp_website_reset_password_codes');
    }
}
