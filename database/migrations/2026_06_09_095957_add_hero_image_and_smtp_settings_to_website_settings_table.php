<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->string('hero_image')->nullable()->after('favicon');
            $table->string('smtp_host')->nullable()->after('smtp_mail_to');
            $table->string('smtp_port')->nullable()->after('smtp_host');
            $table->string('smtp_username')->nullable()->after('smtp_port');
            $table->string('smtp_password')->nullable()->after('smtp_username');
            $table->string('smtp_encryption')->nullable()->after('smtp_password');
            $table->text('notification_emails')->nullable()->after('smtp_encryption');
        });
    }

    public function down()
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image',
                'smtp_host',
                'smtp_port',
                'smtp_username',
                'smtp_password',
                'smtp_encryption',
                'notification_emails',
            ]);
        });
    }
};
