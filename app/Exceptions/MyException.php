<?php

namespace App\Exceptions;

use Exception;

class MyException extends Exception
{


    public function context() {

        return [ 'title' => 'Nasfasdfgvazsdfgv',
            'detail' => 'adsvzdcfvzdf '
        ];
    }

    public function render() {
        response()->json([
            'title' => 'asdfvzdfvszdf',
            'detail' => 'I222222222222nded. '
        ], 404);
    }

}
