<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfilsortieTest extends WebTestCase
{



  protected function createAuthenticatedClient(string $username, string $password): KernelBrowser
  {
    $client = static::createClient();
    $connexion = [
      "username" => $username,
      "password" => $password
    ];
    $client->request(
      'POST',
      '/api/login_check',
      [],
      [],
      ['CONTENT_TYPE' => 'application/json'],
      json_encode($connexion)
    );
    $data = \json_decode($client->getResponse()->getContent(), true);
    $client->setServerParameter('HTTP_Authorization', \sprintf('Bearer %s', $data['token']));

    $client->setServerParameter('CONTENT_TYPE', 'application/json');
    return $client;
  }
  public function testListProfilsortie()
  {
    $client = $this->createAuthenticatedClient("adrien84", "password");
    $client->request('GET', '/api/admin/profilsorties');
   // dd($client->getResponse()->getStatusCode());jjjj
    $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
  }
    public function testCreateProfilsortie()
    {
        $client = $this->createAuthenticatedClient("adrien84","password");
        $client->request(
            'POST',
            '/api/admin/profilsorties',
             [],
             [],
            ['CONTENT_TYPE' => 'application/json'],
             '{
                "libelle": "yayefallDev"
              }'
         );
         $responseContent = $client->getResponse();
         $this->assertEquals(Response::HTTP_OK,$responseContent->getStatusCode());
       
    }

    

}
