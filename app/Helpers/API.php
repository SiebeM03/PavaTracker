<?php

namespace App\Helpers;

use App\Exceptions\ApiException;
use DateTime;

class API
{
    protected static function getToken()
    {
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6ImNiZjgwMTRlLTIxMWItNGNkYS1hODQ5LTk3N2I5N2FhNjk1ZiIsImlhdCI6MTY5NjE4NDk4MCwic3ViIjoiZGV2ZWxvcGVyLzdlYTE2YTcwLWZjODgtMWFjNS0yNTZhLWFlMDE2YzVhYWYxMyIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjgxLjI0NS4yNDcuMTIiLCI4My4yMTcuMTU3LjIwOSJdLCJ0eXBlIjoiY2xpZW50In1dfQ.Hqh695NuVTLTuc07pxytWsKyp0HeXaO1m2n355YV5Tr9p5FWfMljnk2NLW9LVDiyhfAkS_-hdrUZm-X4KA2BoQ";
        return $token;
    }

    /**
     * <p>Calls the Clash of Clans API and takes care of the token and headers</p>
     * @param string $url
     * @return array|null $data
     * @throws ApiException when $data["reason"] is set, an ApiException will be thrown
     */
    protected static function apiCall(string $url, bool $post = false, array $params = null): ?array
    {
        $ch = curl_init($url);
        $header = array();
        $headr[] = "Accept: application/json";
        $headr[] = "Authorization: Bearer " . self::getToken();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        if ($post) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params['apiToken']));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        $data = json_decode($res, true);

        // TODO create switch for all status codes and throw different ApiExceptions
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // $data = self::forceError();

        if (isset($data["reason"])) {
            throw new ApiException($data["reason"], $data["message"] ?? null);
        }

        return $data;
    }

    /**
     * <p>Simulates an error from the API</p>
     * @return mixed
     */
    protected static function forceError(): mixed
    {
        return json_decode('{ "reason": "inMaintenance", "message": "API is currently under maintenance" }', true);
    }

    /**
     * @param $msg
     * @return void
     */
    protected static function timeDebug($msg): void
    {
        $now = DateTime::createFromFormat('U.u', microtime(true));
        dump($now->format("H:i:s.u") . " " . $msg);
    }
}