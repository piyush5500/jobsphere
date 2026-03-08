<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Job;
use App\Models\Application;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'resume',
        'is_active',
        'phone',
        'address',
        'bio',
        'skills',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the jobs posted by this user (if employer).
     */
    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id');
    }

    /**
     * Get the applications submitted by this user (if job seeker).
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is employer.
     */
    public function isEmployer()
    {
        return $this->role === 'employer';
    }

    /**
     * Check if user is job seeker.
     */
    public function isUser()
    {
        return $this->role === 'user';
    }

    /**
     * Check if user is employee (alias for employer).
     */
    public function isEmployee()
    {
        return $this->role === 'employer';
    }

    /**
     * Check if user is active.
     */
    public function isActive()
    {
        return $this->is_active === true;
    }

    /**
     * Suspend/pause the user.
     */
    public function suspend()
    {
        $this->is_active = false;
        $this->save();
    }

    /**
     * Activate the user.
     */
    public function activate()
    {
        $this->is_active = true;
        $this->save();
    }

    /**
     * Calculate profile completion percentage.
     */
    public function getProfileCompletionAttribute()
    {
        $fields = [
            'name' => !empty($this->name),
            'email' => !empty($this->email),
            'phone' => !empty($this->phone),
            'address' => !empty($this->address),
            'bio' => !empty($this->bio),
            'skills' => !empty($this->skills),
            'resume' => !empty($this->resume),
            'profile_photo' => !empty($this->profile_photo),
        ];

        $completed = count(array_filter($fields));
        $total = count($fields);

        return round(($completed / $total) * 100);
    }

    /**
     * Get profile completion items with their status.
     */
    public function getProfileCompletionItems()
    {
        return [
            'basic_info' => [
                'label' => 'Basic Information',
                'completed' => !empty($this->name) && !empty($this->email),
            ],
            'profile_photo' => [
                'label' => 'Profile Photo',
                'completed' => !empty($this->profile_photo),
            ],
            'contact_details' => [
                'label' => 'Contact Details',
                'completed' => !empty($this->phone) && !empty($this->address),
            ],
            'bio' => [
                'label' => 'Bio/About Me',
                'completed' => !empty($this->bio),
            ],
            'skills' => [
                'label' => 'Skills',
                'completed' => !empty($this->skills),
            ],
            'resume' => [
                'label' => 'Resume Upload',
                'completed' => !empty($this->resume),
            ],
        ];
    }
}
