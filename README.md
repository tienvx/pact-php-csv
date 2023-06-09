# Pact PHP CSV Plugin [![Build Status][actions_badge]][actions_link] [![Coverage Status][coveralls_badge]][coveralls_link] [![Version][version-image]][version-url] [![PHP Version][php-version-image]][php-version-url]

This library is a plugin for [Pact PHP][pact-php].
It allow testing csv endpoints.

## Installation

```shell
composer require tienvx/pact-php-csv
```

## Documentation

[Consumer Example](./example/consumer/tests/Contract/CsvHttpClientTest.php)
[Provider Example](./example/provider/tests/Contract/PactVerifyTest.php)

## License

[MIT](https://github.com/tienvx/pact-php-csv/blob/main/LICENSE)

[actions_badge]: https://github.com/tienvx/pact-php-csv/workflows/main/badge.svg
[actions_link]: https://github.com/tienvx/pact-php-csv/actions

[coveralls_badge]: https://coveralls.io/repos/tienvx/pact-php-csv/badge.svg?branch=main&service=github
[coveralls_link]: https://coveralls.io/github/tienvx/pact-php-csv?branch=main

[version-url]: https://packagist.org/packages/tienvx/pact-php-csv
[version-image]: http://img.shields.io/packagist/v/tienvx/pact-php-csv.svg?style=flat

[php-version-url]: https://packagist.org/packages/tienvx/pact-php-csv
[php-version-image]: http://img.shields.io/badge/php-8.0.0+-ff69b4.svg

[pact-php]: https://github.com/pact-foundation/pact-php
