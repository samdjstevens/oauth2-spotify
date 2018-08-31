# Spotify Provider for league/oauth2-client

This package implements a Spotify OAuth 2.0 provider for the [league/oauth2-client](https://github.com/thephpleague/oauth2-client) library.

## Requirements

PHP 5.6 or higher is required.


## Installation

Install with [Composer](https://getcomposer.org/) by running:

```
composer require samdjstevens/oauth2-spotify
```

## Usage

Create a new instance of the provider with your app details like so:

```php
$provider = new \Samdjstevens\OAuth2\Client\Provider\Spotify([
    'clientId' => 'YOUR_SPOTIFY_CLIENT_ID',
    'clientSecret' => 'YOUR_SPOTIFY_CLIENT_SECRET',
    'redirectUri' => 'https://example.com/callback-url',
]);
```

And then use with the `league/oauth2-client` library as [outlined here](http://oauth2-client.thephpleague.com/usage/).

## License

[MIT](https://github.com/samdjstevens/oauth2-spotify/blob/master/LICENSE)