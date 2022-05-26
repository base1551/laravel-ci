<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyLevel extends Model
{
    private $remainingCount;

    public function __construct(int $remainingCount)
    {
        $this->remainingCount = $remainingCount;
    }

    public function mark(): string
    {
        if ($this->remainingCount === 0) {
            return '×';
        }
        if ($this->remainingCount <= 4) {
            return '△';
        }
        return '◎';
    }

    /**
     * CSSのクラスとして使える文字列を出力
     */
    public function slug()
    {
        if ($this->remainingCount === 0) {
            return "empty";
        }
        if ($this->remainingCount <= 4) {
            return "few";
        }
        return "enough";
    }

    public function __toString()
    {
        return $this->mark();
    }
}
