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
        // 1. services
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->text('main_description')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('main_image')->nullable();
            $table->string('cause_title')->nullable();
            $table->text('cause_description')->nullable();
            $table->string('cause_image')->nullable();
            $table->string('treatment_title')->nullable();
            $table->text('treatment_description')->nullable();
            $table->string('treatment_image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('show_in_sidebar')->default(true);
            $table->string('status')->default('active');
            $table->integer('sort_order')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
        });

        // 2. service_bullets
        Schema::create('service_bullets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('section_type'); // condition, cause, treatment, benefit
            $table->text('bullet_text');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 3. service_steps
        Schema::create('service_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade');
            $table->integer('step_number');
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
        });

        // 4. faqs
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade');
            $table->text('question');
            $table->text('answer');
            $table->integer('sort_order')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
        });

        // 5. appointments
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->date('preferred_date');
            $table->string('preferred_time');
            $table->text('note')->nullable();
            $table->string('status')->default('pending'); // pending, contacted, confirmed, completed, cancelled
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });

        // 6. footer_settings
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('pinterest_url')->nullable();
            $table->string('copyright_text')->nullable();
            $table->timestamps();
        });

        // 7. website_settings
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default("Mayfair Wellness Clinic");
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('primary_color')->default('#006F5C');
            $table->string('secondary_color')->default('#CC205C');
            $table->string('appointment_button_text')->default('Appointment Now');
            $table->string('appointment_button_url')->default('#booking-form');
            $table->string('whatsapp_number')->nullable();
            $table->string('smtp_mail_to')->nullable();
            $table->timestamps();
        });

        // 8. menus
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_group'); // header, discover_us, useful_links, our_services
            $table->string('title');
            $table->string('url');
            $table->integer('sort_order')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
        Schema::dropIfExists('website_settings');
        Schema::dropIfExists('footer_settings');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('service_steps');
        Schema::dropIfExists('service_bullets');
        Schema::dropIfExists('services');
    }
};
