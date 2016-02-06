<?php

/**
 * Created by IntelliJ IDEA.
 * User: Madura
 * Date: 19/10/2015
 * Time: 15:01
 */
namespace ShoutOUT\SDK;
class SignRequest
{
    private $region = 'us-east-1';
    private $service = 'execute-api';
    private $accessKey;
    private $secretKey;

    public function __construct($accessKey, $secretKey)
    {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
    }

    function calculateSignature($method, $path, $body, $headers, $query)
    {
        $ldt = gmdate('Ymd\THis\Z');
        $sdt = substr($ldt, 0, 8);

        $cs = "$sdt/$this->region/$this->service/aws4_request";
        $payload = hash('sha256', $body);
        $headers['x-amz-date'] = $ldt;
        $context = $this->createContext($headers, $payload, $method, $path, $query);
        $toSign = $this->createStringToSign($ldt, $cs, $context['creq']);
        $signingKey = $this->getSigningKey(
            $sdt,
            $this->region,
            $this->service,
            $this->secretKey
        );
        $signature = hash_hmac('sha256', $toSign, $signingKey);


        $headers['Authorization'] =
            "AWS4-HMAC-SHA256 "
            . "Credential={$this->accessKey}/{$cs}, "
            . "SignedHeaders={$context['headers']}, Signature={$signature}";
        return $headers;
    }


    private function createContext(array $headers, $payload, $method, $path, $query)
    {
        // The following headers are not signed because signing these headers
        // would potentially cause a signature mismatch when sending a request
        // through a proxy or if modified at the HTTP client level.
        static $blacklist = [
            'cache-control' => true,
            'content-type' => true,
            'content-length' => true,
            'expect' => true,
            'max-forwards' => true,
            'pragma' => true,
            'range' => true,
            'te' => true,
            'if-match' => true,
            'if-none-match' => true,
            'if-modified-since' => true,
            'if-unmodified-since' => true,
            'if-range' => true,
            'accept' => true,
            'authorization' => true,
            'proxy-authorization' => true,
            'from' => true,
            'referer' => true,
            'user-agent' => true
        ];

        // Normalize the path as required by SigV4
        $canon = $method . "\n"
            . $this->createCanonicalizedPath($path) . "\n"
            . $this->getCanonicalizedQuery($query) . "\n";

        // Case-insensitively aggregate all of the headers.
        $aggregate = [];
        foreach ($headers as $key => $values) {
            $key = strtolower($key);
            if (!isset($blacklist[$key])) {
                //foreach ($values as $v) {
                $aggregate[$key][] = $values;
                //}
            }
        }

        ksort($aggregate);

        $canonHeaders = [];
        foreach ($aggregate as $k => $v) {
            if (count($v) > 0) {
                sort($v);
            }
            $canonHeaders[] = $k . ':' . preg_replace('/\s+/', ' ', implode(',', $v));
        }

        $signedHeadersString = implode(';', array_keys($aggregate));

        $canon .= implode("\n", $canonHeaders) . "\n\n"
            . $signedHeadersString . "\n"
            . $payload;

        return ['creq' => $canon, 'headers' => $signedHeadersString];
    }

    private function createStringToSign($longDate, $credentialScope, $creq)
    {
        $hash = hash('sha256', $creq);

        return "AWS4-HMAC-SHA256\n{$longDate}\n{$credentialScope}\n{$hash}";
    }

    private function getSigningKey($shortDate, $region, $service, $secretKey)
    {

        $dateKey = hash_hmac('sha256', $shortDate, "AWS4{$secretKey}", true);
        $regionKey = hash_hmac('sha256', $region, $dateKey, true);
        $serviceKey = hash_hmac('sha256', $service, $regionKey, true);
        hash_hmac('sha256', 'aws4_request', $serviceKey, true);


        return hash_hmac('sha256', 'aws4_request', $serviceKey, true);
    }

    private function createCanonicalizedPath($path)
    {
        $doubleEncoded = rawurlencode(ltrim($path, '/'));

        return '/' . str_replace('%2F', '/', $doubleEncoded);
    }

    private function getCanonicalizedQuery(array $query)
    {
        unset($query['X-Amz-Signature']);

        if (!$query) {
            return '';
        }

        $qs = '';
        ksort($query);
        foreach ($query as $k => $v) {
            if (!is_array($v)) {
                $qs .= rawurlencode($k) . '=' . rawurlencode($v) . '&';
            } else {
                sort($v);
                foreach ($v as $value) {
                    $qs .= rawurlencode($k) . '=' . rawurlencode($value) . '&';
                }
            }
        }
        return substr($qs, 0, -1);
    }

}
