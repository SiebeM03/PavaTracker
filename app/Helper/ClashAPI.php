<?php

    namespace App\Helper;

    class ClashAPI
    {
        public static function getData($url)
        {
            $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6ImE3ZGY5NWQxLWFkOGMtNDE3MC04OTVhLWRlNDM5NmNjZDBhMSIsImlhdCI6MTY2ODQzMjQ5Miwic3ViIjoiZGV2ZWxvcGVyLzdlYTE2YTcwLWZjODgtMWFjNS0yNTZhLWFlMDE2YzVhYWYxMyIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjEwOS4xMzIuNC4xMyJdLCJ0eXBlIjoiY2xpZW50In1dfQ.NDzWFFfeZ4TuRYksypJi5hnoJO1nvTCLHSYgRyHj4AjBpe4V-9P_QjNRJqLgA6PPFyFWEi9TFrmPjS7TRC_JvQ";
            $ch = curl_init($url);
            $headr = array();
            $headr[] = "Accept: application/json";
            $headr[] = "Authorization: Bearer " . $token;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $res = curl_exec($ch);
            $data = json_decode($res, true);
            return $data;
        }

        public static function formatTag($tag) {
            return str_replace('o', '0', str_replace('O', '0', $tag));
        }
    }