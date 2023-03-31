<?php

namespace App\Modules\TestTask\Factories;

use App\Modules\TestTask\Model\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**

 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function suspended($request){
        return $this->state(function (array $attributes) use ($request){
            return [
                'name'      => $request->name     ?: $attributes['name'],
                'password'  => $request->password ?: $attributes['password'],
                'email'     => $request->email    ?: $attributes['email'],
                'admin'     => $request->admin    ? 1 : $attributes['admin'],
                'birthday'  => $request->birthday ?: $attributes['birthday'],
                'address'   => $request->address  ?: $attributes['address'],
                'notes'     => $request->notes    ?: $attributes['notes'],
            ];
        });
    }

    public function configure(){
        return $this->afterMaking(function (User $user) {
            $user->save();
        })->afterCreating(function (User $user) {
            //
        });
    }

    public function definition(){
        return [
            'name'      => 'some body',
            'password'  => 'no password',
            'email'     => 'no email',
            'admin'     => 0,
            'birthday'  => null,
            'address'   => null,
            'notes'     => null,
        ];
    }
}
