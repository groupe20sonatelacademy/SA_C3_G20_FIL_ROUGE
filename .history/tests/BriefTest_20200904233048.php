<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class BriefTest extends Test{



protected function createAuthenticatedClient(string $username, string $password): KernelBrowser
  {
      $client = static::createClient();
      $client->request(
          'POST',
          '/api/login_check',
           [],
           [],
          ['CONTENT_TYPE' => 'application/json'],
          '{
              "login":"djiby",
              "password":"pass123"
          }'
       );
      $data = \json_decode($client->getResponse()->getContent(), true);
      $client->setServerParameter('HTTP_Authorization', \sprintf('Bearer %s', $data['token']));
      $client->setServerParameter('CONTENT_TYPE', 'application/json');
      return $client;
  }
public function testListProfil()
  {
      $client = $this->createAuthenticatedClient("djiby","pass123");
      $client->request('GET', '/api/profils');
      $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
  }
  public function testCreateProfil()
  {
      $client = $this->createAuthenticatedClient("djiby","pass123");
      $client->request(
          'POST',
          '/api/profils',
           [],
           [],
          ['CONTENT_TYPE' => 'application/json'],
           '{
              "libelle": "Profil_Nouveau"
            }'
       );
       $responseContent = $client->getResponse();
      $responseDecode = json_decode($responseContent);
        $this->assertEquals(Response::HTTP_OK,$responseContent->getStatusCode());
       $this->assertJson($responseContent);
       $this->assertNotEmpty($responseDecode);
  }

}

