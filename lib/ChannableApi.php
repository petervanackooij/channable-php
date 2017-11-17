<?php

namespace Channable;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Channable\Exceptions\ConnectionFailedException;

class ChannableApi
{
    /**
     * @var int
     */
    private $companyId;

    /**
     * @var int
     */
    private $projectId;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $host;

    /**
     * ChannableApi constructor.
     * @param int $companyId
     * @param int $projectId
     * @param string $token
     * @param string $host
     */
    public function __construct(int $companyId, int $projectId, string $token, string $host)
    {
        $this->companyId = $companyId;
        $this->projectId = $projectId;
        $this->token = $token;
        $this->host = $host;
    }

    private function query(string $url)
    {
        $endpoint = sprintf('https://$1/v1/companies/$2/projects/$3/$4', [
            $this->host,
            $this->companyId,
            $this->projectId,
            $url
        ]);

        try {
            $client = new Client();
            $result = $client->request('GET', $endpoint, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->token
                ]
            ]);
        } catch (RequestException $e) {
            throw new ConnectionFailedException();
        }

        return $result;
//        $result = $client->request('GET', $endpoint);
//        echo $result->getStatusCode();
    }

    public function getOrders()
    {
        var_dump($this->query('orders'));
    }
}
