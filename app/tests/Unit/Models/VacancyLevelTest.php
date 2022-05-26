<?php

namespace Tests\Unit\Models;

use App\Models\Models\VacancyLevel;
use PHPUnit\Framework\TestCase;

class VacancyLevelTest extends TestCase
{
    /**
     * @dataProvider dataMark
     */
    public function testMark(int $remainingCount, string $expectedMark)
    {
        $level = new VacancyLevel($remainingCount);
        $this->assertSame($expectedMark, $level->mark());
    }

    public function dataMark()
    {
        return [
            '空きなし' => [
                'remainingCount' => 0,
                'expectedMark' => '×',
            ],
            '残りわずか' => [
                'remainingCount' => 4,
                'expectedMark' => '△',
            ],
            '空き十分' => [
                'remainingCount' => 5,
                'expectedMark' => '◎',
            ],
        ];
    }

    public function testSlug()
    {
        $level = new VacancyLevel(0);
        $this->assertSame("empty", $level->slug());

        $level = new VacancyLevel(4);
        $this->assertSame("few", $level->slug());

        $level = new VacancyLevel(5);
        $this->assertSame("enough", $level->slug());
    }
}
