<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;
    public function getVacancyLevelAttribute(): VacancyLevel
    {
        return new VacancyLevel($this->remainingCount());
    }

    private function remainingCount(): int
    {
        return $this->capacity - $this->reservations()->count();
    }

    /**
     * レッスンの持つ予約情報を返す
     * @return HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

}