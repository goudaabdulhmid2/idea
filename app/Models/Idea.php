<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\IdeaStatus;
use Database\Factories\IdeaFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Idea extends Model
{
    /** @use HasFactory<IdeaFactory> */
    use HasFactory;

    protected $attributes = [
        'links' => '[]',
        'status' => IdeaStatus::PENDING->value,
    ];

    #[\Override]
    protected function casts(): array
    {
        return [
            'links' => AsArrayObject::class,
            'status' => IdeaStatus::class,
        ];
    }

    public static function statusCounts(User $user): Collection
    {
        $counts = $user
            ->ideas()
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $result = ['all' => $counts->sum()];

        foreach (IdeaStatus::cases() as $status) {
            $result[$status->value] = $counts->get($status->value, 0);
        }

        return collect($result);
    }

    public function scopeStatus($query, ?IdeaStatus $status)
    {
        return $query->when(
            $status,
            fn($q) => $q->where('status', $status->value)
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }
}
