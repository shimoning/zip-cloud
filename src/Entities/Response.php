<?php

namespace Shimoning\ZipCloud\Entities;

use Psr\Http\Message\ResponseInterface;

class Response
{
    private ?int $_internalStatus;
    private ?int $_status;
    private ?string $_message;
    private $_addresses = [];

    public function __construct(ResponseInterface $response)
    {
        $this->_internalStatus = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $result = \json_decode($body, true);

        $this->_status =  $result['status'] ?? $this->_internalStatus;
        $this->_message = $result['message'] ?? null;

        $addresses = [];
        foreach ($result['results'] ?? [] as $address) {
            $addresses[] = new Address($address);
        }
        $this->_addresses = $addresses;
    }

    /**
     * リクエストの成否を取得
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->_internalStatus === 200;
    }

    /**
     * API の結果ステータスを表示
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->_status;
    }

    /**
     * API からのメッセージを取得
     *
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->_message;
    }

    /**
     * 住所情報を取得
     * @return \Shimoning\ZipCloud\Entities\Address[]
     */
    public function getAddresses(): array
    {
        return $this->_addresses;
    }
}
