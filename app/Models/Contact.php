<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Contact extends Model
{
    use HasFactory;
 
    protected $table = 'contacts';
 
    protected $fillable = [
        'title',
        'name',
        'phone',
        'ModifiedDate',
        'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}