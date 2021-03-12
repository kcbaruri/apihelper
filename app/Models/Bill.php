<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Bill extends Model
{
    use HasFactory;

    protected $table =  'monthly_bills';

    protected $fillable = 
        ['name',
        'tenant_id',
        'billing_month',
        'billing_year', 
        'created_by',
        'is_deleted'];

    public function setCreatorAttribute($value)
    {
    $this->attributes['created_by'] = auth()->id();
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function getBillMonthAtAttribute($value)
    {
        return Carbon::createFromDate($this->attributes['billing_month'])->format('Y-m');
    }

    public function getBillAtAttribute($value)
    {
        return Carbon::createFromDate($this->attributes['billing_month'])->format('M-Y');
    }

    public function singleItemSum()
    {
        $total = 0;
        foreach ($this->billable as $bill) {
            $total += $this->{$bill} ?? 0;
        }
        return $total;
    }
}
