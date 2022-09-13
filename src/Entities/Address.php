<?php

namespace Shimoning\ZipCloud\Entities;

class Address
{
    private array $_raw = [];
    private ?string $_zipCode;
    private ?string $_prefectureCode;
    private ?string $_prefecture;
    private ?string $_city;
    private ?string $_town;
    private ?string $_prefectureKana;
    private ?string $_cityKana;
    private ?string $_townKana;

    public function __construct(array $data)
    {
        $this->_raw = $data;

        if (isset($data['zipcode'])) {
            $this->_zipCode = $data['zipcode'];
        }
        if (isset($data['prefcode'])) {
            $this->_prefectureCode = $data['prefcode'];
        }

        if (isset($data['address1'])) {
            $this->_prefecture = $data['address1'];
        }
        if (isset($data['address2'])) {
            $this->_city = $data['address2'];
        }
        if (isset($data['address3'])) {
            $this->_town = $data['address3'];
        }

        if (isset($data['kana1'])) {
            $this->_prefectureKana = $data['kana1'];
        }
        if (isset($data['kana2'])) {
            $this->_cityKana = $data['kana2'];
        }
        if (isset($data['kana3'])) {
            $this->_townKana = $data['kana3'];
        }
    }

    /**
     * 郵便番号を取得
     * @return string|null
     */
    public function getZipCode(): ?string
    {
        return $this->_zipCode;
    }

    /**
     * JIS X 0401 に定められた2桁の都道府県コードを取得
     * @return string|null
     */
    public function getPrefectureCode(): ?string
    {
        return $this->_prefectureCode;
    }

    /**
     * 都道府県名を取得
     * @return string|null
     */
    public function getPrefecture(): ?string
    {
        return $this->_prefecture;
    }

    /**
     * 市区町村名を取得
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->_city;
    }

    /**
     * 町域名を取得
     * @return string|null
     */
    public function getTown(): ?string
    {
        return $this->_town;
    }

    /**
     * 都道府県名カナを取得
     * @return string|null
     */
    public function getPrefectureKana(): ?string
    {
        return $this->_prefectureKana;
    }

    /**
     * 市区町村名カナを取得
     * @return string|null
     */
    public function getCityKana(): ?string
    {
        return $this->_cityKana;
    }

    /**
     * 町域名カナを取得
     * @return string|null
     */
    public function getTownKana(): ?string
    {
        return $this->_townKana;
    }

    /**
     * 連想配列で取得
     * @return array
     */
    public function toArray(): array
    {
        return [
            'zip_code'          => $this->_zipCode,
            'prefecture_code'   => $this->_prefectureCode,
            'prefecture'        => $this->_prefecture,
            'city'              => $this->_city,
            'town'              => $this->_town,
            'prefecture_kana'   => $this->_prefectureKana,
            'city_kana'         => $this->_cityKana,
            'town_kana'         => $this->_townKana,
        ];
    }

    /**
     * 無加工のまま取得
     * @return array
     */
    public function getRaw(): array
    {
        return $this->_raw;
    }
}
