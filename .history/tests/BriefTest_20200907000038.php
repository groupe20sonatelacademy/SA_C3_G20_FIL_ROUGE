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
              "username":"djiby",
              "password":"password"
          }'
       );
      $data = \json_decode($client->getResponse()->getContent(), true);
      $client->setServerParameter('HTTP_Authorization', \sprintf('Bearer %s', $data['token']));
      $client->setServerParameter('CONTENT_TYPE', 'application/json');
      return $client;
  }
public function testListProfilsortie()
  {
      $client = $this->createAuthenticatedClient("adrien84","password");
      $client->request('GET', '/api/profilsorties');
      $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
  }
  public function testCreateProfilsortie()
  {
      $client = $this->createAuthenticatedClient("adrien84","password");
      $client->request(
          'POST',
          '/api/profilsorties',
           [],
           [],
          ['CONTENT_TYPE' => 'application/json'],
           '{
              "libelle": "Profilsortie_Nouveau"
            }'
       );
       $responseContent = $client->getResponse();
      $responseDecode = json_decode($responseContent);
        $this->assertEquals(Response::HTTP_OK,$responseContent->getStatusCode());
       $this->assertJson($responseContent);
       $this->assertNotEmpty($responseDecode);
  }

}

