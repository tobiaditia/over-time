<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Overtime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GeneralTest extends TestCase
{

    public function test_update_setting()
    {
        $response = $this->patch('/settings', [
            'key' => 'overtime_method',
            'value' => 1
        ]);

        $response->assertStatus(200);
    }

    public function test_post_employee()
    {
        $array = [
            'name' => 'Tobi Aditia Alfani Test General',
            'salary' => 2000000
        ];

        $response = $this->post('/employees', $array);

        $response->assertStatus(201);

        $this->__deleteEmployee($array);
    }

    public function test_post_overtime()
    {

        $arrayEmployee = [
            'name' => 'Tobi Aditia Test General',
            'salary' => 2000000
        ];

        $employee = Employee::create($arrayEmployee);

        $arrayOvertimes = [
            'employee_id' => $employee->id,
            'date' => '11-06-2022',
            'time_started' => '19:00',
            'time_ended' => '23:45'
        ];

        $response = $this->post('/overtimes', $arrayOvertimes);

        $response->assertStatus(201);

        $this->__deleteEmployee( $arrayEmployee);
        $this->__deleteOvertime($arrayOvertimes);
    }

    public function test_calculate_overtime()
    {
        $response = $this->get('/overtime-pays/calculate?month=2022-06');

        $response->assertStatus(200);
    }

    private function __deleteEmployee($array)
    {
        Employee::where($array)->delete();
    }

    private function __deleteOvertime($array)
    {
        Overtime::where($array)->delete();
    }
}
