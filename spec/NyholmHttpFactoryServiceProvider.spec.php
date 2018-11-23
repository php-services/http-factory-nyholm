<?php

use Psr\Container\ContainerInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;

use Interop\Container\ServiceProviderInterface;

use Quanta\Container;
use Nyholm\Psr7\Factory\Psr17Factory;
use Services\Http\NyholmHttpFactoryServiceProvider;

describe('NyholmHttpFactoryServiceProvider', function () {

    beforeEach(function () {

        $this->provider = new NyholmHttpFactoryServiceProvider;

    });

    it('should implement ServiceProviderInterface', function () {

        expect($this->provider)->toBeAnInstanceOf(ServiceProviderInterface::class);

    });

    describe('->getFactories()', function () {

        it('should return an array of length 6', function () {

            $test = $this->provider->getFactories();

            expect($test)->toBeAn('array');
            expect($test)->toHaveLength(6);

        });

        it('should provide a ServerRequestFactoryInterface entry aliasing the Psr17Factory one', function () {

            $container = new Container($this->provider->getFactories());

            $test = $container->get(ServerRequestFactoryInterface::class);

            expect($test)->toBe($container->get(Psr17Factory::class));

        });

        it('should provide an UriFactoryInterface entry aliasing the Psr17Factory one', function () {

            $container = new Container($this->provider->getFactories());

            $test = $container->get(UriFactoryInterface::class);

            expect($test)->toBe($container->get(Psr17Factory::class));

        });

        it('should provide a StreamFactoryInterface entry aliasing the Psr17Factory one', function () {

            $container = new Container($this->provider->getFactories());

            $test = $container->get(StreamFactoryInterface::class);

            expect($test)->toBe($container->get(Psr17Factory::class));

        });

        it('should provide a ResponseFactoryInterface entry aliasing the Psr17Factory one', function () {

            $container = new Container($this->provider->getFactories());

            $test = $container->get(ResponseFactoryInterface::class);

            expect($test)->toBe($container->get(Psr17Factory::class));

        });

        it('should provide an UploadedFileFactoryInterface entry aliasing the Psr17Factory one', function () {

            $container = new Container($this->provider->getFactories());

            $test = $container->get(UploadedFileFactoryInterface::class);

            expect($test)->toBe($container->get(Psr17Factory::class));

        });

        it('should provide a Psr17Factory entry', function () {

            $container = new Container($this->provider->getFactories());

            $test = $container->get(Psr17Factory::class);

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
