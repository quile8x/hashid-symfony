# [![PGS Software](https://www.pgs-soft.com/pgssoft-logo.png)](https://www.pgs-soft.com) / HashId

![PHP from Packagist](https://img.shields.io/packagist/php-v/symfony/symfony.svg)
[![Build Status](https://travis-ci.org/PGSSoft/HashId.svg?branch=3.0)](https://travis-ci.org/PGSSoft/HashId)
[![Code Coverage](https://scrutinizer-ci.com/g/PGSSoft/HashId/badges/coverage.png?b=dev-master)](https://scrutinizer-ci.com/g/PGSSoft/HashId/?branch=dev-master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/PGSSoft/HashId/badges/quality-score.png?b=dev-master)](https://scrutinizer-ci.com/g/PGSSoft/HashId/?branch=dev-master)

Symfony bundle for encoding integer route parameters and decoding request parameters with <http://www.hashids.org/>
***
Please use this version with Symfony &ge;5.0
***
Replace predictable integer url parameters in easy way:
  * `/hash-id/demo/decode/216/30` => `/hash-id/demo/decode/X46dBNxd79/30`
  * `/order/315` => `/order/4w9aA11avM`  

Pros:
  * no need to use extra filters - use `{{ url('route_name', {'id': 1}) }}` in twig template or `$this->generateUrl('route_name', ['id' => 1]);` in controller or service
  * [Doctrine Converter](http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html#doctrine-converter) compatible

## Instalation
```bash
composer require quile8x/hashid-bundle-new
```

## Hashids configuration
```yaml
# config/packages/pgs_hash_id.yaml

pgs_hash_id:
    converter:
        hashids:
            salt: 'my super salt'
            min_hash_length: 20
            alphabet: 'qwertyasdzxc098765-'
```

## Controller configuration
```php
use Pgs\HashIdBundle\Annotation\Hash;

class UserController extends Controller
{
    /**
     * @Hash("id")
     */
    public function edit(int $id)
    {
    //...
    }

    /**
     * Process multiple parameters - 'oneMore' will not be processed
     * @Route(name="test", path="/test/{id}/{other}/{oneMore}")
     * @Hash({"id","other"})
     */
    public function test(int $id, int $other, int $oneMore)
    {
    //...
    }
}
```

You can also check our [DemoController](src/Controller/DemoController.php).

## Contributing

Bug reports and pull requests are welcome on GitHub at [https://github.com/PGSSoft/HashId](https://github.com/PGSSoft/HashId).


## About

The project maintained by [software development agency](https://www.pgs-soft.com/) [PGS Software](https://www.pgs-soft.com/).
See our other [open-source projects](https://github.com/PGSSoft) or [contact us](https://www.pgs-soft.com/contact-us/) to develop your product.


## Follow us

[![Twitter URL](https://img.shields.io/twitter/url/http/shields.io.svg?style=social)](https://twitter.com/intent/tweet?text=https://github.com/PGSSoft/InAppPurchaseButton)
[![Twitter Follow](https://img.shields.io/twitter/follow/pgssoftware.svg?style=social&label=Follow)](https://twitter.com/pgssoftware)
