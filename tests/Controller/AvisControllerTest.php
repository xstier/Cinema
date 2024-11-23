<?php

namespace App\Tests\Controller;

use App\Entity\Avis;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AvisControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/avis/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Avis::class);

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
        self::assertPageTitleContains('Avi index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'avi[note]' => 'Testing',
            'avi[Commentaire]' => 'Testing',
            'avi[date_avis]' => 'Testing',
            'avi[validation_avis]' => 'Testing',
            'avi[id_reservation]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Avis();
        $fixture->setNote('My Title');
        $fixture->setCommentaire('My Title');
        $fixture->setDate_avis('My Title');
        $fixture->setValidation_avis('My Title');
        $fixture->setId_reservation('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Avi');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Avis();
        $fixture->setNote('Value');
        $fixture->setCommentaire('Value');
        $fixture->setDate_avis('Value');
        $fixture->setValidation_avis('Value');
        $fixture->setId_reservation('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'avi[note]' => 'Something New',
            'avi[Commentaire]' => 'Something New',
            'avi[date_avis]' => 'Something New',
            'avi[validation_avis]' => 'Something New',
            'avi[id_reservation]' => 'Something New',
        ]);

        self::assertResponseRedirects('/avis/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNote());
        self::assertSame('Something New', $fixture[0]->getCommentaire());
        self::assertSame('Something New', $fixture[0]->getDate_avis());
        self::assertSame('Something New', $fixture[0]->getValidation_avis());
        self::assertSame('Something New', $fixture[0]->getId_reservation());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Avis();
        $fixture->setNote('Value');
        $fixture->setCommentaire('Value');
        $fixture->setDate_avis('Value');
        $fixture->setValidation_avis('Value');
        $fixture->setId_reservation('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/avis/');
        self::assertSame(0, $this->repository->count([]));
    }
}
