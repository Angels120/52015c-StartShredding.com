<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTemplate extends Model
{
    const NEXT_MONTH=1;
    const RANGE=2;
    const SINGlE_DATE=3;

    protected $fillable = ['name', 'client_id','vendor_id', 'name_for_sams','manager_id','job_type_id','repeat','days_allowed','days_apart','weeks_apart','months_apart','schedule_from','avg_service_time','is_active','special_notes','po_cro_no','payment_method','crated_at','updated_at'];


    public function setDaysAllowedAttribute($value)
    {
        $this->attributes['days_allowed'] = json_encode($value);
    }

    public function getDaysAllowedAttribute($value)
    {

       return $this->attributes['days_allowed'] = json_decode($value);
    }

    public function client()
    {
        return $this->hasOne('App\Clients','id','client_id');
    }

    public function daysAllowed(){

        if(!empty($this->attributes['days_allowed'])){
            $temp = [];
            $days = json_decode($this->attributes['days_allowed']);

            foreach ($days as $day){
                if ($day == 1) {
                    $temp[] = 'Monday';
                }if ($day == 2) {
                    $temp[] = 'Tuesday';
                }if ($day == 3) {
                    $temp[] = 'Wednesday';
                }if ($day == 4) {
                    $temp[] = 'Thursday';
                }if ($day == 5) {
                    $temp[] = 'Friday';
                }if ($day == 6) {
                    $temp[] = 'Saturday';
                }if ($day == 7) {
                    $temp[] = 'Sunday';
                }
            }
            return implode(",",$temp);
        }
        return '';
    }
}
