<?php

namespace App\Http\Controllers;

use App\Contracts\StorageContract;
use App\Http\Requests\UserRequest;
use App\Services\LinkGeneratorService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(
        protected LinkGeneratorService $generator,
        protected StorageContract      $storage,
        protected UserService          $service,
    )
    {
    }

    public function register(UserRequest $request): string
    {
        $user = $this->service->save($request->validated());
        $link = $this->generator->createLink();

        $this->storage->add($user->id, $link);

        Auth::login($user);

        return view('new_link_page', ['link' => $link]);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
}
