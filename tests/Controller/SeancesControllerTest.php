<?php

namespace App\Tests\Controller;

use App\Entity\Seances;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SeancesControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/seances/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Seances::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Seance index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'seance[date_seance]' => 'Testing',
            'seance[heure_debut]' => 'Testing',
            'seance[heure_fin]' => 'Testing',
            'seance[id_salle]' => 'Testing',
            'seance[id_film]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Seances();
        $fixture->setDate_seance('My Title');
        $fixture->setHeure_debut('My Title');
        $fixture->setHeure_fin('My Title');
        $fixture->setId_salle('My Title');
        $fixture->setId_film('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Seance');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Seances();
        $fixture->setDate_seance('Value');
        $fixture->setHeure_debut('Value');
        $fixture->setHeure_fin('Value');
        $fixture->setId_salle('Value');
        $fixture->setId_film('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'seance[date_seance]' => 'Something New',
            'seance[heure_debut]' => 'Something New',
            'seance[heure_fin]' => 'Something New',
            'seance[id_salle]' => 'Something New',
            'seance[id_film]' => 'Something New',
        ]);

        self::assertResponseRedirects('/seances/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate_seance());
        self::assertSame('Something New', $fixture[0]->getHeure_debut());
        self::assertSame('Something New', $fixture[0]->getHeure_fin());
        self::assertSame('Something New', $fixture[0]->getId_salle());
        self::assertSame('Something New', $fixture[0]->getId_film());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Seances();
        $fixture->setDate_seance('Value');
        $fixture->setHeure_debut('Value');
        $fixture->setHeure_fin('Value');
        $fixture->setId_salle('Value');
        $fixture->setId_film('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/seances/');
        self::assertSame(0, $this->repository->count([]));
    }
}
