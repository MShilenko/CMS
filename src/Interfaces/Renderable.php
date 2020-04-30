<?php

namespace App\Interfaces;

interface Renderable
{
    /**
     * Connect the template and transfer data to it
     */
	public function render();
}