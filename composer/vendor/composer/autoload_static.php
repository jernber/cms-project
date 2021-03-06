<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5ef81c887e0cd3efbf9f3fd87caf146a
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'ReCaptcha\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ReCaptcha\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5ef81c887e0cd3efbf9f3fd87caf146a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5ef81c887e0cd3efbf9f3fd87caf146a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
