<?php

namespace Channable;

use Channable\Exceptions\ShipmentKnownException;
use Channable\Model\Address;
use Channable\Model\Customer;
use Channable\Model\Extra;
use Channable\Model\Offer;
use Channable\Model\Order;
use Channable\Model\Price;
use Channable\Model\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ChannableApi
{
    const REQUEST_METHOD_GET = 'GET';
    const REQUEST_METHOD_POST = 'POST';

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
     * @var Offer[]
     */
    private $offers = [];

    /**
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

    private function query(string $url, string $requestMethod = self::REQUEST_METHOD_GET, string $body = '')
    {
        $endpoint = sprintf(
            'https://%s/v1/companies/%s/projects/%s/%s',
            $this->host,
            $this->companyId,
            $this->projectId,
            $url
        );

        $client = new Client();
        $response = $client->request($requestMethod, $endpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token
            ],
            'body' => $body
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @return array
     */
    public function getOrders(): array
    {
        $orders = [];

        foreach (json_decode($this->query('orders?limit=100'))->orders as $order) {
            $products = [];

            foreach ($order->data->products as $product) {
                $products[] = new Product(
                    (int) $product->id,
                    $product->quantity,
                    $product->ean,
                    $product->commission,
                    $product->reference_code,
                    $product->shipping,
                    $product->title,
                    $product->price,
                    $product->delivery_period !== '' ? new \DateTime($product->delivery_period) : null
                );
            }

            $customer = new Customer(
                $order->data->customer->company,
                $order->data->customer->phone,
                $order->data->customer->first_name,
                $order->data->customer->middle_name,
                $order->data->customer->last_name,
                $order->data->customer->gender,
                $order->data->customer->email,
                $order->data->customer->mobile
            );

            foreach (['shipping', 'billing'] as $addressType) {
                ${$addressType} = new Address(
                    $order->data->{$addressType}->first_name,
                    $order->data->{$addressType}->middle_name,
                    $order->data->{$addressType}->last_name,
                    $order->data->{$addressType}->company,
                    $order->data->{$addressType}->email,
                    $order->data->{$addressType}->country_code,
                    $order->data->{$addressType}->city,
                    $order->data->{$addressType}->zip_code,
                    $order->data->{$addressType}->street,
                    $order->data->{$addressType}->house_number,
                    $order->data->{$addressType}->house_number_ext,
                    $order->data->{$addressType}->region,
                    $order->data->{$addressType}->address1,
                    $order->data->{$addressType}->address2
                );
            }

            $extra = new Extra($order->data->extra->memo, $order->data->extra->comment);

            $price = new Price(
                $order->data->price->commission,
                $order->data->price->transaction_fee,
                $order->data->price->shipping,
                $order->data->price->payment_method,
                $order->data->price->currency,
                $order->data->price->total,
                $order->data->price->subtotal
            );

            $orders[] = new Order($order->id, $products, $customer, $shipping, $billing, $extra, $price, new \DateTime($order->created));
        }

        return $orders;
    }

    /**
     * @param int $id
     * @param string $title
     * @param float $price
     * @param int $stock
     */
    public function setOfferUpdate(int $id, string $title, float $price, int $stock)
    {
        $this->offers[] = new Offer($id, $title, $price, $stock);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function sendOfferUpdates()
    {
        $offset = 0;
        $limit = 50;

        while ($offset < count($this->offers)) {
            $body = json_encode(array_slice($this->offers, $offset, $limit));

            $response = $this->query('offers', self::REQUEST_METHOD_POST, $body);
            $response = json_decode($response, 1);

            if ($response['status'] !== 'success') {
                throw new \Exception('Offer updates not successfull', ['message' => $response['message']]);
            }

            $offset += $limit;

            if ($offset < count($this->offers)) {
                sleep(5);
            }
        }

        return true;
    }

    /**
     * @param int $orderId
     * @param string $trackingCode
     * @param string|null $trackingUrl
     * @param string|null $transporter
     * @throws ShipmentKnownException
     */
    public function setTrackingNumber(int $orderId, string $trackingCode, string $trackingUrl = null, string $transporter = null)
    {
        $body = json_encode([
            'tracking_code' => $trackingCode,
            'tracking_url' => $trackingUrl,
            'transporter' => $transporter
        ]);

        try {
            $this->query("orders/{$orderId}/shipment", self::REQUEST_METHOD_POST, $body);
        } catch (ClientException $e) {
            throw new ShipmentKnownException('This order has already been shipped', null, $e);
        }
    }
}
