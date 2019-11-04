<?php

namespace NeelBhanushali\LaravelApiResponder;

use Symfony\Component\HttpFoundation\Response;

class Responder
{
    public static function respond($data, $message, $httpStatusCode)
    {
        $status = [
            'code' => $httpStatusCode,
            'text' => Response::$statusTexts[$httpStatusCode],
            'type' => static::getStatusCategory($httpStatusCode)
        ];

        return response()->json(compact('data', 'message', 'status'), $httpStatusCode);
    }

    public static function success($data, $message = 'Success.', $httpStatusCode = 200)
    {
        return static::respond($data, $message, $httpStatusCode);
    }

    public static function getStatusCategory($httpStatusCode)
    {
        $category = null;
        switch ($httpStatusCode) {
            case $httpStatusCode < 200:
                $category = 'information';
                break;

            case $httpStatusCode >= 200 && $httpStatusCode < 300:
                $category = 'success';
                break;

            case $httpStatusCode >= 300 && $httpStatusCode < 400:
                $category = 'redirection';
                break;

            case $httpStatusCode >= 400:
                $category = 'error';
                break;
        }

        return $category;
    }
}
