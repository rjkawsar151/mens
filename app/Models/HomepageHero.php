<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageHero extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge_text',
        'main_title',
        'highlighted_title_text',
        'description',
        'primary_button_text',
        'primary_button_link',
        'secondary_button_1_text',
        'secondary_button_1_link',
        'secondary_button_2_text',
        'secondary_button_2_link',
        'happy_patients_number',
        'services_number',
        'years_of_excellence_number',
        'hero_image',
        'floating_rating_text',
        'floating_rating_label',
        'floating_service_card_title',
        'floating_service_card_subtitle',
        'floating_service_list',
        'status',
        'sort_order',
    ];

    public function getFloatingServicesAttribute(): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $this->floating_service_list))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
