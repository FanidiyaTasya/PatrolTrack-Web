<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $checkInTime = $this->faker->time('H:i:s');
        $checkOutTime = $this->faker->time('H:i:s');
        $date = $this->faker->dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d');
        return [
            'shift_id' => $this->faker->numberBetween(1, 3),
            'guard_id' => $this->faker->numberBetween(1, 3),
            'date' => $date,
            'check_in_time' => $checkInTime,
            'check_out_time' => $checkOutTime,
            'status' => $this->faker->randomElement(['Hadir', 'Izin', null])
        ];
    }
}