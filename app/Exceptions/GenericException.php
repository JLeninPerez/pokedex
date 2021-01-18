<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\View\View;

class GenericException extends Exception
{
    /**
     * GenericException constructor.
     * @param string $message
     */
    public function __construct(string $message = '')
    {
        $this->message = $message;
    }

    /**
     * @return View
     */
    public function render()
    {
        return view('not_found')->with(['message' => $this->message]);
    }
}
