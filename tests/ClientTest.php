<?php

namespace TochkaApi\Tests;

use TochkaApi\Exceptions\TochkaApiClientException;
use PHPUnit\Framework\TestCase;
use TochkaApi\HttpAdapters\CurlHttpClient;
use TochkaApi\TochkaApi;

class ClientTest extends TestCase
{

    public function testExclude() {
        $this->assertTrue(true);
    }

    /**
    * @group api-call
     * @throws TochkaApiClientException
    */
   public function testClient() {
        if (!file_exists(__DIR__ . '/TochkaTestCredentials.php')) {
            throw new TochkaApiClientException(
            'You must create a TochkaTestCredentials.php file from TochkaTestCredentials.php.dist'
            );
        } else {
            require_once "TochkaTestCredentials.php";
        }

        if (!strlen(TochkaTestCredentials::$JWT)) {
            throw new TochkaApiClientException(
            'You must fill out TochkaTestCredentials.php'
            );
        }

        $client = new TochkaApi("", "", new CurlHttpClient, false);
        $client->setAccessToken(TochkaTestCredentials::$JWT);

        $organizations = $client->organization()->list();
        $this->assertNotEmpty($organizations);

        foreach ($organizations as $organization) {
            $this->assertObjectHasAttribute("accounts", $organization);
        }

       $accounts = $client->account()->list();
       $this->assertNotEmpty($accounts);

       foreach ($accounts as $account) {
           $this->assertObjectHasAttribute("bank_code", $account);
       }
   }
}