<?php

namespace Illuminate\Support\Interfaces\Validation;

interface Request {
    public function all();
    public function validate($source, $request);
    public function hasErrors();
    public function errors();
}