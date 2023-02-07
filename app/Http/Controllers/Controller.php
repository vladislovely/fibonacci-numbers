<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    private const STATUS_SUCCESS = 'success';

    final public function index(): string
    {
        return 'Welcome to microservice for calculation fibonacci numbers';
    }

    /**
     * Получаем срез или полный ряд цифр
     * Если не передать значения from and to, по умолчанию 0 и 1
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    final public function calculate(Request $request): JsonResponse
    {
        $this->validate($request, [
            'from' => 'integer|min:0|required',
            'to'   => 'integer|min:0|required',
        ]);

        $from = $request->integer('from');
        $to   = $request->integer('to');

        $response = new JsonResponse();

        $data = $this->getFibonacciRow();

        $result = [];

        foreach ($data as $key => $value) {
            if ($from <= $key && $to >= $key) {
                $result[] = $value;
            }
        }

        $response->setData([
            'message'                  => self::STATUS_SUCCESS,
            'set_of_numbers'           => $result,
            'source' => $data
        ]);

        return $response;
    }


    /**
     * Получаем полный ряд Фибоначчи, максимум длина 19 символов из-за ограничения int
     *
     * @return array
     */
    private function getFibonacciRow(): array
    {
        $key = 'fibonacci_row';

        $expiresAt = Carbon::now()->addYears(10);

        return Cache::remember($key, $expiresAt, static function () {
            $result = [];

            $result[1] = 0;
            $result[2] = 1;

            for ($i = 3; $i < 95; $i++) {
                $result[$i] = (int)bcadd($result[$i - 1], $result[$i - 2]);
            }

            return array_values($result);
        });
    }
}
