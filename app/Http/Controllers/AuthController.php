<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiClient;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|max:16|confirmed',
            'password_confirmation' => 'required|string|min:6|max:16',
        ]);

        try {
            $response = $this->client->request('POST', 'registration', [
                'json' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'password_confirmation' => $request->password_confirmation,
                ],
            ]);
            $data = json_decode($response->getBody(), true);

            return $this->backWithError($response->getBody());

            $user = new \App\Models\User($data['user']);
            $user->access_token = $data['token'];
            Session::put('user', $user);
            
            return redirect()->route('weather.search');
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $errorBody = json_decode($response->getBody()->getContents(), true);
            
            return $this->backWithError($errorBody);
        } catch (\Exception $e) {
            return $this->backWithUnknownError();
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        try {
            $response = $this->client->request('POST', 'login', [
                'json' => [
                    'email' => $request->email,
                    'password' => $request->password,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            $user = new \App\Models\User($data['user']);
            $user->access_token = $data['token'];
            Session::put('user', $user);

            return redirect()->route('weather.search');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => __('auth.failed'),
                    'password' => __('auth.failed')
                ]);
        }
    }

    public function logout(Request $request)
    {
        try {          
            $this->client->request('POST', 'logout');

            Session::forget('user');

            return redirect()->route('home');
        } catch (\Exception $e) {
            return $this->backWithUnknownError();
        }
    }
}
