<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FilterRules implements ValidationRule
{
    protected $forbbiden = [];
    public function __construct(array $forbbiden)
    {
        $this->forbbiden = $forbbiden;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(in_array(strtolower($value),$this->forbbiden))
            $fail('this name is forbidden!');

    }
}
