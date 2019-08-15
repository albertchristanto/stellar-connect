<?php

namespace Roketin;

use Config;
use Illuminate\Http\Request;

class Roketin
{
    protected $member_token;
    public $member_id;

    // Test Change

    /**
     * @var mixed
     */
    protected $client;
    /**
     * @var mixed
     */
    protected $encrypter;

    /**
     * @var mixed
     */
    protected $retval;

    /**
     * @var mixed
     */
    protected $routes;

    /**
     * @var mixed
     */
    protected $endPoint;

    /**
     * @var mixed
     */
    public $filters = [];

    public function __construct()
    {
        $this->retval    = null;
        $this->client    = new \GuzzleHttp\Client();
        // $this->encrypter = new \Illuminate\Encryption\Encrypter(Config::get('roketin.encryption_key'), 'AES-256-CBC');
    }

    /**
     * @param $func
     * @param $args
     */
    public function __call($func, $args)
    {
        $meth   = $this->fetch($this->_camelToSnake($func), $args);
        $result = self::get();

        if (isset($result->errors)) {
            return false;
        }

        return $this;
    }

    /**
     * @param $str
     */
    public function fetch($str, $args)
    {
        $this->routes = empty($args) ? $str . "?" : rtrim($str, "s") . '/' . $args[0];
    }

    /**
     * raw API query
     * @param $params
     */
    public function raw($route, $params = null, $method = 'GET')
    {
        $this->retval = $this->callAPI($route, $params, $method);
        return $this;
    }

    /**
     * @param $field
     * @param $operator
     * @param $value
     * @return mixed
     */
    public function where($field, $operator = null, $value)
    {
        $filter = [
            "column"    => $field,
            "value"     => $value
        ];

        if (!is_null($operator)) {
            $filter["operator"]  = $operator;
        }

        array_push($this->filters, $filter);

        return $this;
    }

    /**
     * @param $field
     * @param $operation
     * @param $value
     * @return mixed
     */
    public function orWhere($field, $operator, $value)
    {
        $filter = [
            "column"    => $field,
            "value"     => $value,
            "operand"   => 'or'
        ];

        if (!is_null($operator)) {
            $filter["operator"]  = $operator;
        }

        array_push($this->filters, $filter);

        return $this;
    }

    /**
     * @param $field
     * @param $direction
     * @return mixed
     */
    public function sortBy($field, $direction = "ASC", $relation = null)
    {
        // INDEX
        $sorts = [
            "column"    => $field,
            "by"        => (strtoupper($direction) == 'ASC' ? 'ASC' : 'DESC')
        ];

        if (!is_null($relation)) {
            $sorts['relation'] = $relation;
        }

        $this->routes .= "sorts[]=" . json_encode($sorts) . '&';

        return $this;
    }

    /**
     * @param $page
     * @param $page
     * @return mixed
     */
    public function paginate($per_page = 10, $page = 1)
    {
        $this->routes .= "paginate=1&per_page=" . $per_page . "&page=" . $page . '&';

        return $this;
    }

    /**
     * @return mixed
     */
    public function random()
    {
        $this->routes .= "random=true&";

        return $this;
    }

    /**
     * @param $suggestion_size
     * @return mixed
     */
    public function suggestion($suggestion_size = 10)
    {
        $this->routes .= "suggestion=" . $suggestion_size . '&';

        return $this;
    }

    /**
     * @param $field
     * @return mixed
     */
    public function groupBy($field)
    {
        $this->routes .= "group[]=" . $field . '&';

        return $this;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        $this->recapFilters();

        return is_null($this->retval) ? $this->callAPI($this->routes) : $this->retval;
    }

    /**
     * @param $take
     */
    public function take($take = 10)
    {
        $this->routes .= "take=" . $take . '&';

        return $this;
    }

    /**
     * @return mixed
     */
    public function tags($tag = null)
    {
        $tag = json_encode($tag);

        $this->routes .= 'tag=' . $tag . '&';

        return $this;
    }

    public function recapFilters()
    {
        $this->routes .= "filters=" . json_encode($this->filters) . '&';
    }

    /**
     * @return mixed
     */
    public function archives($tags = null, $year = '2016')
    {
        return $this->callAPI("archives/". $year, ["tags" => $tags], "GET");
    }

