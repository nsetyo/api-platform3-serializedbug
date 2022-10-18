<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Address;
use App\Entity\Country;
use App\Entity\Greeting;
use App\Entity\Organization;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GreetingsTest extends ApiTestCase
{
    public function testSerializeGreeting(): void
    {
        $serializer = $this->getContainer()->get(SerializerInterface::class);
        $em = $this->getContainer()->get(EntityManagerInterface::class);

        $country = (new Country)->setCode('US');
        $em?->persist($country);

        $org = new Organization;
        $org->addAddress((new Address)->setCountry($country));
        $em?->persist($org);

        $greeting = (new Greeting)
            ->setName('Kévin')
            ->setOrg($org);

        $em?->persist($greeting);
        $em?->flush();

        $serialized = $serializer?->serialize($greeting, 'json');

        $this->assertIsString($serialized);
    }
}
