<?php

use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RouterController
{
    public function __construct()
    {
    }

    public function index(Request $request): RedirectResponse
    {
        return new RedirectResponse('/platform');
    }
}
