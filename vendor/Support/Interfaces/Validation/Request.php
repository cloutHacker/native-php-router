<?php

namespace Illuminate\Support\Interfaces\Validation;

interface Request {
    public function all();
    public function validate($source,array $request);
    public function hasErrors();
    public function errors();
}