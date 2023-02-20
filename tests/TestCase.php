<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function companyData(): array
    {
        return [
            'businessName' => 'Azienda di test',
            'address' => 'Via le dita dal naso 5, 20123 Milano (MI)',
            'vat' =>  'XXXXXXXXXXX',
            'taxCode' => 'XXXXXXXXXXX',
            'employees' => 10,
            'active' => true,
            'type' => 1,
        ];
    }
}
