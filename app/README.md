# deployer

## Run

```bash
    php bin/console app:deploy base.html.twig
```

## Tools

### php-cs-fixer

```bash
    # Run php-cs-fixer with dry-run
    ./vendor/bin/php-cs-fixer fix -v --dry-run --diff
    
    # Run php-cs-fixer
     ./vendor/bin/php-cs-fixer fix -v --diff

```

### phpstan

```bash
    # phpstan analyse
    ./vendor/bin/phpstan analyse
    
    # phpstan create baseline
    ./vendor/bin/phpstan analyse --generate-baseline phpstan-baseline.php
```

### phpunit

```bash
    ./vendor/bin/phpunit tests
```