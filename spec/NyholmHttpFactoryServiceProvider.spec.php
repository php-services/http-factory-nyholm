<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;

use Interop\Container\ServiceProviderInterface;

use Nyholm\Psr7\Factory\Psr17Factory;
use Services\Http\NyholmHttpFactoryServiceProvider;

describe('NyholmHttpFactoryServiceProvider', function () {

    beforeEach(function () {

        $this->container = mock(ContainerInterface::class);

        $this->provider = new NyholmHttpFactoryServiceProvider;

    });

    it('should implement ServiceProviderInterface', function () {

        expect($this->provider)->toBeAnInstanceOf(ServiceProviderInterface::class);

    });

    describe('->getFactories()', function () {

        beforeEach(function () {

            $this->factory = new Psr17Factory;

            $this->container->get->with(Psr17Factory::class)->returns($this->factory);

            $this->factories = $this->provider->getFactories();

        });

        it('should return an array of length 6', function () {

            expect($this->factories)->toBeAn('array');
            expect($this->factories)->toHaveLength(6);

        });

        it('should provide a ServerRequestFactoryInterface entry aliasing the Psr17Factory one', function () {

            $factory = $this->factories[ServerRequestFactoryInterface::class];

            $test = $factory($this->container->get());

            expect($test)->toBe($this->factory);

        });

        it('should provide an UriFactoryInterface entry aliasing the Psr17Factory one', function () {

            $factory = $this->factories[UriFactoryInterface::class];

            $test = $factory($this->container->get());

            expect($test)->toBe($this->factory);

        });

        it('should provide a StreamFactoryInterface entry aliasing the Psr17Factory one', function () {

            $factory = $this->factories[UriFactoryInterface::class];

            $test = $factory($this->container->get());

            expect($test)->toBe($this->factory);

        });

        it('should provide a ResponseFactoryInterface entry aliasing the Psr17Factory one', function () {

            $factory = $this->factories[ResponseFactoryInterface::class];

            $test = $factory($this->container->get());

            expect($test)->toBe($this->factory);

        });

        it('should provide an UploadedFileFactoryInterface entry aliasing the Psr17Factory one', function () {

            $factory = $this->factories[UploadedFileFactoryInterface::class];

            $test = $factory($this->container->get());

            expect($test)->toBe($this->factory);

        });

        it('should provide a Psr17Factory entry', function () {

            $factory = $this->factories[Psr17Factory::class];

            $test = $factory($this->container->get());

            expect($test)->toEqual(new Psr17Factory);

        });

    });

    describe('->getExtensions()', function () {

        it('should return an empty array', function () {

            $test = $this->provider->getExtensions();

            expect($test)->toBeAn('array');
            expect($test)->toHaveLength(0);

        });

    });

});
