<?php

return [
    /** RegisterRequest */

    'required' => 'حقل :attribute مطلوب.',
    'string' => 'يجب أن يكون :attribute نصًا.',
    'max' => [
        'string' => 'لا يجب أن يتجاوز :attribute :max حرفًا.',
    ],
    'min' => [
        'string' => 'يجب أن يكون :attribute على الأقل :min حرفًا.',
    ],
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صالحًا.',
    'unique' => 'قيمة :attribute مستخدمة من قبل.',
    'url' => 'يجب أن يكون :attribute رابطًا صالحًا.',
    'date' => 'يجب أن يكون :attribute تاريخًا صالحًا.',
    'before_or_equal' => 'يجب أن يكون :attribute تاريخًا قبل أو يساوي اليوم.',
    'confirmed' => 'لا يتطابق تأكيد :attribute.',

    /** end RegisterRequest */
];
