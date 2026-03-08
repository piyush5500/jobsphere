<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'location',
        'salary',
        'job_type',
        'application_deadline',
        'is_active',
    ];

    /**
     * Check if the job is accepting applications.
     * Returns true if:
     * - The job is active
     * - No deadline is set, OR deadline has not passed
     */
    public function isApplicationOpen(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if (is_null($this->application_deadline)) {
            return true;
        }

        return Carbon::parse($this->application_deadline)->isFuture();
    }

    /**
     * Get the employer that owns the job.
     */
    public function employer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    /**
     * Get the applications for the job.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
