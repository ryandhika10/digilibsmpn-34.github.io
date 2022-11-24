<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use afrizalmy\BWI\BadWord;

class Badwords implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (Badword::cek($value)) {
            $fail('Pada :attribute mengandung kata kotor');
        }
    }
}
