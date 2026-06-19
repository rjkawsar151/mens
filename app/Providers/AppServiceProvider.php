<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        try {
            if (! Schema::hasTable('website_settings')) {
                return;
            }

            $websiteSettings = \App\Models\WebsiteSetting::first();
            $footerSettings = \App\Models\FooterSetting::first();

            $headerMenus = \App\Models\Menu::where('menu_group', 'header')->where('status', 'active')->orderBy('sort_order')->get();
            $discoverMenus = \App\Models\Menu::where('menu_group', 'discover_us')->where('status', 'active')->orderBy('sort_order')->get();
            $usefulMenus = \App\Models\Menu::where('menu_group', 'useful_links')->where('status', 'active')->orderBy('sort_order')->get();
            $footerServices = \App\Models\Menu::where('menu_group', 'our_services')->where('status', 'active')->orderBy('sort_order')->get();
            $sidebarServices = \App\Models\Service::where('show_in_sidebar', true)->where('status', 'active')->orderBy('sort_order')->get();

            View::share(compact(
                'websiteSettings',
                'footerSettings',
                'headerMenus',
                'discoverMenus',
                'usefulMenus',
                'footerServices',
                'sidebarServices'
            ));

            // Configure mailer from database settings if SMTP is configured
            if ($websiteSettings && $websiteSettings->smtp_host) {
                Config::set('mail.mailers.smtp.host', $websiteSettings->smtp_host);
                Config::set('mail.mailers.smtp.port', $websiteSettings->smtp_port ?? '587');
                Config::set('mail.mailers.smtp.username', $websiteSettings->smtp_username);
                Config::set('mail.mailers.smtp.password', $websiteSettings->smtp_password);
                Config::set('mail.mailers.smtp.encryption', $websiteSettings->smtp_encryption ?? 'tls');
                Config::set('mail.from.address', $websiteSettings->smtp_mail_to ?? 'info@mayfair.com.bd');
                Config::set('mail.from.name', $websiteSettings->site_name ?? 'Mayfair Wellness Clinic');
            }
        } catch (\Throwable $e) {
            // Allow Artisan commands and setup pages to run before the database is available.
        }
    }
}
