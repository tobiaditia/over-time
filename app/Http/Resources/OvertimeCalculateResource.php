<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class OvertimeCalculateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $overtimes_total = 0;
        $overtimes = [];
        foreach ($this->overtime as $overtime) {
            $overtime_duration = Carbon::parse($overtime->time_started)->diffInHours(Carbon::parse($overtime->time_ended));
            $overtimes[] = [
                'id' => $overtime->id,
                'date' => $overtime->date,
                'time_started' => $overtime->time_started,
                'time_ended' => $overtime->time_ended,
                'overtime_duration ' => $overtime_duration,
            ];
            $overtimes_total += $overtime_duration;
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'salary' => $this->salary,
            'overtimes' => $overtimes,
            'overtime_duration_total ' => $overtimes_total,
            'amount ' => $this->name,
        ];
    }
}
