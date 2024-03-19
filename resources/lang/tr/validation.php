<?php

return [
    'required' => ':attribute alanı gereklidir.',
    'string' => ':attribute alanı bir metin olmalıdır.',
    'max' => [
        'string' => ':attribute alanı en fazla :max karakter olabilir.',
    ],
    'min' => [
        'string' => ':attribute alanı en az :min karakter olmalıdır.',
    ],
    'email' => ':attribute alanı geçerli bir e-posta adresi olmalıdır.',
    'unique' => ':attribute daha önce alınmış.',
    'url' => ':attribute alanı geçerli bir URL olmalıdır.',
    'date' => ':attribute alanı geçerli bir tarih olmalıdır.',
    'before_or_equal' => ':attribute alanı bugünden önce veya bugüne eşit bir tarih olmalıdır.',
    'confirmed' => ':attribute onayı eşleşmiyor.',
    'in' => ':attribute alanı aşağıdaki tiplerden biri olmalıdır: :values.',
    'array' => ':attribute alanı dizi olmalıdır.',
    'exists' => 'Seçilen :attribute geçersiz.',
];
