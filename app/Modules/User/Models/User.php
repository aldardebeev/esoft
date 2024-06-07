<?php

namespace App\Modules\User\Models;

use App\Common\VO\EmailVO;
use App\Modules\Note\Models\Note;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


/**
 * @property int id
 * @property string email
 * @property string password
 * @property string name
 * @property string role
 *
 * @see User::scopeByEmail()
 * @method static self|Builder byEmail(EmailVO $emailVO)
 *
 * @see User::scopeIsAdmin()
 * @method static self|Builder isAdmin()
 *
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Сгенерировать имя по почте
     *
     * @param EmailVO $email
     * @return string
     */
    public static function getNameFromEmail(EmailVO $email): string
    {
        $posChar = strpos($email->getValue(), '@');
        return substr($email->getValue(), 0, $posChar);
    }

    public function scopeByEmail(Builder $query, EmailVO $email): Builder
    {
        return $query->where('email', '=', $email->getValue());
    }

    public function scopeIsAdmin(Builder $query): Builder
    {
        return $query->where('is_admin', '=', true);
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class, 'user_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRole(): string
    {
        return $this->role;
    }
}
