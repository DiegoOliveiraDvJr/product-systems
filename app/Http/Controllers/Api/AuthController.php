<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public $rules =  [
        'email' => 'required',
        'password' => 'required'
    ];

    protected $messages = [
        'email.required' => 'O Email é obrigatório.',
        'password.required' => 'A Senha é obrigatória.',
    ];

    // public function authenticate(Request $request)
    // {
    //     $validateUser = Validator::make($request->all(), $this->rules, $this->messages);

    //     if($validateUser->fails()){
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Erro na Validação',
    //             'errors' =>  $validateUser->errors()
    //         ], 401);
    //     }
 
    //     if (Auth::attempt($validateUser->validated())) {
    //         $request->session()->regenerate();
    //         $user = auth()->user();
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Autenticado com sucesso.',
    //             'data' => [
    //                 'user' => $user
    //             ]
    //         ]);
    //     }

    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'Dados de acesso incorretos',
    //         'erros' => []
    //     ], 401);

    // }
   
    /**
     * authenticate api
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {

        $validateUser = Validator::make($request->all(), $this->rules, $this->messages);

        if($validateUser->fails()){
            return $this->sendError('Unauthorised.', $validateUser->errors());
        }
 
        if (Auth::attempt($validateUser->validated())) {
            $request->session()->regenerate();
            $user = auth()->user();
            
            return $this->sendResponse($user, 'Autenticado com sucesso.');
        }
    }

    
}
