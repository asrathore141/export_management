<?php

/**
* PHP implementation of BulkSMS Service
* Client
* Service Provider http://bulksms-service.com
*
* @package BulkSMS
* @author Rakesh Kumar Shardiwal <rakesh.shardiwal@gmail.com>
* @dependency JSON-RPC 2.0
*/

include_once('JsonRpcClient.php');

class BulkSMS extends CApplicationComponent
{
    public $params = array();

    public static $VERSION = 1.0;
    /**
     * Some URL constants
     */
    const BASE_URL              = 'http://ht.bulksms1.com/api';
    const SMS_URL               = '/web2sms.php';
    const DELIVERY_STATUS_URL   = '/status.php';
    const BALANCE_CHECK_URL     = '/credits.php';

    /**
     * Some service properties
     *
     * @var string
     * @access public
     */
    public $_client, $_api_url, $api_key, $senderId;

    /**
     * Set some values for BulkSMS::properties
     *
     * @param array $args
     */
    public function init() {
        foreach ( array('api_key','senderId') as $key ) {
            if ( array_key_exists($key,$this->params) ){
                $this->$key = $this->params[$key];
            }
        }
        //request the instance
        $this->_client   = new JsonRpcClient();
        $this->_api_url  = BulkSMS::BASE_URL;
    }

    public function balance()
    {
        $account = new stdClass;
        $account->url = array(BulkSMS::BALANCE_CHECK_URL);
        $account->params = array(
            'workingkey' => $this->api_key
        );
        return $this->api( $this->buildURL($account) );
    }

    public function send_sms( $mobile_no, $message )
    {
        $sms = new stdClass;
        $sms->url = array(BulkSMS::SMS_URL);
	$mobile_no = preg_replace('/\s+/','',$mobile_no);
        $sms->params = array(
            'workingkey'    => $this->api_key,
            'sender'        => $this->senderId,
            'message'       => urlencode($message),
            'to'            => $mobile_no
        );
        return $this->api( $this->buildURL($sms) );
    }

    private function api($url, $post = false, $postData = array())
    {
        $this->_client->setURL($url);
        $result = $this->_client->rawcall($postData, $post);
        return $result;
    }

    private function buildURL($requestData)
    {
        $url = $this->_api_url;
        if (isset($requestData->url)) {
            $url .= implode('/', $requestData->url);
        }

        if (isset($requestData->params)) {
            $url .= "?";
            $extraParam = array();

            foreach ($requestData->params as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $val) {
                        $extraParam[] = $key . "=" . $val;
                    }
                }
                else {
                    $extraParam[] = $key . "=" . $value;
                }
            }
            $url .= implode("&", $extraParam);
        }
        return $url;
    }

    private function throwException($message = null,$code = null) {
        echo "Error $code: $message";
        die();
    }

}
