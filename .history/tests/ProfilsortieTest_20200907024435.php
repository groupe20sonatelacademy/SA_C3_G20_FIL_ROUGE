<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfilsortieTest extends WebTestCase
{


 // on se connecte
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

   // on teste la liste de profils de sortie 
  public function testListProfilsortie()
  {
    $client = $this->createAuthenticatedClient("adrien84", "password");
    $client->request('GET', '/api/admin/profilsorties');
   // dd($client->getResponse()->getStatusCode());jjjj
    $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
  }

   // on teste l'affichage des apprenants d'un profils de sortie d'une promo
    public function testGetProfilsortieAtPromo()
    {
        $client = $this->createAuthenticatedClient("adrien84","password");
        $client->request(
            'GET',
            '/api/admin/promos/20/profilsorties/354',
             
         );
       
    $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

 // On teste l'affichage des apprenants d'une promo par profils de sortie
  public function testGetApprenantAtPromo()
  {
    $client = $this->createAuthenticatedClient("adrien84", "password");
    $client->request(
      'GET',
      '/api/admin/promos/20/profilsorties',

    );

    $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
  }


}
