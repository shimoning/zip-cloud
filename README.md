# ZipCloud API client
[zip cloud](http://zipcloud.ibsnet.co.jp/) から提供されている *郵便番号検索API* を PHP から利用するためのライブラリです。

## Warning
利用時は必ず [zip cloud 郵便番号検索API利用規約](http://zipcloud.ibsnet.co.jp/rule/api) を確認してください。
このライブラリはあくまで API を PHP から扱いやすくするためのもので、こちらでは API 自体についてのお問い合わせには答えられません。
また、このライブラリに関するお問い合わせもサービス提供されてる方へ行わないでください。

## Install
利用するプロジェクトの `composer.json` に以下を追加します。
```composer.json
"repositories": {
    "zip-cloud": {
        "type": "vcs",
        "url": "https://github.com/shimoning/zip-cloud.git"
    }
},
```

その後以下でインストールが可能です。

```bash
composer require shimoning/zip-cloud
```

## Usage

### search
郵便番号から住所検索を実行します。

```php
$response = ZipCloud::search('100-0001');

echo $response->isSuccess() ? '成功' : '失敗';
echo $response->getMessage(); // エラー発生時に、エラーの内容が返される。

foreach ($response->getAddresses() as $address) {
    echo $address->getZipCode(); // 1000001
    echo $address->getPrefectureCode(); // 13

    echo $address->getPrefecture(); // 東京都
    echo $address->getCity(); // 千代田区
    echo $address->getTown(); // 千代田

    echo $address->getPrefectureKana(); // ﾄｳｷｮｳﾄ
    echo $address->getCityKana(); // ﾁﾖﾀﾞｸ
    echo $address->getTownKana(); // ﾁﾖﾀﾞ

    // address を 連想配列で取得する
    $hashedAddress = $address->toArray();
    // [
    //     "zip_code" => "1000001",
    //     "prefecture_code" => "13",
    //     "prefecture" => "東京都",
    //     "city" => "千代田区",
    //     "town" => "千代田",
    //     "prefecture_kana" => "ﾄｳｷｮｳﾄ",
    //     "city_kana" => "ﾁﾖﾀﾞｸ",
    //     "town_kana" => "ﾁﾖﾀﾞ",
    // ]

    // address の生データを取得
    $rawAddress = $address->getRaw();
    // [
    //     "address1" => "東京都",
    //     "address2" => "千代田区",
    //     "address3" => "千代田",
    //     "kana1" => "ﾄｳｷｮｳﾄ",
    //     "kana2" => "ﾁﾖﾀﾞｸ",
    //     "kana3" => "ﾁﾖﾀﾞ",
    //     "prefcode" => "13",
    //     "zipcode" => "1000001",
    // ]
}
```

### search with options
検索時にオプションを指定できます。
`連想配列` もしくは `Options` クラスを第2引数に設定します。


| Name       | Type   | Default | Description |
|:-----------|:-------|:--------|:----------------------------|
| `endpoint` | string | `https://zip-cloud.appspot.com/api/` | zip cloud の API を指定します。基本は変更不要。 |
| `reset`    | bool   | `false` |  API 実行のためのクライアントが初回時に生成され、その後はそれを再利用します。オプションなどを変更したい場合に true を指定してください。 |
| `limit`    | int    | `20` | 同一の郵便番号で複数件のデータが存在する場合に返される件数の上限値です。 |

### validate
郵便番号の簡易バリデーションを実行します。

```php
$validated = ZipCloud::validate('100-0001');

if ($validated) {
    // ok
    ...
} else {
    // error
}
```

## CLI
コマンドラインから以下で実行可能です。
抜ける際は `exit` もしくは `Control + C` を入力してください。

```bash
php client
```

## ライセンスについて
当ライブラリは *MITライセンス* です。
[ライセンス](LICENSE) を読んでいただき、範囲内でご自由にご利用ください。

ただし、ライブラリから利用する `zip cloud 郵便番号検索API` (以下 *利用API* と呼ぶ) については、弊社とは関係ありません。
利用時は必ず [zip cloud 郵便番号検索API利用規約](http://zipcloud.ibsnet.co.jp/rule/api) を確認してください。
