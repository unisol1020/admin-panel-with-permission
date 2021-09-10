<?php

namespace App\Traits;


use Illuminate\Http\Request;

trait PaginationTrait
{
    private $perPage = 15;

    public function __construct(Request $request)
    {
        $perPage = $request->get('per_page');

        if (!empty($perPage) && $perPage <= 100) {
            $this->perPage = $perPage;
        }
    }
}
