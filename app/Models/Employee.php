<?php

namespace App\Models;

use App\Casts\Address;
use App\Casts\BirthData;
use App\Casts\IdentityCard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'telephone',
        'identity_card',
        'address',
        'birth_data'
    ];
    
    protected $table = 'employees';

    protected $casts = [
        'address' => 'json',
        'birth_data' =>'json',
        'identity_card' => 'json'
    ];

    public function bosses(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_boss', 'employee_id', 'boss_id');
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_boss', 'boss_id', 'employee_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function setRole(string $role): void
    {
        $this->roles()->save(Role::where('name', $role)->firstOrFail());
    }

    public function setEmployee(Employee $employee): void
    {
        $this->employees()->save($employee);
    }

    public function setBoss(Employee $employee): void
    {
        $this->bosses()->save($employee);
    }
}
