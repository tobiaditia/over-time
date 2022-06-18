<?php

namespace App\Http\Resources;

use App\Models\Reference;
use App\Models\Setting;
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
        $overtime_duration_total = 0;
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
            $overtime_duration_total += $overtime_duration;
        }

        $setting = Setting::first();

        $referencesWhere = ['code' => $setting->key,'id'=>$setting->value];

        $amount = Reference::where($referencesWhere)->first();
        $salary = $this->salary;

        $total = eval('return '.$this->_convertToStrinPhpSyntax($amount->expression).';');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'salary' => $this->salary,
            'overtimes' => $overtimes,
            'overtime_duration_total ' => $overtime_duration_total,
            'amount ' => floor($total),
        ];
    }

    private function _convertToStrinPhpSyntax($string)
    {

        $string = str_replace('salary', '$salary', $string);
        return str_replace('overtime_duration_total', '$overtime_duration_total', $string);
    }
}
