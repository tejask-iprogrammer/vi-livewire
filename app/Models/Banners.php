<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Banners extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'banners';

    protected $fillable = [
        // 'banner_screen',
        // 'circle',
        // 'login_type',
        // 'socid',
        // 'socid_include_exclude',
        // 'device_os',
        // 'mrp',
        // "banner_title",
        // "banner_name",
        // "banner_rank",
        // "banner_title",
        "banner_screen",
        "circle",
        "login_type",
        "brand",
        "lob",
        "plan",
        "prepaid_persona",
        "postpaid_persona",
        "socid_include_exclude",
        "socid",
        "banner_title",
        "analytics_tag",
        "subtitle",
        "country",
        "red_hierarchy",
        "mrp",
        "tab_name",
        "internal_link",
        "external_link",
        "campaign_id",
        "cta_name",
        "start_date_time",
        "end_date_time",
        "device_os",
        "banner_text_content",
        "coupon_code",
        "validity_period",
        "avatar",
        "notified_banner",
        "app_version",
        "banner_rank",
        "status",
        "is_notified"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        // 'last_login_at' => 'datetime',
        // 'banner_screen'=>'array',
    ];

    // public function getProfilePhotoUrlAttribute()
    // {
    //     if ($this->profile_photo_path) {
    //         return asset('storage/' . $this->profile_photo_path);
    //     }

    //     return $this->profile_photo_path;
    // }

    // public function addresses()
    // {
    //     return $this->hasMany(Address::class);
    // }

    // public function getDefaultAddressAttribute()
    // {
    //     return $this->addresses?->first();
    // }
}
