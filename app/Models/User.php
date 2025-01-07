<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;


    public function canAccessPanel(Panel $panel): bool
    {
        // fillament alt
        // return $this->can("viewAdminPanel", User::class);
        // return $this->can("view-admin-panel", User::class);
        return $this->isAdmin() || $this->isEditor();
    }
    public function isAdmin()
    {
        return $this->role->value === UserRoles::ADMIN->value;
    }
    public function isEditor()
    {
        return $this->role->value === UserRoles::EDITOR->value;
    }

    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => UserRoles::class,
    ];
    protected $appends = [
        'profile_photo_url',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function likes()
    {
        return $this->belongsToMany(Post::class, "post_like")->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function hasLiked(Post $post)
    {
        return $this->likes()->where("post_id", $post->id)->exists();
    }
}