    public function variantsByCategory($category)
    {
        $this->routes = 'variants/' . $category . '?';
        return $this;
    }

    public function categories($category)
    {
        $category = json_encode($category);

        $this->routes .= 'category=' . $category . '&';

        return $this;
    }

    /**
     * @return mixed
     */
    public function member() 
    {
        return new RMember();
    }

    public function address()
    {
        return new RAddress($this->member_id, $this->member_token);
    }

    public function contact()
    {
        return new RContact($this->member_id, $this->member_token);
    }

    public function wishlist()
    {
        return new RWishlist($this->member_id, $this->member_token);
    }

    public function salesOrder()
    {
        return new RSalesOrder($this->member_id, $this->member_token);
    }

    public function shipping()
    {
        return new RShipping();
    }

    public function expedition()
    {
        return new RExpedition();
    }

    public function expeditionService()
    {
        return new RExpeditionService();
    }

    public function payment()
    {
        return new RPayment();
    }

    public function message()
    {
        return new RMessage();
    }

    public function voucher()
    {
        return new RVoucher();
    }

    public function auth()
    {
        return new RAuth();
    }

    public function user()
    {
        return new RUser();
    }

    public function b2b()
    {
        return new RB2b();
    }

    public function menu()
    {
        return new RMenu();
    }

    public function page()
    {
        return new RPage();
    }

    public function post()
    {
        return new RPost();
    }

    public function country()
    {
        return new RCountry();
    }

    public function province()
    {
        return new RProvince();
    }

    public function city()
    {
        return new RCity();
    }

    public function district()
    {
        return new RDistrict();
    }

    public function subDistrict()
    {
        return new RSubDistrict();
    }

    public function image()
    {
        return new RImage();
    }

    public function product()
    {
        return new RProduct();
    }

    public function variant()
    {
        return new RVariant();
    }

    public function category()
    {
        return new RCategory;
    }

    public function subscribe()
    {
        return new RSubscribe;
    }

    public function bank()
    {
        return new RBank;
    }

    public function categoryPost()
    {
        return new RCategoryPost;
    }

    public function socialMedia()
    {
        return new RSocialMedia;
    }

    public function company()
    {
        return new RCompany;
    }

    /**
     * @return mixed
     */
    protected function getIP()
    {
        $ip = getenv('HTTP_CLIENT_IP') ?:
        getenv('HTTP_X_FORWARDED_FOR') ?:
        getenv('HTTP_X_FORWARDED') ?:
        getenv('HTTP_FORWARDED_FOR') ?:
        getenv('HTTP_FORWARDED') ?:
        getenv('REMOTE_ADDR');
        return $ip;
    }

    /**
     * @param $route
     * @param $extraParam
     * @param null $method
     */
    protected function callAPI($route, $extraParam = null, $method = "GET", $is_file = false)
    {
        try {
            if (!$is_file) {
                if (isset($this->member_token)) {
                    $headers = [
                        "api-key"           => Config::get('roketin.api-key'),
                        "member-key"        => $this->member_token,
                        "Content-Type"      => "application/vnd.api+json",
                        "Content-Length"    => 0,
                    ];
                } else {
                    $headers = [
                        "api-key"           => Config::get('roketin.api-key'),
                        "Content-Type"      => "application/vnd.api+json",
                        "Content-Length"    => 0,
                    ];
                }
                $response = $this->client->request($method, Config::get('roketin.api') . $this->endPoint . $route, [
                    'body'    => json_encode($extraParam),
                    'headers' => $headers,
                ]);
            } else {
                $response = $this->client->request($method, Config::get('roketin.api') . $this->endPoint . $route, [
                    'multipart' => $extraParam,
                    'headers' => [
                        "api-key"           => Config::get('roketin.api-key')
                    ],
                ]);
            }
            return json_decode($response->getBody()->getContents());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if (is_null($e->getResponse())) {
                throw new \Exception($e->getMessage(), 422);
            }
            return json_decode($e->getResponse()->getBody()->getContents());
        } catch (\Exception $e) {
            return json_decode($e->getMessage());
        }
    }

    /**
     * @param $val
     */
    protected function _camelToSnake($val)
    {
        return preg_replace_callback('/[A-Z]/',
            function($match){
                return "_" . strtolower($match[0]);
            },
            $val);
    }
}
