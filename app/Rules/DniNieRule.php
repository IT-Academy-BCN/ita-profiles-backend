<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DniNieRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!($this->isValidNif(strtoupper($value)) || $this->isValidNie(strtoupper($value)))) {
            $fail(__('No és un :Attribute vàlid'));
        }
    }

    /**
     * Return true if NIF is valid.
     */
    public function isValidNif($nif)
    {
        $nifRegEx = '/^[0-9]{8}[A-Z]$/i';
        $letters = 'TRWAGMYFPDXBNJZSQVHLCKE';

        if (preg_match($nifRegEx, $nif)) {
            return $letters[(substr($nif, 0, 8) % 23)] == $nif[8];
        }

        return false;
    }

    /**
     * Return true if NIE is valid.
     */
    public function isValidNie($nif)
    {
        $nieRegEx = '/^[KLMXYZ][0-9]{7}[A-Z]$/i';
        $letters = 'TRWAGMYFPDXBNJZSQVHLCKE';

        if (preg_match($nieRegEx, $nif)) {

            $r = str_replace(['X', 'Y', 'Z'], [0, 1, 2], $nif);

            return $letters[(substr($r, 0, 8) % 23)] == $nif[8];
        }

        return false;
    }
}
