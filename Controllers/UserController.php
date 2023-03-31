<?php
namespace App\Modules\TestTask\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TestTask\Model\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
    public function validation($data){
        return Validator::make($data->all(),
            [
                'name'              => 'required',
                'password'          => 'required',
                'email'             => 'required',
            ],
            [
                'name.required'     => 'Поле "Имя" обязательно!',
                'password.required' => 'Поле "Пароль" обязательно!',
                'email.required'    => 'Поле "Email" обязательно!',
            ]);

    }

    public function create(Request $request){
        $validation = self::validation($request);

        if($validation->fails()){
            return response()->json([
                'status'    => 'error',
                'message'   => implode('<br>', $validation->errors()->all()),
            ]);
        }

        DB::beginTransaction();
        try{
            $user = User::factory()->suspended($request)->state(['notes' => 'Для примера заменим на свое примечание'])->make();
            DB::commit();
            return response()->json(['status' => 'success', 'user_id' => $user->id]);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function list(Request $request){
        $sort   = $request->sort['name']  ? : 'id';
        $order  = $request->sort['order'] ? : 'desc';

        $limit  = is_integer($request->count) ? $request->count : 10;
        $offset = is_integer($request->page) ? $limit * ($request->page-1) : 0;

        $usersModel = User::orderBy($sort, $order);

        $total       = $usersModel->count();

        $usersModel = $usersModel->offset($offset)->limit($limit)->get();

        return response()->json(['status' => 'success', 'data' => ['users' => $usersModel, 'total' => $total]]);
    }
}
