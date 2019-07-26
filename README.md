# Roketin Client Template
[![Latest Version](https://img.shields.io/github/release/roketin/stellar-connect.svg?style=flat-square)](https://github.com/roketin/stellar-connect/releases)
[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://packagist.org/packages/laravel/framework)
[![Total Downloads](https://img.shields.io/packagist/dt/roketin/stellar-connect.svg?style=flat-square)](https://packagist.org/packages/roketin/stellar-connect)

RClient is standard client application to [Roketin API](http://www.roketin.com)  to accelerate connecting and integrating basic feature of Roketin Engine API to client's website.

## API Documentation

Documentation for the Roketin API can be found on the [Documentation](http://docs.rengine.apiary.io/#).

## Installation

### Laravel 5

```php
"require": {
    "laravel/framework": "5.0.*",
    "roketin/stellar-connect": "v0.0.14"
}
```

Next, run the Composer update command from the Terminal:

    composer update

    or

    composer require "roketin/stellar-connect"

## CONFIGURATION
1. Open config/app.php and addd this line to your Service Providers Array
  ```php
    Roketin\Providers\RoketinServiceProvider::class,
  ```

2. Open config/app.php and addd this line to your Aliases

```php
    'Roketin' => Roketin\Facades\RoketinFacade::class
  ```

3. Please add to .env file

  ```
    ROKETIN_API=https://api.stellar.roketin.com
    ROKETIN_PUBLIC=https://api.stellar.roketin.com

    ROKETIN_API_KEY=api_key
  ```

## HOW TO USE
* [Basic Usage](#basic)
* [Show](#show)
* [Conditions](#conditions)
* [Sorting](#sorting)
* [Pagination](#pagination)
* [Shipping](#shipping)
* [Social Media](#social_media)
* [Company Detail](#company_detail)
* [Page and Post](#page)
* [Expedition](#expedition)
* [Bank](#bank)
* [Sales Order](#order)
* [Message](#message)
* [Subscribe](#subscribe)
* [Vouchers](#vouchers)
* [Auth](#auth)
* [User](#user)
* [Others](#others)

## Basic

You can call a Roketin Object by using: **Roketin::model()->module()->get()**

```php
    use Roketin;

    $menus = Roketin::menu()->list()->get();
    $pages = Roketin::page()->list()->get();
    $posts = Roketin::post()->list()->get();
    $products = Roketin::product()->list()->get();
    $variants = Roketin::variant()->list()->get();
    $categories = Roketin::category()->list()->get();
    etc..
```

Fethcing single object with id/slug/etc:

```php
    /*
     * Same as fetching object, but in singular form (without 's')
     * the second argument can be id or slug
     * this is dynamic function call to Roketin Engine API
     */

    $menu = Roketin::menu()->show('asc-123123-asxzc')->get();
    $page = Roketin::page()->show('home')->get();
    $post = Roketin::post()->show('lastest-update')->get();

```

## Basic

If you want get the details

```php
    /**
     * @param $id
     */

    $products = Roketin::product()->show($id)->get();
    etc..
```

## Conditions

Fetching object with simple where conditions:

```php
    /**
     * @param $field
     * @param $operation
     * @param $value
     */

    $posts = Roketin::post()->list()->where('title', 'like', 'vacation')->get();

    //NOTE :
    //It doesn't need to add % if using 'like' operator

```

Fetching object with simple orWhere conditions:

```php
    /**
     * @param $field
     * @param $operation
     * @param $value
     */

    $posts = Roketin::post()
                        ->list()
                        ->where('title','like','vacation')
                        ->orWhere('title','like','holiday')
                        ->get();

    //NOTE :
    //It doesn't need to add % if using 'like' operator

```

Advance where orWhere grouping conditions:

```php
    /**
     * @param $field
     * @param $operation
     * @param $value
     */

    $posts = Roketin::post()
                        ->list()
                        ->where('title','like','vacation')
                        ->orWhere('title','like','holiday')
                        ->where('date','>=','2016-04-10')
                        ->where('date','<=','2016-04-18')
                        ->get();

    //NOTE :
    //It will result query grouping
    // (title like vacation or title like holiday)
    // AND
    // (date >= 2016-04-10 and date <= 2016-04-18 )

```

## Sorting

Fetch a Roketin Object API by sorting on it's field:

```php
    /**
     * sorting object before fetch
     *
     * @param $field
     * @param $direction (optional) default is ASC
     */

    $posts = Roketin::post()->list()->sortBy('created_at')->get();
    $posts = Roketin::post()->list()->sortBy('created_at', 'DESC')->get();
```

## Pagination

Paginating fetch object

```php
    /**
     * paginate object before fetch
     *
     * @param $size default value is 10
     * @param $page (optional)
     */

    $posts = Roketin::post()->list()->paginate(10)->get();
    $posts = Roketin::post()->list()->paginate(10,2)->get();
```

## Shipping

Get all available countries:
```php
    $countries = Roketin::country()->list()->get();
```

Get all available provinces (currently available in Indonesia only):
```php
    /**
     * @param $country_id
     */
    $province = Roketin::province()->list('ID')->get();
```

Get all available city (currently available in Indonesia only):
```php
    /**
     * @param $province_id
     */

    $cities = Roketin::city()->list(9)->get();
```

Get all available district (currently available in Indonesia only):
```php
    /**
     * @param $city_id
     */

    $districts = Roketin::district()->list(9)->get();
```

Get all available subdistrict (currently available in Indonesia only):
```php
    /**
 * @param $district_id
     */

    $subDistricts = Roketin::subDistrict()->list(9)->get();
```

## Social Media

Get all available Social Media:
```php
    $medias = Roketin::socialMedia()->list()->get();
```

## Company Detail

Get all available countries:
```php
    $company = Roketin::company()->detail()->get();
```


## Page and Post

Get all Menu:
```php
    $menus = Roketin::menu()->list()->get();
```

Get all Page:
```php
    $pages = Roketin::post()->list()->get();
```

Get all Post:
```php
    $posts = Roketin::post()->list()->get();
```

Get all Category Post:
```php
    $categories = Roketin::categoryPost()->list()->get();
```

## Expedition

Get all available Expedition:
```php
    $expeditions = Roketin::expedition()->list()->get();
```

Get Delivery Cost:
```php
    $delivery = [
        'origin'        => '501',
        'destination'   => '574',
        'weight'        => 1700,
        'courier'       => 'jne'
    ];

    $expeditions = Roketin::expedition()->cost($delivery);
```

## Bank

Get all available Bank:
```php
    $expeditions = Roketin::bank()->list()->get();
```

## Order
Create sales order:
```php
    /*
     * @param array $generalData
     * @param array $customerData
     * @param array $products
     * @param $bcc(optional), default = null
     */

     $order = [
        "member_id"                 => "5b55af8c6f6bfc0c74007955",
        "order_at"                  => "2009-09-09",
        "is_create_invoice"         => true,
         "due_date_invoice"         => "2009-09-09",
         "message_from_customer"    => "pesan",
         "name"                     => "adin",
         "email"                    => "test@gmail.com",
         "phone"                    => "123123123",
         "address"                  => "Bandung",
         "send_invoice"             => true,
         "shipping"                 => true,
         "expedition_code"          => "jne",
         "service_code"             => "oke",
         "discounts"                => 10000,
         "voucher_code"             => "voucher12009",
         "tax"                      => 10,
         "shipping_cost"            => 0,
         "sender_id"                => "5b3309076f6bfc0460000b73",
         "products"                 => [
            {
                "name"          => "Sepatu Merah",
                "product_id"    => "5b6184386f6bfc3d18003eca",
                "quantity"      => 1,
                "price"         => 200000,
                "discount"      => 0,
                "add_cost"      => 0,
                "weight"        => 100
            },
            {
                "name"          => "Sendal Merah",
                "product_id"    => "5b6184386f6bfc3d18003ecb",
                "quantity"      => 1,
                "price"         => 30000,
                "discount"      => 0,
                "add_cost"      => 0,
                "weight"        => 100
            },
            {
                "name"          => "Swallow",
                "product_id"    => "5b6184386f6bfc3d18003ecc",
                "quantity"      => 1,
                "price"         => 50000,
                "discount"      => 0,
                "add_cost"      => 0,
                "weight"        => 100
            }
          ]
     ];
    $order = Roketin::salesOrder()->store($order);
```

Search sales order:
```php
    /**
     * @param $query
     */

    $order = Roketin::salesOrder()->search($query)->get()
```

> **Note:**
> - For detailed attribute, see sales order API documentation [HERE](http://docs.rengine.apiary.io/#reference/sales-order/sales-order)

----
Create payment order:
```php
    /**
     * @param $payment
     */

    $image = Roketin::image()->send($request->file('image'));

    $payment = [
        "sales_invoice_id"      => "8b2ac9dc-85b1-49fe-b609-3e0539af2eb6",
        "payment_type"          => "transfer",
        "paid_at"               => "2009-09-09",
        "nominal"               => 10000,
        "company_bank_id"       => "8b29e54e-ba87-487a-9fc2-b8898d902074",
        "bank_name"             => "adin",
        "account_number"        => "0189320123",
        "account_name"          => "adin",
        "card_number"           => "01982301",
        "credit_card_type"      => "credit",
        "transaction_number"    => "T001092381",
        "attachment"            => $image
    ];

    $payment = Roketin::payment()->confirm($payment);
```

## Message
Send a message to Roketin Engine Inbox:
```php
    /*
     * @param $sender_name
     * @param $sender_email
     * @param $sender_phone
     * @param $message_title
     * @param $message_body
     * @param $bcc(optional), default = null
     * @param $send_message(optional), default = false
     */

    $msg = Roketin::message()
                    ->send(
                    'test',
                    'test@mailinator.com',
                    '123123',
                    'test mesage',
                    'hai',
                    ['bcc@mailinator.com']
                    false)
```

## Subscribe
Send a Subscribe to Roketin Engine Subscribe:
```php
    /*
     * @param $email
     */

    $msg = Roketin::subscribe()->send('test@mailinator.com')
```

## Vouchers
Check validity of a voucher:
```php
    /*
     * @param $code
     * @param $voucher_type (optional), default = null
     * voucher type can be giftvoucher (voucher in
     * exchange to money nominal) or
     * other (voucher to exchange to free product)
     * default is voucher_type is other
     */
    $data = [
        'code'           => 'AS123D',
        'total_purchase' => 10000
    ];

    $check = Roketin::voucher()->check($data)
```

# Auth
Resend activation code to email:
```php
    /**
     * @param $email
     * @return true if success activation
     * @return error object if present
     */

    $resend = Roketin::auth()->resendActivation('someone@somthing.com');
```

Forgot password (generate and send token to user email):
```php
    /**
     * @param $email
     * @param $bcc(optional), default = null
     * @return true if success activation
     * @return error object if present
     */

    Roketin::auth()->forgot('someone@somthing.com', 'bcc@mailinator.com');
```

Login:
```php
    /**
     * @param $email
     * @param $password
     * @param $type (optional) default = user, available = vendor
     * @return true if success activation
     * @return error object if present
     */

    $user = [
        'email'     => 'somebody@somthing.com',
        'password'  => 'secret123'
    ];

    Roketin::auth()->login($user);
```

# Users
   Register new user:
```php
    /**
     * @param $first_name
     * @param $last_name
     * @param $email
     * @param $password
     * @param $password_confirmation
     * @return user object
     */

    $user = [
        "first_name"            => "adin",
        "last_name"             => "",
        "email"                 => "test@gmail.com",
        "password"              => "secret123",
        "password_confirmation" => "secret123"
    ];

    $user = Roketin::user()->register($user);
```

Update user data:
```php
    /**
     * @param $id
     * @return user object
     */

    $user = [
        "first_name"        => "adin",
        "middle_name"       => "",
        "last_name"         => "",
        "nickname"          => "adin",
        "gender"            => "male",
        "place_of_birth"    => "Bandung",
        "date_of_birth"     => "18 Jul 2018",
        "role_ids"          => ["5b6945056f6bfc42cc003479"]
    ];

    Roketin::user()->update('5b6863e16f6bfc32ec003d1d', $user);
```

Show user data:
```php
    /**
     * @param $id
     * @return user object
     */

    Roketin::user()->show('5b6863e16f6bfc32ec003d1d');
```

Change Password:
```php
    /**
     * @param $id
     * @return user object
     */

    $params = [
        "old_password"          => "secret",
        "password"              => "secret123",
        "password_confirmation" => "secret123"
    ];

    Roketin::user()->changePassword('5b6863e16f6bfc32ec003d1d', $params);
```

> **Note:**
> - you can also use where(), orWhere(), etc query with this method

## Others

Get Product Variants By Category:
```php
    /**
     * @param $category_name
     * @return variants object
     */

    Roketin::product()->list()->categories('baju')->get();

    or

    Roketin::product()->list()->categories(['baju'])->get();
```

Get Product Variants By Tag:
```php
    /**
     * @param $category_name
     * @return variants object
     */

    Roketin::product()->list()->tags('baju')->get();

    or

    Roketin::product()->list()->tags(['baju'])->get();
```

Get Product Sort By Relation:
```php
    /**
     * @param $category_name
     * @return variants object
     */

    Roketin::product()->list()->sortBy('price', 'ASC', 'variants')->get();
```
