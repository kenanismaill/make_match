<?php

return [
    'required' => 'The :attribute field is required.',
    'string' => 'The :attribute must be a string.',
    'max' => [
        'string' => 'The :attribute may not be greater than :max characters.',
    ],
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'email' => 'The :attribute must be a valid email address.',
    'unique' => 'The :attribute has already been taken.',
    'url' => 'The :attribute must be a valid URL.',
    'date' => 'The :attribute must be a valid date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to today.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'in' => 'The :attribute must be one of the following types: :values.',
    'array' => 'The :attribute must be an array.',
    'exists' => 'The selected :attribute is invalid.',
];
