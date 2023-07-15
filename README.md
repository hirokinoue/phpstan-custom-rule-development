# phpstan-custom-rule-development
PHPStanのCustom Rule開発環境サンプル

## ディレクトリ構成
```
.
|-- Rules
|   `-- MyRule.php           # カスタムルール
|-- Tests
|   `-- MyRuleTest
|       |-- data
|       |   `-- my-rule.php  # テストデータ
|       `-- MyRuleTest.php   # テストコード
|-- src                  
|   `-- SomeClass.php        # 解析対象のコード
`-- phpstan.neon             # config（実行したいCustom Ruleをここで指定する）
```

## 参考
- [PHPStan公式 - Custom Rules](https://phpstan.org/developing-extensions/rules)
- [PHPStan公式 - Testing](https://phpstan.org/developing-extensions/testing)
- [Docker×PHPStorm×Xdebugでステップ実行する設定](https://zenn.dev/micronn/articles/5f3cd1d94f99fd)

## 起動
```
make run
```

## イメージ、コンテナの削除
```
make clean
```

## 解析実行
```
XDEBUG_MODE=off ./vendor/bin/phpstan analyze -l 0 src
XDEBUG_MODE=off ./vendor/bin/phpstan analyse -l 0 --debug src
XDEBUG_MODE=off ./vendor/bin/phpstan clear-result-cache
```

### ユニットテスト
```
XDEBUG_MODE=off ./vendor/bin/phpunit Tests
```

### デバッグ
`--xdebug`オプションを付けて実行する。並行処理を無効化するため`--debug`オプションも付ける。
```
./vendor/bin/phpstan analyze --debug --xdebug -l 0 src 
```
