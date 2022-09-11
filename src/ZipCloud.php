<?php

namespace Shimoning\ZipCloud;

use GuzzleHttp\Client;
use Shimoning\ZipCloud\Entities\Options;
use Shimoning\ZipCloud\Entities\Response;

class ZipCloud
{
    /**
     * 郵便番号検索を実行する
     *
     * @param string $zipCode
     * @param Options|array|null $options
     * @return Response|null
     */
    public static function search(string $zipCode, $options = null): ?Response
    {
        if (! self::validate($zipCode)) {
            return null;
        }

        if (empty($options)) {
            $options = new Options([]);
        }
        if (\is_array($options)) {
            $options = new Options($options);
        }

        /** @var Client */
        static $client;
        if (empty($client) || $options->shouldReset()) {
            $client = new Client([
                'base_uri' => $options->endpoint(),
            ]);
        }

        // request
        $response = $client->request(
            'GET',
            'search?zipcode=' . $zipCode . '&limit=' . $options->limit(),
            [
                'http_errors' => false,
                'timeout' => 0,
                'connect_timeout' => 0,
                'headers' => [
                    'User-Agent' => 'Shimoning ZipCloud Client',
                ],
            ]
        );
        return new Response($response);
    }

    /**
     * 郵便番号の検証
     *
     * @param string $zipCode
     * @return bool
     */
    public static function validate(string $zipCode): bool
    {
        return \preg_match('/^\d{3}-?\d{4}$/', $zipCode);
    }
}
