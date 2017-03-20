<?php

namespace Eklundkristoffer\DiscordWebhook;

use GuzzleHttp\Client;

class DiscordClient
{
    /**
     * Holds the discord API endpoint.
     *
     * @var string
     */
    protected $apiEndPoint = 'https://discordapp.com/api';

    /**
     * Holds all registered webhooks.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $webhooks = [];

    /**
     * Create a new DiscordClient instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->webhooks = collect($this->webhooks);
    }

    /**
     * Get all registered webhooks.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getWebhooks()
    {
        return $this->webhooks;
    }

    /**
     * Get given webhook url.
     *
     * @param  string  $alias
     * @return string
     */
    public function getWebhookUrl($alias)
    {
        return $this->webhooks->get($alias);
    }

    /**
     * Get the discord API endpoint.
     *
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->apiEndPoint;
    }

    /**
     * Register a array of webhooks.
     *
     * @param  array  $webhooks
     * @return void
     */
    public function registerWebhooks(array $webhooks)
    {
        collect($webhooks)->each(function ($url, $alias) {
            $this->registerWebhook($alias, $url);
        });
    }

    /**
     * Register a webhook.
     *
     * @param string  $alias
     * @param string  $url
     * @return void
     */
    public function registerWebhook($alias, $url)
    {
        $this->webhooks->put($alias, $url);
    }

    /**
     * Execute given webhook.
     *
     * @param string  $alias
     * @param array   $json_payload
     * @return \GuzzleHttp\Psr7\Response
     */
    public function executeWebhook($alias, array $json_payload)
    {
        $client = new Client();

        $res = $client->post($this->getWebhookUrl($alias), [
            'headers' => [
                'Content-Type' => 'application/json'
            ],

            'json' => $json_payload
        ]);

        return $res;
    }
}