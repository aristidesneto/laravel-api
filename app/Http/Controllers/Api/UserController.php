<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Contracts\UserContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected UserContract $userService;

    public function __construct(UserContract $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->get('33');

        return response($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $user = $this->userService->get($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $updated = $user->update($request->all());

        if ($updated) {
            return response()->json([
                'status' => 'success',
                'message' => 'Usuário alterado com sucesso'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Erro para alterar o usuário'
        ], 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        $deleted = $user->delete();

        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Usuário removido com sucesso'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Erro para remover o usuário'
        ], 422);
    }
}
