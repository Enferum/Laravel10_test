<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class LinkGeneratorService
{
    public function createLink(): string
    {
        return URL::temporarySignedRoute(
            'secret_page',
            now()->addDays(7)
        );
    }

    public function checkExirationDate(string $link): bool
    {
        $request = Request::create($link);
        if (!$request->hasValidSignature()) {
            return false;
        }

        return true;
    }
}
