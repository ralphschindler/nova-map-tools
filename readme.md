# Nova Map Tools

### Setup

```
composer require ralphschindler/nova-map-tools
artisan vendor:publish --provider='RalphSchindler\NovaMapTools\NovaMapToolsProvider'
```

### Usage

In a Nova Resource fields list:

```php
Coordinates::make('Coordinates')
```

