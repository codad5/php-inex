<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit541712e0a39ad03b0c30480d594dcf46
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Codad5\\PhpInex\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Codad5\\PhpInex\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit541712e0a39ad03b0c30480d594dcf46::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit541712e0a39ad03b0c30480d594dcf46::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit541712e0a39ad03b0c30480d594dcf46::$classMap;

        }, null, ClassLoader::class);
    }
}
