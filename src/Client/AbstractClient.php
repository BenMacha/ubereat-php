<?php

declare(strict_types=1);

/**
 * PHP version 7.4 - 8.4 .
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * https://www.php.net/license/3_01.txt.
 *
 * POS developed by Ben Macha.
 *
 * @category   UberEat SDK
 *
 * @author     Ali BEN MECHA       <contact@benmacha.tn>
 *
 * @copyright  Ⓒ 2025 benmacha.tn
 *
 * @see       https://www.benmacha.tn
 *
 */

namespace UberEats\Client;

use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Serializer\SerializerInterface;
use UberEats\Exception\UberEatsException;

abstract class AbstractClient
{
    protected const BASE_URL = 'https://api.uber.com';
    protected const API_VERSION = 'v1';

    protected ClientInterface $httpClient;

    protected SerializerInterface $serializer;

    protected ?LoggerInterface $logger;

    protected ?string $accessToken;

    public function __construct(
        ClientInterface $httpClient,
        SerializerInterface $serializer,
        ?string $accessToken = null,
        ?LoggerInterface $logger = null
    ) {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
        $this->logger = $logger ?? new NullLogger();
        $this->accessToken = $accessToken;
    }

    protected function getHeaders(): array
    {
        if (! $this->accessToken) {
            throw new UberEatsException('Not authenticated. Call authenticate() first.');
        }

        return [
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    /**
     * @template T
     * @param string $data
     * @param class-string<T> $type
     * @return T
     */
    protected function deserialize(string $data, string $type)
    {
        return $this->serializer->deserialize($data, $type, 'json');
    }

    /**
     * @param mixed $data
     */
    protected function serialize($data): string
    {
        return $this->serializer->serialize($data, 'json');
    }

    protected function setAccessToken(string $token): void
    {
        $this->accessToken = $token;
    }

    /**
     * @param mixed $data
     * @return array<string, mixed>
     * @throws UberEatsException
     */
    protected function decodeResponse($data): array
    {
        $decoded = json_decode((string) $data, true);
        if (! is_array($decoded)) {
            throw new UberEatsException('Invalid response format');
        }

        return $decoded;
    }
}
