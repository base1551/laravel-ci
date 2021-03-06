<?php

namespace Tests\Unit\Models;

use App\Models\Models\Lesson;
use App\Models\User;
use Mockery;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    /**
     * @param string $plan
     * @param int $remainingCount
     * @param int $reservationCount
     * @param bool $canReserve
     * @dataProvider dataCanReserve
     */
    public function testCanReserve(string $plan, int $remainingCount, int $reservationCount, bool $canReserve)
    {
        /** @var User $user */
        $user = Mockery::mock(User::class)->makePartial();
        $user->shouldReceive('reservationCountThisMonth')->andReturn($reservationCount);
        $user->plan = $plan;

        /** @var Lesson $lesson */
        $lesson = Mockery::mock(Lesson::class);
        $lesson->shouldReceive('remainingCount')->andReturn($remainingCount);

        $this->assertSame($canReserve, $user->canReserve($lesson));
    }

    public function dataCanReserve() {
        return [
            '予約可:レギュラー,空きあり,月の上限以下' => [
                'plan' => 'regular',
                'totalReservationCount' => 1,
                'userReservationCount' => 4,
                'canReserve' => true,
            ],
            '予約不可:レギュラー,空きあり,月の上限' => [
                'plan' => 'regular',
                'totalReservationCount' => 1,
                'userReservationCount' => 5,
                'canReserve' => false,
            ],
            // 中略 残りのパターン
        ];
    }
}
