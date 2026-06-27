<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->default('MENS HEALTH SERVICES');
            $table->string('main_title')->default("Confidential & Professional Mens Care");
            $table->string('highlighted_title_text')->nullable();
            $table->text('description');
            $table->string('primary_button_text')->default('Book Appointment');
            $table->string('primary_button_link')->default('#booking-form');
            $table->string('secondary_button_1_text')->default('Our Services');
            $table->string('secondary_button_1_link')->default('#services');
            $table->string('secondary_button_2_text')->default('Offers');
            $table->string('secondary_button_2_link')->default('#services');
            $table->string('happy_patients_number')->default('500+');
            $table->string('services_number')->default('100+');
            $table->string('years_of_excellence_number')->default('5+');
            $table->string('hero_image')->nullable();
            $table->string('floating_rating_text')->default('5.0 / 5');
            $table->string('floating_rating_label')->default('TOP RATED');
            $table->string('floating_service_card_title')->default('Mayfair Wellness Clinic');
            $table->string('floating_service_card_subtitle')->default('Premium Care');
            $table->text('floating_service_list')->nullable();
            $table->string('status')->default('active');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('homepage_heroes')->insert([
            'badge_text' => 'MENS HEALTH SERVICES',
            'main_title' => "Confidential & Professional Mens Care",
            'highlighted_title_text' => 'Mens Care',
            'description' => 'Mayfair Wellness Clinic provides specialized, respectful, and evidence-based physiotherapy for pelvic floor dysfunction, chronic pain, and post-surgery recovery.',
            'primary_button_text' => 'Book Appointment',
            'primary_button_link' => '#booking-form',
            'secondary_button_1_text' => 'Our Services',
            'secondary_button_1_link' => '#services',
            'secondary_button_2_text' => 'Offers',
            'secondary_button_2_link' => '#services',
            'happy_patients_number' => '3500+',
            'services_number' => '100+',
            'years_of_excellence_number' => '8+',
            'floating_rating_text' => '5.0 / 5',
            'floating_rating_label' => 'TOP RATED',
            'floating_service_card_title' => 'Mayfair Wellness Clinic',
            'floating_service_card_subtitle' => 'Premium Care',
            'floating_service_list' => "Focused Shockwave Therapy\nPelvic Floor Physiotherapy\nChronic Pain Management",
            'status' => 'active',
            'sort_order' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_heroes');
    }
};
