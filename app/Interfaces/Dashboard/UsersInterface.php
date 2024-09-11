<?php

namespace App\Interfaces\Dashboard;

interface UsersInterface
{
    public function edit();

    /**
     * Show the form for creating a new resource.
     */
    public function update($request);

    /**
     * Store a newly created resource in storage.
     */
    public function destroy($request);
}
