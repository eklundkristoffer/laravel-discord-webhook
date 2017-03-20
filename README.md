# laravel-discord-webhook

## Usage

```php
use \Facades\Eklundkristoffer\DiscordWebhook\DiscordClient;

$webhooks = [
    'mychannel.alias' => 'https://discordapp.com/api/webhooks/{webhook.id}/{webhook.token}'
];

DiscordClient::registerWebhooks($webhooks);

DiscordClient::executeWebhook('mychannel.alias', [
    'content' => 'Hello World2'
]);
```
