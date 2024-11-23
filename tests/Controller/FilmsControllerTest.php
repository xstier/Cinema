<?php

namespace App\Tests\Controller;

use App\Entity\Films;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FilmsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/films/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Films::class);

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
        self::assertPageTitleContains('Film index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'film[titre]' => 'Testing',
            'film[description]' => 'Testing',
            'film[age_mini]' => 'Testing',
            'film[note]' => 'Testing',
            'film[coup_coeur]' => 'Testing',
            'film[genre]' => 'Testing',
            'film[affiche]' => 'Testing',
            'film[duree]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Films();
        $fixture->setTitre('My Title');
        $fixture->setDescription('My Title');
        $fixture->setAge_mini('My Title');
        $fixture->setNote('My Title');
        $fixture->setCoup_coeur('My Title');
        $fixture->setGenre('My Title');
        $fixture->setAffiche('My Title');
        $fixture->setDuree('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Film');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Films();
        $fixture->setTitre('Value');
        $fixture->setDescription('Value');
        $fixture->setAge_mini('Value');
        $fixture->setNote('Value');
        $fixture->setCoup_coeur('Value');
        $fixture->setGenre('Value');
        $fixture->setAffiche('Value');
        $fixture->setDuree('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'film[titre]' => 'Something New',
            'film[description]' => 'Something New',
            'film[age_mini]' => 'Something New',
            'film[note]' => 'Something New',
            'film[coup_coeur]' => 'Something New',
            'film[genre]' => 'Something New',
            'film[affiche]' => 'Something New',
            'film[duree]' => 'Something New',
        ]);

        self::assertResponseRedirects('/films/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitre());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getAge_mini());
        self::assertSame('Something New', $fixture[0]->getNote());
        self::assertSame('Something New', $fixture[0]->getCoup_coeur());
        self::assertSame('Something New', $fixture[0]->getGenre());
        self::assertSame('Something New', $fixture[0]->getAffiche());
        self::assertSame('Something New', $fixture[0]->getDuree());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Films();
        $fixture->setTitre('Value');
        $fixture->setDescription('Value');
        $fixture->setAge_mini('Value');
        $fixture->setNote('Value');
        $fixture->setCoup_coeur('Value');
        $fixture->setGenre('Value');
        $fixture->setAffiche('Value');
        $fixture->setDuree('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/films/');
        self::assertSame(0, $this->repository->count([]));
    }
}
