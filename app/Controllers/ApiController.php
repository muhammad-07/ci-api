<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\CURLRequest;

class ApiController extends BaseController
{
    public function register()
    {        
        $requestData = [
            'mobileNumber' => $this->request->getGet('mo')
        ];
        return $this->sendRequest(env('TB_GET_CUSTOMER'), $requestData);
    }
    public function verifyOTP()
    {        
        $requestData = [
            'mobileNumber' => $this->request->getGet('mo'),
            'otp' => $this->request->getGet('otp'),
            'name' => 'Test'
        ];
        return $this->sendRequest(env('TB_VERIFY'), $requestData);
    }
    public function addBeneficiary()
    {        
        $requestData = [
            'mobileNumber' => $this->request->getGet('mo'),
            'name' => 'Test Ben',
            'accountNumber' => '245646126456541',
            'bankCode' => 'ICIC',
            'ifscCode' => 'UTIB0000025',
            'beneficiaryMobileNumber' => '9721548751',
        ];
        return $this->sendRequest(env('TB_ADD_BEN'), $requestData);
    }
    public function listBeneficiary()
    {        
        $requestData = [
            'mobileNumber' => $this->request->getGet('mo')
        ];
        return $this->sendRequest(env('TB_BEN_LIST'), $requestData); //TE132120240525180627
    }
    public function fundTransfer()
    {              
        $requestData = [
            'mobileNumber' => $this->request->getGet('mo'),
            'benId' => 'TE132120240525180627',
            'amount' => '5000',
            'transactionMode' => 'IMPS',
            'order_id' => mt_rand(),
            'submerchantid' => 'test',
           
        ];
        return $this->sendRequest(env('TB_FUND_TRANSFFER'), $requestData);
    }
    public function sendRequest($urlSection, $requestData = [])
    {
        $client = \Config\Services::curlrequest();
        
        $data = [
            'secret_key' => env('TB_API_KEY')            
        ];
        $data = array_merge($data, $requestData);
        $response = $client->post(env('TB_API_URL') . $urlSection, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);
        $responseBody = $response->getBody();
        return $this->response->setJSON([
            'response' => json_decode($responseBody, true)
        ]);
    }
}