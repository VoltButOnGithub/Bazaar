<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Het :attribute veld moet geaccepteerd worden.',
    'accepted_if' => 'Het :attribute veld moet geaccepteerd worden wanneer :other :value is.',
    'active_url' => 'Het :attribute veld moet een geldige URL zijn.',
    'after' => 'Het :attribute veld moet een datum zijn na :date.',
    'after_or_equal' => 'Het :attribute veld moet een datum zijn na of gelijk aan :date.',
    'alpha' => 'Het :attribute veld mag alleen letters bevatten.',
    'alpha_dash' => 'Het :attribute veld mag alleen letters, nummers, streepjes en underscores bevatten.',
    'alpha_num' => 'Het :attribute veld mag alleen letters en nummers bevatten.',
    'array' => 'Het :attribute veld moet een array zijn.',
    'ascii' => 'Het :attribute veld mag alleen enkelbyte alfanumerieke tekens en symbolen bevatten.',
    'before' => 'Het :attribute veld moet een datum zijn voor :date.',
    'before_or_equal' => 'Het :attribute veld moet een datum zijn voor of gelijk aan :date.',
    'between' => [
        'array' => 'Het :attribute veld moet tussen :min en :max items bevatten.',
        'file' => 'Het :attribute veld moet tussen :min en :max kilobytes zijn.',
        'numeric' => 'Het :attribute veld moet tussen :min en :max liggen.',
        'string' => 'Het :attribute veld moet tussen :min en :max karakters zijn.',
    ],
    'boolean' => 'Het :attribute veld moet waar of onwaar zijn.',
    'can' => 'Het :attribute veld bevat een ongeautoriseerde waarde.',
    'confirmed' => 'De bevestiging van het :attribute veld komt niet overeen.',
    'current_password' => 'Het wachtwoord is onjuist.',
    'date' => 'Het :attribute veld moet een geldige datum zijn.',
    'date_equals' => 'Het :attribute veld moet een datum zijn gelijk aan :date.',
    'date_format' => 'Het :attribute veld moet overeenkomen met het formaat :format.',
    'decimal' => 'Het :attribute veld moet :decimal decimalen hebben.',
    'declined' => 'Het :attribute veld moet afgewezen worden.',
    'declined_if' => 'Het :attribute veld moet afgewezen worden wanneer :other :value is.',
    'different' => 'Het :attribute veld en :other moeten verschillend zijn.',
    'digits' => 'Het :attribute veld moet :digits cijfers zijn.',
    'digits_between' => 'Het :attribute veld moet tussen :min en :max cijfers zijn.',
    'dimensions' => 'Het :attribute veld heeft ongeldige afbeeldingsdimensies.',
    'distinct' => 'Het :attribute veld heeft een dubbele waarde.',
    'doesnt_end_with' => 'Het :attribute veld mag niet eindigen met een van de volgende: :values.',
    'doesnt_start_with' => 'Het :attribute veld mag niet beginnen met een van de volgende: :values.',
    'email' => 'Het :attribute veld moet een geldig e-mailadres zijn.',
    'ends_with' => 'Het :attribute veld moet eindigen met een van de volgende: :values.',
    'enum' => 'De geselecteerde :attribute is ongeldig.',
    'exists' => 'De geselecteerde :attribute is ongeldig.',
    'extensions' => 'Het :attribute veld moet een van de volgende extensies hebben: :values.',
    'file' => 'Het :attribute veld moet een bestand zijn.',
    'filled' => 'Het :attribute veld moet een waarde hebben.',
    'gt' => [
        'array' => 'Het :attribute veld moet meer dan :value items bevatten.',
        'file' => 'Het :attribute veld moet groter zijn dan :value kilobytes.',
        'numeric' => 'Het :attribute veld moet groter zijn dan :value.',
        'string' => 'Het :attribute veld moet groter zijn dan :value karakters.',
    ],
    'gte' => [
        'array' => 'Het :attribute veld moet :value items of meer bevatten.',
        'file' => 'Het :attribute veld moet groter zijn dan of gelijk aan :value kilobytes.',
        'numeric' => 'Het :attribute veld moet groter zijn dan of gelijk aan :value.',
        'string' => 'Het :attribute veld moet groter zijn dan of gelijk aan :value karakters.',
    ],
    'hex_color' => 'Het :attribute veld moet een geldige hexadecimale kleur zijn.',
    'image' => 'Het :attribute veld moet een afbeelding zijn.',
    'in' => 'De geselecteerde :attribute is ongeldig.',
    'in_array' => 'Het :attribute veld moet bestaan in :other.',
    'integer' => 'Het :attribute veld moet een geheel getal zijn.',
    'ip' => 'Het :attribute veld moet een geldig IP-adres zijn.',
    'ipv4' => 'Het :attribute veld moet een geldig IPv4-adres zijn.',
    'ipv6' => 'Het :attribute veld moet een geldig IPv6-adres zijn.',
    'json' => 'Het :attribute veld moet een geldige JSON-string zijn.',
    'lowercase' => 'Het :attribute veld moet in kleine letters zijn.',
    'lt' => [
        'array' => 'Het :attribute veld moet minder dan :value items bevatten.',
        'file' => 'Het :attribute veld moet minder dan :value kilobytes zijn.',
        'numeric' => 'Het :attribute veld moet minder zijn dan :value.',
        'string' => 'Het :attribute veld moet minder dan :value karakters zijn.',
    ],
    'lte' => [
        'array' => 'Het :attribute veld mag niet meer dan :value items bevatten.',
        'file' => 'Het :attribute veld moet minder dan of gelijk aan :value kilobytes zijn.',
        'numeric' => 'Het :attribute veld moet minder dan of gelijk aan :value zijn.',
        'string' => 'Het :attribute veld moet minder dan of gelijk aan :value karakters zijn.',
    ],
    'mac_address' => 'Het :attribute veld moet een geldig MAC-adres zijn.',
    'max' => [
        'array' => 'Het :attribute veld mag niet meer dan :max items bevatten.',
        'file' => 'Het :attribute veld mag niet groter zijn dan :max kilobytes.',
        'numeric' => 'Het :attribute veld mag niet groter zijn dan :max.',
        'string' => 'Het :attribute veld mag niet groter zijn dan :max karakters.',
    ],
    'max_digits' => 'Het :attribute veld mag niet meer dan :max cijfers bevatten.',
    'mimes' => 'Het :attribute veld moet een bestand zijn van het type: :values.',
    'mimetypes' => 'Het :attribute veld moet een bestand zijn van het type: :values.',
    'min' => [
        'array' => 'Het :attribute veld moet ten minste :min items bevatten.',
        'file' => 'Het :attribute veld moet ten minste :min kilobytes zijn.',
        'numeric' => 'Het :attribute veld moet ten minste :min zijn.',
        'string' => 'Het :attribute veld moet ten minste :min karakters zijn.',
    ],
    'min_digits' => 'Het :attribute veld moet ten minste :min cijfers bevatten.',
    'missing' => 'Het :attribute veld moet ontbreken.',
    'missing_if' => 'Het :attribute veld moet ontbreken wanneer :other :value is.',
    'missing_unless' => 'Het :attribute veld moet ontbreken tenzij :other :value is.',
    'missing_with' => 'Het :attribute veld moet ontbreken wanneer :values aanwezig is.',
    'missing_with_all' => 'Het :attribute veld moet ontbreken wanneer :values aanwezig zijn.',
    'multiple_of' => 'Het :attribute veld moet een veelvoud van :value zijn.',
    'not_in' => 'De geselecteerde :attribute is ongeldig.',
    'not_regex' => 'Het :attribute veldformaat is ongeldig.',
    'numeric' => 'Het :attribute veld moet een nummer zijn.',
    'password' => [
        'letters' => 'Het :attribute veld moet ten minste één letter bevatten.',
        'mixed' => 'Het :attribute veld moet ten minste één hoofdletter en één kleine letter bevatten.',
        'numbers' => 'Het :attribute veld moet ten minste één nummer bevatten.',
        'symbols' => 'Het :attribute veld moet ten minste één symbool bevatten.',
        'uncompromised' => 'Het opgegeven :attribute is in een datalek gevonden. Kies een ander :attribute.',
    ],
    'present' => 'Het :attribute veld moet aanwezig zijn.',
    'present_if' => 'Het :attribute veld moet aanwezig zijn wanneer :other :value is.',
    'present_unless' => 'Het :attribute veld moet aanwezig zijn tenzij :other :value is.',
    'present_with' => 'Het :attribute veld moet aanwezig zijn wanneer :values aanwezig is.',
    'present_with_all' => 'Het :attribute veld moet aanwezig zijn wanneer :values aanwezig zijn.',
    'prohibited' => 'Het :attribute veld is verboden.',
    'prohibited_if' => 'Het :attribute veld is verboden wanneer :other :value is.',
    'prohibited_unless' => 'Het :attribute veld is verboden tenzij :other in :values is.',
    'prohibits' => 'Het :attribute veld verbiedt :other aanwezig te zijn.',
    'regex' => 'Het :attribute veldformaat is ongeldig.',
    'required' => 'Het :attribute veld is verplicht.',
    'required_array_keys' => 'Het :attribute veld moet invoer bevatten voor: :values.',
    'required_if' => 'Het :attribute veld is verplicht wanneer :other :value is.',
    'required_if_accepted' => 'Het :attribute veld is verplicht wanneer :other geaccepteerd is.',
    'required_unless' => 'Het :attribute veld is verplicht tenzij :other in :values is.',
    'required_with' => 'Het :attribute veld is verplicht wanneer :values aanwezig is.',
    'required_with_all' => 'Het :attribute veld is verplicht wanneer :values aanwezig zijn.',
    'required_without' => 'Het :attribute veld is verplicht wanneer :values niet aanwezig is.',
    'required_without_all' => 'Het :attribute veld is verplicht wanneer geen van :values aanwezig zijn.',
    'same' => 'Het :attribute veld en :other moeten overeenkomen.',
    'size' => [
        'array' => 'Het :attribute veld moet :size items bevatten.',
        'file' => 'Het :attribute veld moet :size kilobytes zijn.',
        'numeric' => 'Het :attribute veld moet :size zijn.',
        'string' => 'Het :attribute veld moet :size karakters zijn.',
    ],
    'starts_with' => 'Het :attribute veld moet beginnen met een van de volgende: :values.',
    'string' => 'Het :attribute veld moet een string zijn.',
    'timezone' => 'Het :attribute veld moet een geldige tijdzone zijn.',
    'unique' => 'Het :attribute is al in gebruik.',
    'uploaded' => 'Het :attribute is niet geüpload.',
    'uppercase' => 'Het :attribute veld moet in hoofdletters zijn.',
    'url' => 'Het :attribute veld moet een geldige URL zijn.',
    'ulid' => 'Het :attribute veld moet een geldige ULID zijn.',
    'uuid' => 'Het :attribute veld moet een geldige UUID zijn.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'aangepast bericht',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
