<?php

namespace App\Http\Controllers;

use \Illuminate\Http\RedirectResponse;

abstract class Controller
{
    protected function backWithError($errorBody): RedirectResponse {
        if (array_key_exists('errors', $errorBody)) {
            return back()
                ->withInput()
                ->withErrors($errorBody['errors']);
        } else {
            return $this->backWithUnknownError();
        }
    }

    protected function backWithUnknownError(): RedirectResponse {
        return back()
            ->withInput()
            ->withErrors(['error' => __('errors.unknown')]);
    }
}
