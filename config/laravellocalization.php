<?php
/*$translations = \App\Models\Translation::where(['status' => 1])->get();

$activeLanguages = [];
foreach ($translations as $translation) {
    $supportedLocales[] = [
        'name' => $translation['name'],
        'script' => 'Latn',
        'native' => strtoupper($translation['code']),
        'regional' => $translation['code'].'_'.strtoupper($translation['code'])
    ];
}*/
return [

     'supportedLocales' => [
        'az' => ['name' => 'Azerbaijani', 'script' => 'Latn', 'native' => 'AZ', 'regional' => 'az_AZ'],
        'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English'],
        'ru' => ['name' => 'Russian', 'script' => 'Cyrl', 'native' => 'RU', 'regional' => 'ru_RU'],
    ],

    'useAcceptLanguageHeader' => true,

    'hideDefaultLocaleInURL' => false,

    'localesOrder' => ['az','en','ru'],

    'localesMapping' => [],
    'utf8suffix' => env('LARAVELLOCALIZATION_UTF8SUFFIX', '.UTF-8'),

    'urlsIgnored' => ['/skipped'],
    'httpMethodsIgnored' => ['POST', 'PUT', 'PATCH', 'DELETE'],
];
