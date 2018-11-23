<?php declare(strict_types=1);

namespace Services\Http;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;

use Interop\Container\ServiceProviderInterface;

use Nyholm\Psr7\Factory\Psr17Factory;

final class NyholmHttpFactoryServiceProvider implements ServiceProviderInterface
{
    public function getFactories()
    {
        return [
            ServerRequestFactoryInterface::class => [self::class, 'getServerRequestFactoryInterface'],
            UriFactoryInterface::class => [self::class, 'getUriFactoryInterface'],
            StreamFactoryInterface::class => [self::class, 'getStreamFactoryInterface'],
            UploadedFileFactoryInterface::class => [self::class, 'getUploadedFileFactoryInterface'],
            ResponseFactoryInterface::class => [self::class, 'getResponseFactoryInterface'],
            Psr17Factory::class => [self::class, 'getPsr17Factory'],
        ];
    }

    public function getExtensions()
    {
        return [];
    }

    public static function getServerRequestFactoryInterface(ContainerInterface $container): ServerRequestFactoryInterface
    {
        return $container->get(Psr17Factory::class);
    }

    public static function getUriFactoryInterface(ContainerInterface $container): UriFactoryInterface
    {
        return $container->get(Psr17Factory::class);
    }

    public static function getStreamFactoryInterface(ContainerInterface $container): StreamFactoryInterface
    {
        return $container->get(Psr17Factory::class);
    }

    public static function getUploadedFileFactoryInterface(ContainerInterface $container): UploadedFileFactoryInterface
    {
        return $container->get(Psr17Factory::class);
    }

    public static function getResponseFactoryInterface(ContainerInterface $container): ResponseFactoryInterface
    {
        return $container->get(Psr17Factory::class);
    }

    public static function getPsr17Factory(): Psr17Factory
    {
        return new Psr17Factory;
    }
}
