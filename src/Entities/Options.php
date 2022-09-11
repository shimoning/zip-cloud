<?php

namespace Shimoning\ZipCloud\Entities;

// TODO: support \GuzzleHttp\RequestOptions
class Options
{
    private string $_endpoint = 'https://zip-cloud.appspot.com/api/';
    private bool $_reset = false;
    private int $_limit = 20;

    public function __construct(array $data)
    {
        if (!empty($data['endpoint'])) {
            $this->_endpoint = $data['endpoint'];
        }
        if (isset($data['reset'])) {
            $this->_reset = (bool)$data['reset'];
        }
        if (isset($data['limit']) && $data['limit'] > 0) {
            $this->_limit = (int)$data['limit'];
        }
    }

    /**
     * API のエンドポイント設定を取得
     * @return string
     */
    public function endpoint(): string
    {
        return $this->_endpoint;
    }

    /**
     * クライアントの初期化が必要かどうかを取得
     * @return bool
     */
    public function shouldReset(): bool
    {
        return $this->_reset;
    }

    /**
     * 同一の郵便番号で複数件のデータが存在する場合に返される件数の上限値
     * @return int
     */
    public function limit(): int
    {
        return $this->_limit;
    }
}
