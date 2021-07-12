<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;

class ApiTokenController extends Controller
{
    protected $USER;
    /**
     * Update the authenticated user's API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function update(Request $request)
    {
        $token = Str::random(60);

        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return ['token' => $token];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkToken(Request $request)
    {
        $strToken = $request->input('token');
        $this->USER = User::where('api_token', '=', $strToken)
            ->where('bIsUsed', 1)
            ->where('bIsDel', 0)
            ->first();
    }
}
