# Roketin Client Template

[![Latest Version](https://img.shields.io/github/release/roketin/stellar-connect.svg?style=flat-square)](https://github.com/roketin/stellar-connect/releases)
[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://packagist.org/packages/laravel/framework)
[![Total Downloads](https://img.shields.io/packagist/dt/roketin/stellar-connect.svg?style=flat-square)](https://packagist.org/packages/roketin/stellar-connect)

RClient is standard client application to [Roketin API](http://www.roketin.com) to accelerate connecting and integrating basic feature of Roketin Engine API to client's website.

## API Documentation

Documentation for the Roketin API can be found on the [Documentation](http://docs.rengine.apiary.io/#).

## Installation

### Laravel 5

```php
    "require": {
        "laravel/framework": "5.0.*",
        "roketin/stellar-connect": "v0.0.15"
    }
```

Next, run the Composer update command from the Terminal:

    composer update

    or

    composer require "roketin/stellar-connect"

## CONFIGURATION

1. Open config/app.php and addd this line to your Service Providers Array

```php
  Roketin\Providers\RoketinServiceProvider::class
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

- [Basic Usage](#basic)
- [Show](#show)
- [Conditions](#conditions)
- [Sorting](#sorting)
- [Pagination](#pagination)
- [Shipping](#shipping)
- [Social Media](#social-media)
- [Company Detail](#company-detail)
- [Page and Post](#page-and-post)
- [Expedition](#expedition)
- [Bank](#bank)
- [Sales Order](#order)
- [Message](#message)
- [Subscribe](#subscribe)
- [Vouchers](#vouchers)
  <!-- -  [Auth](#auth) -->
  <!-- - [User](#user) -->
- [Members](#member)
- [Members-Address](#member-address)
- [Members-Contact](#member-contact)
- [Members-Wishlist](#member-wishlist)
- [Others](#others)

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
    /**
     * Same as fetching object, but in singular form (without 's')
     * the second argument can be id or slug
     * this is dynamic function call to Roketin Engine API
     */

    $menu = Roketin::menu()->show('asc-123123-asxzc')->get();
    $page = Roketin::page()->show('home')->get();
    $post = Roketin::post()->show('lastest-update')->get();
```

## Show

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

Get free shipping information

```php
    $freeShipping = Roketin::shipping()->freeShipping()->show();
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

Get all available Expedition:

```php
    $expeditions = Roketin::expedition()->service()->list()->get();
```

Get Delivery Cost (Deprecated, use expedition service - cost below instead)

```php
    $delivery = [
        'origin'        => '501',
        'destination'   => '574',
        'weight'        => 1700,
        'courier'       => 'jne'
    ];

    $expeditions = Roketin::expedition()->cost($delivery);
```

Get Delivery Cost
this version of Get Delivery Cost has been implemented with freeshipping support

```php
    $delivery = [
            "origin" => "78",
            "originType" => "city",
            "destination" => "153",
            "destinationType" => "city",
            "weight" => 1700,
            "courier" => "jne",
            "service" => "YES",
            "purchase" => 8000000
        ];
    $expeditions = Roketin::expedition()->service()->cost($delivery);
    if ($expeditions->meta->status_code == 202) {
        //Covered by freeshipping
    }
```

## Bank

Get all available Bank:

```php
    $expeditions = Roketin::bank()->list()->get();
```

## Order

Create sales order:

```php
    /**
     * @param array $generalData
     * @param array $customerData
     * @param array $products
     * @param $bcc(optional), default = null
     */

    $order = [
        "member_id"             => "5b55af8c6f6bfc0c74007955",
        "order_at"              => "2009-09-09",
        "is_create_invoice"     => true,
        "due_date_invoice"      => "2009-09-09",
        "message_from_customer" => "pesan",
        "name"                  => "adin",
        "email"                 => "test@gmail.com",
        "phone"                 => "123123123",
        "address"               => "Bandung",
        "send_invoice"          => true,
        "shipping"              => true,
        "expedition_code"       => "jne",
        "service_code"          => "oke",
        "discounts"             => 10000,
        "voucher_code"          => "voucher12009",
        "tax"                   => 10,
        "shipping_cost"         => 0,
        "sender_id"             => "5b3309076f6bfc0460000b73",
        "products"              =>[
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
>
> - For detailed attribute, see sales order API documentation [HERE](http://docs.rengine.apiary.io/#reference/sales-order/sales-order)

---

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
    /**
     * @param $sender_name
     * @param $sender_email
     * @param $sender_phone
     * @param $message_title
     * @param $message_body
     * @param $bcc(optional), default = null
     * @param $send_message(optional), default = false
     */

    $msg = Roketin::message()->send(
                    'test',
                    'test@mailinator.com',
                    '123123',
                    'test mesage',
                    'hai',
                    ['bcc@mailinator.com'],
                    false
    );
```

## Subscribe

Send a Subscribe to Roketin Engine Subscribe:

```php
    /**
     * @param $email
     */

    $msg = Roketin::subscribe()->send('test@mailinator.com')
```

## Vouchers

Check validity of a voucher:

```php
    /**
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

<!-- # Auth

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
>
> - you can also use where(), orWhere(), etc query with this method -->

## Member

Register new member

```php
    /*
    * REGISTER
    *
    * register() will return a RMember class which you can use to futher manipulate member
    * register() will throw \Exception if something went wrong (Eg:email already used)
    */
    $register_data = [
        'first_name' => 'Ali', //required
        'last_name' => 'of Ababwa',
        'email' => 'ali@ababwa.com', //required
        'password' => 'secretPassword123!', //required
        'password_confirmation' => 'secretPassword123!', //required
        'addresses' => [ //addresses can be empty [] or null
            [
                'address_type' => 'perkantoran', //address_type can be anything, will be created if not yet exist
                'address' => 'Jl. Asia Afrika No.116, RW.01, Paledang, Kec. Lengkong, Kota Bandung, Jawa Barat 40261',
                'country' => [
                    'label' => 'Indonesia',
                    'value' => 'ID'
                ],
                'province' => [
                    'label' => 'Jawa Barat',
                    'value' => '9'
                ],
                'city' => [
                    'label' => 'Kota Bandung',
                    'value' => '23'
                ],
                'district' => [
                    'label' => 'Kota Cibiru',
                    'value' => '352'
                ],
                'postal_code' => '40524',
                'direction' => 'Depan simpang lima kiri',
                'coordinate' => [
                    'lat' => 12.1232323,
                    'lng' => 23.1232434
                ],
                'main_address' => true,
                'active_status' => true,
                'store_address' => false,
            ], [ //One member can have more than one address
                'address_type' => 'pantai',
                'address' => 'Pangandaran Beach',
                'country' => [
                    'label' => 'Indonesia',
                    'value' => 'ID'
                ],
                'province' => [
                    'label' => 'Jawa Barat',
                    'value' => '9'
                ],
                'city' => [
                    'label' => 'Kota Bandung',
                    'value' => '23'
                ],
                'district' => [
                    'label' => 'Kota Cibiru',
                    'value' => '352'
                ],
                'postal_code' => '40524',
                'direction' => 'Lurus terus',
                'coordinate' => [
                    'lat' => 12.1232323,
                    'lng' => 23.1232434
                ],
                'main_address' => false,
                'store_address' => true,
                'active_status' => true,
            ]
        ],
        'contacts' => [ //contact can be empty or null
            [ //shown bellow are list of all posible contact
                "contact_type" => 1, //phone number
                "phone_number" => "081111112222",
                "emergency_contact" => true,
                "whatsapp" => true,
                "line" => true,
                "main_contact" => true,
                "active_status" => true
            ], [
                'contact_type' => 2, //email
                'email' => 'athuria@pendragon.com',
                'main_contact' => true,
                'active_status' => true
            ], [
                "contact_type" => 3, //skype
                "skype_id" => "1231243132134213",
                "main_id" => true,
                "active_status" => true,
            ], [
                "contact_type" => 4, //website
                "url" => "https://www.google.com",
                "active_status" => true,
            ], [
                "contact_type" => 5, //contact Person
                "name" => "Eve",
                "position" => "Secretary",
                "start_date" => "2019-08-01 15:03:00",
                "end_date" => "2019-08-17 15:03:00",
                "until_now" => true,
                "description" => "lorem ipsum"
            ]
        ]
    ];
    try {
        $member = Roketin::member()->register($register_data);
    } catch(\Exception $exception) {
        return response()->json(json_decode($exception->getMessage()));
    }

    //If you want roketin to automagicaly send email confirmation and handle it for you, set the second argument of register() to true

    try {
        $member = Roketin::member()->register($register_data, true);
    } catch(\Exception $exception) {
        return response()->json(json_decode($exception->getMessage()));
    }

    //You can ask roketin to resend email confirmation by using

    $respone = $member->resendEmail();

    //If you don't set it to true you need to handle email confirmation yourself by following these instruction;
    //1. register() will throw an exception telling you that register has succeded. In the response thrown by register() will also be information about member_id and email_confirmation_token, you will use it for the next step
    //2. you would want to send a custom email to the member that contail link with format '{your-custom-url}/handle-confirmation/{id}/{token}' just like forgot password
    //3. In the aforementioned link, you would want to call

    $response = Roketin::member()->handleEmailConfirmation($id, $token);

    //stellar will handle the rest
```

Login member by email

```php
    /*
     * LOGIN
     * Login App
     *
     * Login() will return a RMember class which you can use to manipulate member
     * login() will throw \Exception if something went wrong (Eg:wrong credential)
     */
    $credential = [
        'email' => 'ali@ababwa.com',
        'password' => 'secretPassword123!'
    ];

    try {
        $member = Roketin::member()->login($credential);
    } catch(\Exception $exception) {
        return response()->json(json_decode($exception->getMessage()));
    }

    //You can get RMember class for client's current session by using member - getSession
    //NOTE : The routes that call register, login, getSession, and logout have to be within the 'web' middleware group in order to use these feature below AND DONT disrupt the application flow like using dd() or die()

    try {
        $member = Roketin::member()->getSession();
    } catch(\Exception $exception) {
        return response()->json(json_decode($exception->getMessage()));
    }

    //And log out by using member - logout
    $response = Roketin::member()->logout();
```

Get member detail

```php
    /*
     * SHOW
     * There's two way you can get member's detail;
     */
    //1. By its id
    $member_data = Roketin::member()->show('5d4a9d3ca051e83db4000148')->get();
    //2. Or, by its object
    $member_data = $member->show()->get();
```

Update member's profile

```php
    /*
     * UPDATE PROFILE
     *
     * There's also two way you can change member's detail
     * Note : To change its contact, and address, use their respective update method
     * update() will throw \Exception if something went wrong (Eg:wrong field)
     */
    $change_data = [
        'first_name' => 'Ali',
        'last_name' => 'of Ababwa',
    ];

    try {
        //1. By its id
        Roketin::member()->update($change_data, '5d4a9d3ca051e83db4000148');
        //2. Or, by its object
        $member->update($change_data);
    } catch(\Exception $exception) {
        return response()->json(json_decode($exception->getMessage()));
    }
```

Change member's password

```php
    /*
     * CHANGE PASSWORD
     *
     * changePassword() will throw \Exception if something went wrong (Eg:failed password confirmation)
     */
    $change_data_pass = [
        'old_password' => 'secretPassword123*',
        'new_password' => 'secretPassword123*',
        'new_password_confirmation' => 'secretPassword123*'
    ];

    try {
        $member->changePassword($change_data_pass);
    } catch(\Exception $exception) {
        return response()->json(json_decode($exception->getMessage()));
    }
```

Forgot password handler

```php
    /*
     * Member - Forgot Password
     *
     * forgotPassword() will return member_id and a token to be used in handle forgot_password
     * if you want stellar to automagically send email and handle forgot password for you, set $send_email to true
     * forgotPassword() will throw \Exception if something went wrong (Eg: invalid email)
     */
    try {
        $credential = Roketin::member()->forgotPassword('ali@ababwa.com');
    } catch(\Exception $exception) {
        return response()->json(json_decode($exception->getMessage()));
    }

    //You would want to send an email that carries $credential.user_id, $credential.token and a link to a website that handle forgot password request,
    //There you would want to call this method using the aforementioned values in $credential as parameters

    $params = [
        'new_password' => 'notSoSecret123!',
        'new_password_confirmation' => 'notSoSecret123!',
    ];
    try {
        Roketin::member()->handleForgotPassword($params, $credential->data->user_id, $credential->data->token);
    } catch(\Exception $exception) {
        return response()->json(json_decode($exception->getMessage()));
    }
```

Get Order History of a Member

```php
    $order = $member->salesOrder()->list()->get();
```

## Member-Address

Get member's addresses

```php
    /*
     * INDEX
     *
     * There's two way you can index address
     * Everything else is as usual
     */
    //1. Show all address recorded for your company
    $address_data = Roketin::address()->list()->get();

    //2. Show only the address that a member have
    $address_data = $member->address()->list()->get();
```

Show detailed member's addresses one by one

```php
    /*
     * SHOW
     * Show the detailed information of an address
     *
     * There's two way you can show address
     * Everything else is as usual
     */
    //1. Show resource as usual
    $address_data = Roketin::address()->show('5d4a9d3ca051e83db4000149')->get();

    //2. Just like above, but with stricker security, only member that have the address can show the resource
    $address_data = $member->address()->show('5d4a9d3ca051e83db4000149')->get();
```

Store a new address for a member

```php
    /*
     * STORE
     * Store an address to scm and pair it with the designated member
     *
     * There's two way you can store address
     */
    $params = [
        'address_type' => 'perkantoran',
        'address' => 'TAIPEI 102, 101th floor',
        'country' => [
            'label' => 'Indonesia',
            'value' => 'ID'
        ],
        'province' => [
            'label' => 'JAWA BARAT',
            'value' => '32'
        ],
        'city' => [
            'label' => 'KABUPATEN BANDUNG',
            'value' => '3204'
        ],
        'district' => [
            'label' => 'CIDEWAY',
            'value' => '3204010'
        ],
        'postal_code' => '40524',
        'direction' => 'Bunderan tamrin jangan belok belok',
        'coordinate' => [
            'lat' => 12.1232323,
            'lng' => 23.1232434
        ],
        'main_address' => false,
        'store_address' => false,
        'active_status' => true,
    ];
    //1. Using member's id
    $result = Roketin::address()->store($params, '5d4a9d3ca051e83db4000148');
    //2. Using member's object
    $result = $member->address()->store($params);
```

Update an existing address of a member

```php
    /**
     * UPDATE
     * Update an address
     *
     * There's two way you can store address,
     * But both requires address_id as parameters
     * because member - address is one - many relationship
     */
    $params = [
        'address' => 'TAIPEI 101, 101th floor penthouse',
        'main_address' => true,
        'store_address' => false,
    ];
    //1. Directly using Roketin Facade
    $result = Roketin::address()->update($params, '5d503a1ca051e83c50001ff3');
    //2. Using member's object, same as above but with more security,
    //   only address coresponding member can update/change it
    $result = $member->address()->update($params, '5d41343aa051e856940024aa');
```

Delete an existing address of a member

```php
    /**
     * DESTROY
     * Delete an address from the database
     *
     * There's two way you can store address,
     * But both requires address_id as parameters
     * because member - address is one - many relationship
     */
    //1. Directly using Roketin Facade
    $result = Roketin::address()->destroy('5d4d4608a051e83e28004a03');

    //2. Using member's object, same as above but with more security,
    //   only address coresponding member can update/change it
    $result = $member->address()->destroy('5d3e7f9ca051e8bb8400ca00');
```

## Member Contact

Get member's contact

```php
   /*
    * INDEX
    *
    * There's two way you can index contact
    * Everything else is as usual
    */
    //1. Show all contact recorded for your company
    $contact_data = Roketin::contact()->list()->get();

    //2. Show only the contact that a member have
    $contact_data = $member->contact()->list()->get();
```

Get contact's delailed information

```php
    /*
     * SHOW
     * Show the detailed information of a contact
     *
     * There's two way you can show contact
     * Everything else is as usual
     */
    //1. Show resource as usual
    $contact_data = Roketin::contact()->show('5d523b89a051e83aa4006b16')->get();

    //2. Just like above, but with stricker security, only member that have the contact can show the resource
    $contact_data = $member->contact()->show('5d523b89a051e83aa4006b16')->get();
```

Store a new contact for a member

```php
    /*
     * STORE
     * Store a contact to scm and pair it with the designated member
     *
     * There's two way you can store address
     */
    //Shown below are the alternatives for member store parameter
    $params = [
        "contact_type" => 1, //phone number
        "phone_number" => "081111112222",
        "emergency_contact" => true,
        "whatsapp" => true,
        "line" => true,
        "main_contact" => true,
        "active_status" => true
    ];
    $params = [
        'contact_type' => 2, //email
        'email' => 'athuria@pendragon.com',
        'main_contact' => true,
        'active_status' => true
    ];
    $params = [
        "contact_type" => 3, //skype
        "skype_id" => "1231243132134213",
        "main_id" => true,
        "active_status" => true,
    ];
    $params = [
        "contact_type" => 4, //website
        "url" => "https://www.google.com",
        "active_status" => true,
    ];
    $params = [
        "contact_type" => 5, //Contact Person
        "name" => "Eve",
        "position" => "Secretary",
        "start_date" => "2019-08-01 15:03:00",
        "end_date" => "2019-08-17 15:03:00",
        "until_now" => true,
        "description" => "lorem ipsum"
    ];

    //1. Using member's id
    $result = Roketin::contact()->store($params, '5d4a9d3ca051e83db4000148');
    //2. Using member's object
    $result = $member->contact()->store($params);
```

Update an existing contact of a member

```php
    /**
     * UPDATE
     * Update a contact
     *
     * There's two way you can store contact,
     * But both requires address_id as parameters
     * because member - contact is one - many relationship
     */
    $params = [
        'contact_type' => 2,
        'email' => 'athuria@pendragon.com',
        'main_contact' => true,
        'active_status' => true
    ];
    //1. Directly using Roketin Facade
    $result = Roketin::contact()->update($params, '5d503a1ca051e83c50001ff3');
    //2. Using member's object, same as above but with more security,
    //   only contact's coresponding member can update/change it
    $result = $member->contact()->update($params, '5d41343aa051e856940024aa');
```

Delete an existing contact of a member

```php
    /**
     * DESTROY
     * Delete a contact from the database
     *
     * There's two way you can store contact,
     * But both requires contact_id as parameters
     * because member - contact is one - many relationship
     */
    //1. Directly using Roketin Facade
    $result = Roketin::contact()->destroy('5d4d4608a051e83e28004a03');

    //2. Using member's object, same as above but with more security,
    //only contact's coresponding member can update/change it
    $result = $member->contact()->destroy('5d3e7f9ca051e8bb8400ca00');
```

## Member-Wishlist

Fetching wishlist :

```php
    /*
    * INDEX
    *
    * There's two way you can fetch contact
    * Everything else is as usual
    */
    //1. Show all wishlist recorded for your company
    $wishlist = Roketin::wishlist()->list()->get();

    //2. Show only the wishlist that a member have
    $wishlist = $member->wishlist()->list()->get();
```

Fetching wishlist with simple where conditions:

```php
    /**
     * @param $user_id
     */

    $wishlist = Roketin::wishlist()
                        ->list()
                        ->where('variant_id','like','abc1234')
                        ->get();
```

Add new wishlist:

```php
    /**
     * STORE
     * Store a contact to scm and pair it with the designated member
     *
     * There's two way you can store wishlist
     * @param $user_id
     * @param $variant_id
     */

    $data = [
        "variant_id" => "5b55af8c6f6bfc0c74007955",
    ];
    // By member's id
    $wishlist = Roketin::wishlist()->store($data, '5b55af8c6f6bfc0c74007955');

    // By its object
    $wishlist = $member->store($data);
```

Delete wishlist:

```php
    /**
     * Delete
     * Delete wishlist of a member
     *
     * There's two way you can store wishlist
     * @param $user_id
     * @param $variant_id
     */

    $data = [
        "variant_id" => "5b55af8c6f6bfc0c74007955",
    ];

    $wishlist = Roketin::wishlist()->delete($data, '5b55af8c6f6bfc0c74007955');
    //or
    $wishlist = $member->wishlist()->delete($data);
```

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
