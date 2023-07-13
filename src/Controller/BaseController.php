<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\Http\Request;

abstract class BaseController
{
    /**
     * @param Request $request
     */
    public function __construct(protected readonly Request $request)
    {
    }
}
