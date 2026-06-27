<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Admin User
        DB::table('users')->insertOrIgnore([
            'name' => 'Mayfair Admin',
            'email' => 'admin@mayfair.com.bd',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Website Settings
        DB::table('website_settings')->insertOrIgnore([
            'id' => 1,
            'site_name' => "Mayfair Wellness Clinic",
            'logo' => null,
            'favicon' => null,
            'primary_color' => '#006F5C',
            'secondary_color' => '#CC205C',
            'appointment_button_text' => 'Appointment Now',
            'appointment_button_url' => '#booking-form',
            'whatsapp_number' => '+8801986660000',
            'smtp_mail_to' => 'info@mayfair.com.bd',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Footer Settings
        DB::table('footer_settings')->insertOrIgnore([
            'id' => 1,
            'logo' => null,
            'description' => 'Your trusted partner in comprehensive healthcare. Discover quality health to meet your needs.',
            'address' => 'MCC Building, Level 02, Road 127, Gulshan Avenue, Dhaka 1212.',
            'phone' => '+8801986-660000',
            'email' => 'info@mayfair.com.bd',
            'facebook_url' => 'https://facebook.com',
            'instagram_url' => 'https://instagram.com',
            'linkedin_url' => 'https://linkedin.com',
            'pinterest_url' => 'https://pinterest.com',
            'copyright_text' => 'Copyright © 2026 Mayfair. All rights reserved. | Crafted with care by Sinodtech Ltd.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Header Menus
        $headerMenus = [
            ['Home', '/'],
            ['Services', '/sI want to update the “Featured Medical Treatments” service cards section.

Current frontend section shows treatment/service cards with only text and “Learn More”. I want each service card to have an image.

Please inspect the project structure first, then implement this properly using the existing admin panel/service management flow.

Requirements:

1. Database
- Add a nullable image field for services/treatments.
- Use a clear column name like `image`, `image_path`, or match the existing project convention.
- Create a migration, do not edit old migrations.

2. Model
- Update the Service/Treatment model fillable fields.
- Make sure the image field can be saved and updated.

3. Admin Panel
- In the service create form, add an image upload input.
- In the service edit form, add an image upload input.
- Show current uploaded image preview on edit page.
- Add option to replace image.
- If service image is updated, delete the old image from storage.
- Image upload validation:
  - nullable on update
  - required or nullable on create depending on current service workflow
  - accepted types: jpg, jpeg, png, webp
  - max size: 2MB or project standard

4. Storage
- Store uploaded images in Laravel public disk, for example:
  `storage/app/public/services`
- Save only the relative path in database.
- Make sure image URL works with:
  `asset('storage/' . $service->image_path)`
- Do not store full domain URL in database.
- If needed, mention that `php artisan storage:link` must be run.

5. Controller
- Update service store method to handle image upload.
- Update service update method to handle image replacement.
- On delete, remove the uploaded image from storage if it exists.
- Keep existing fields and logic unchanged.

6. Frontend Service Cards
- Update the “Featured Medical Treatments” cards to display service image.
- Image should appear at the top of each card.
- Use clean medical-style UI.
- Keep existing card title/description and “Learn More” link.
- Image style:
  - full card width
  - fixed height around 180px desktop
  - object-fit: cover
  - rounded top corners matching card border radius
  - responsive for mobile
- Add fallback placeholder if image is missing.
- Use service title as image alt text.

7. Design
- Preserve the current layout: 3 cards per row on desktop, responsive on tablet/mobile.
- Do not break current spacing, border radius, shadow, or Learn More style.
- Keep the Mayfair clean white/green medical look.

8. Code Quality
- Follow existing naming conventions and folder structure.
- Do not rewrite unrelated parts.
- Avoid duplicate code.
- After changes, tell me:
  - which files were changed
  - what each change does
  - any commands I need to run

Expected commands may include:
php artisan migrate
php artisan storage:link
php artisan optimize:clearervices'],
            ['Our Specialists', 'https://mayfair.com.bd/our-physiotherapy-specialists/'],
            ['About Us', 'https://mayfair.com.bd/about-us'],
            ['Contact', 'https://mayfair.com.bd/contact']
        ];
        foreach ($headerMenus as $index => $item) {
            DB::table('menus')->insertOrIgnore([
                'menu_group' => 'header',
                'title' => $item[0],
                'url' => $item[1],
                'sort_order' => $index,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Discover Us Menus
        $discoverMenus = [
            ['Home', '/'],
            ['About Us', 'https://mayfair.com.bd/about-us'],
            ['Blogs', 'https://mayfair.com.bd/blogs'],
            ['Terms & Conditions', 'https://mayfair.com.bd/terms'],
            ['Shop', 'https://mayfair.com.bd/shop'],
            ['WishList', 'https://mayfair.com.bd/wishlist'],
            ['Cart', 'https://mayfair.com.bd/cart']
        ];
        foreach ($discoverMenus as $index => $item) {
            DB::table('menus')->insertOrIgnore([
                'menu_group' => 'discover_us',
                'title' => $item[0],
                'url' => $item[1],
                'sort_order' => $index,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Useful Links Menus
        $usefulMenus = [
            ['What we treat', 'https://mayfair.com.bd/what-we-treat'],
            ['Our Doctors', 'https://mayfair.com.bd/our-physiotherapy-specialists/'],
            ['All Services', '/services'],
            ['How we treat', 'https://mayfair.com.bd/how-we-treat'],
            ['Contact', 'https://mayfair.com.bd/contact'],
            ['Success Stories', 'https://mayfair.com.bd/success-stories'],
            ['Frequently Asked Questions', 'https://mayfair.com.bd/faqs']
        ];
        foreach ($usefulMenus as $index => $item) {
            DB::table('menus')->insertOrIgnore([
                'menu_group' => 'useful_links',
                'title' => $item[0],
                'url' => $item[1],
                'sort_order' => $index,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Our Services Menus
        $servicesMenus = [
            ['Physiotherapy', '/services/physiotherapy'],
            ['Urological Conditions', '/services/urological-conditions'],
            ['Shoulder Pain', '/services/shoulder-pain'],
            ['Neck Pain', '/services/neck-pain'],
            ["Men's Health", '/services/mens-health-physiotherapy']
        ];
        foreach ($servicesMenus as $index => $item) {
            DB::table('menus')->insertOrIgnore([
                'menu_group' => 'our_services',
                'title' => $item[0],
                'url' => $item[1],
                'sort_order' => $index,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 5. Sidebar Services & Main Services seeding
        $sidebarServices = [
            'Arthritis',
            'Back Pain and Sciatica',
            'Elbow, Wrist and Hand Pain',
            'Foot and Ankle Pain',
            'Hip and Knee Pain',
            'Neck Pain Relief',
            'Neurological Disorders',
            'Physiotherapy',
            'Pre and Post Surgical Rehab',
            'Regenerative Screening',
            'Shoulder Pain',
            'Sports Injuries',
            'Urological Conditions',
            "Men's Health",
            'Work Injuries'
        ];

        // Seed Men's Health Service first
        $mensHealthId = DB::table('services')->insertGetId([
            'title' => "Men's Health Physiotherapy",
            'slug' => "mens-health-physiotherapy",
            'short_description' => "Confidential physiotherapy support for pelvic health, urinary control, sexual wellness, and post-surgical recovery.",
            'main_description' => "Men's health physiotherapy focuses on pelvic floor function, urinary control, sexual wellness, chronic pelvic pain, and post-surgical recovery. At Mayfair Wellness Clinic, our approach is private, respectful, and evidence-informed, helping men improve comfort, confidence, and daily quality of life.",
            'hero_title' => "Men's Health",
            'hero_subtitle' => "Confidential Care For Men's Wellness",
            'hero_image' => null, // fallback in views
            'main_image' => null, // fallback in views
            'cause_title' => "Why Does This Problem Happen?",
            'cause_description' => "Men's pelvic and urological symptoms can happen due to pelvic floor weakness, muscle tightness, prostate-related concerns, post-surgical changes, stress, posture problems, or long sitting habits. These issues are common, but many men delay treatment because of embarrassment or lack of awareness.",
            'cause_image' => null,
            'treatment_title' => "How Mayfair Helps You Recover",
            'treatment_description' => "Mayfair Wellness Clinic provides private assessment, guided pelvic floor rehabilitation, manual therapy, pain management, exercise planning, and lifestyle guidance. Each treatment plan is personalized based on the patient’s symptoms, comfort level, and recovery goal.",
            'treatment_image' => null,
            'is_featured' => true,
            'show_in_sidebar' => true,
            'status' => 'active',
            'sort_order' => 14, // Matches place in index
            'seo_title' => "Men's Health Physiotherapy in Dhaka | Mayfair Wellness Clinic",
            'seo_description' => "Confidential men's health physiotherapy and urological condition support at Mayfair Wellness Clinic, Gulshan, Dhaka. Book your appointment today.",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed other services as placeholders
        foreach ($sidebarServices as $index => $title) {
            $slug = Str::slug($title);
            if ($slug === 'mens-health') {
                continue; // already seeded
            }
            DB::table('services')->insertOrIgnore([
                'title' => $title,
                'slug' => $slug,
                'short_description' => "Expert management for {$title} at Mayfair Wellness Clinic.",
                'main_description' => "At Mayfair Wellness Clinic, we offer advanced treatment protocols tailored for patients dealing with {$title}.",
                'hero_title' => $title,
                'hero_subtitle' => "Specialized Treatment Services",
                'is_featured' => false,
                'show_in_sidebar' => true,
                'status' => 'active',
                'sort_order' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 6. Seed Service Bullets for Men's Health
        $causeBullets = [
            "Pelvic floor muscle weakness or tightness",
            "Prostate-related inflammation or recovery needs",
            "Long sitting, poor posture, or physical stress",
            "Stress, anxiety, and nervous system sensitivity",
            "Post-surgical changes after prostate or pelvic surgery",
            "Chronic pain patterns around lower back, pelvis, or groin"
        ];
        foreach ($causeBullets as $idx => $bullet) {
            DB::table('service_bullets')->insert([
                'service_id' => $mensHealthId,
                'section_type' => 'cause',
                'bullet_text' => $bullet,
                'sort_order' => $idx,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $treatmentBullets = [
            "Private consultation and assessment",
            "Pelvic floor muscle training",
            "Pain relief and mobility exercises",
            "Posture and movement correction",
            "Post-surgery rehabilitation support",
            "Lifestyle and home exercise guidance",
            "Progress monitoring through follow-up sessions"
        ];
        foreach ($treatmentBullets as $idx => $bullet) {
            DB::table('service_bullets')->insert([
                'service_id' => $mensHealthId,
                'section_type' => 'treatment',
                'bullet_text' => $bullet,
                'sort_order' => $idx,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 7. Seed Steps for Men's Health
        $steps = [
            [
                'step_number' => 1,
                'title' => 'Get Consultation',
                'description' => 'Share your symptoms privately and get expert support.'
            ],
            [
                'step_number' => 2,
                'title' => 'Make Appointment',
                'description' => 'Choose your preferred time and book easily online.'
            ],
            [
                'step_number' => 3,
                'title' => 'Select Doctor',
                'description' => 'Meet a specialist for a personalized treatment plan.'
            ],
            [
                'step_number' => 4,
                'title' => 'Start Treatment',
                'description' => 'Follow your plan and track your recovery progress.'
            ]
        ];
        foreach ($steps as $idx => $step) {
            DB::table('service_steps')->insert([
                'service_id' => $mensHealthId,
                'step_number' => $step['step_number'],
                'title' => $step['title'],
                'description' => $step['description'],
                'image' => null,
                'sort_order' => $idx,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 8. Seed FAQs for Men's Health
        $faqs = [
            [
                'question' => "Is men's health physiotherapy private?",
                'answer' => "Yes. Mayfair provides confidential consultation and treatment support in a respectful clinical environment."
            ],
            [
                'question' => "What problems can men's health physiotherapy help with?",
                'answer' => "It may help with pelvic pain, urinary leakage, post-prostate surgery recovery, pelvic floor dysfunction, and related discomfort."
            ],
            [
                'question' => "Do I need a doctor referral?",
                'answer' => "In many cases, you can book directly. If your condition needs medical referral, the team will guide you after assessment."
            ],
            [
                'question' => "How long does recovery take?",
                'answer' => "Recovery depends on the condition, severity, lifestyle, and consistency with treatment and exercises."
            ]
        ];
        foreach ($faqs as $idx => $faq) {
            DB::table('faqs')->insert([
                'service_id' => $mensHealthId,
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'sort_order' => $idx,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
