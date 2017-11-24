<?php

namespace Channable;

use Channable\Model\Address;
use Channable\Model\Customer;
use Channable\Model\Extra;
use Channable\Model\Order;
use Channable\Model\Price;
use Channable\Model\Product;
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
        $endpoint = sprintf(
            'https://%s/v1/companies/%s/projects/%s/%s',
            $this->host,
            $this->companyId,
            $this->projectId,
            $url
        );

        $client = new Client();
        $response = $client->request('GET', $endpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token
            ]
        ]);

        return $response->getBody()->getContents();

//        return '{
//  "orders": [
//    {
//        "data": {
//          "products": [
//            {
//              "quantity": 2,
//              "ean": "9789062387410",
//              "commission": 1.5,
//              "id": "11",
//              "reference_code": "123",
//              "shipping": 0,
//              "title": "Harry Potter",
//              "price": 61.725,
//              "delivery_period": "2017-08-02+02:00"
//            }
//          ],
//          "customer": {
//            "company": "Bol.com",
//            "phone": "0201234567",
//            "first_name": "Jans",
//            "middle_name": "",
//            "gender": "male",
//            "last_name": "Janssen",
//            "email": "dontemail@me.net",
//            "mobile": ""
//          },
//          "shipping": {
//            "first_name": "Jan",
//            "middle_name": "",
//            "last_name": "Janssen",
//            "company": "The Company",
//            "email": "nospam4me@myaccount.com",
//            "country_code": "NL",
//            "city": "Amsterdam",
//            "zip_code": "1000 AA",
//            "street": "Shipmentstraat",
//            "house_number": 42,
//            "house_number_ext": "bis",
//            "address_supplement": "3 hoog achter extra adres info",
//            "region": "",
//            "address1": "Shipmentstraat 42 bis",
//            "address2": ""
//          },
//          "extra": {
//            "memo": "Order from Channable \n Bol.com order id: 123\n Customer receipt: https:\/\/www.bol.com\/sdd\/orders\/downloadallpackageslips.html",
//            "comment": "Bol.com order id: 123"
//          },
//          "billing": {
//            "first_name": "Jans",
//            "middle_name": "",
//            "last_name": "Janssen",
//            "email": "dontemail@me.net",
//            "country_code": "NL",
//            "company": "Bol.com",
//            "city": "Amsterdam",
//            "street": "Billingstraat",
//            "zip_code": "5000 ZZ",
//            "house_number": 1,
//            "house_number_ext": "",
//            "address_supplement": "Onder de brievanbus huisnummer 1 extra adres info",
//            "region": "",
//            "address1": "Billingstraat 1",
//            "address2": "Onder de brievanbus huisnummer 1 extra adres info"
//          },
//          "price": {
//            "commission": 1.5,
//            "transaction_fee": 0,
//            "shipping": 0,
//            "payment_method": "bol",
//            "currency": "EUR",
//            "total": 123.45,
//            "subtotal": 123.45
//          }
//        },
//        "created": "2017-08-02T14:31:48",
//        "channel_name": "bol",
//        "fulfillment": {
//        },
//        "status_paid": "paid",
//        "status_shipped": "not_shipped",
//        "platform_id": "49844744",
//        "modified": "2017-08-10T18:08:13.699449",
//        "channel_id": "123",
//        "project_id": 6496,
//        "error": false,
//        "id": 299623,
//        "platform_name": "channable"
//    }
//  ],
//  "total": 152,
//  "error_count": 2
//}';
    }

    /**
     * @return array
     */
    public function getOrders(): array
    {
        $orders = [];

        foreach (json_decode($this->query('orders'))->orders as $order) {
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

            $orders[] = new Order($order->id, $products, $customer, $shipping, $billing, $extra, $price);
        }

        return $orders;
    }
}
