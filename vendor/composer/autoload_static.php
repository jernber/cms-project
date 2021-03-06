<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd9da30a42feb09d14c1c5210bccc22ba
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'ShadeSoft\\GDImage\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ShadeSoft\\GDImage\\' => 
        array (
            0 => __DIR__ . '/..' . '/shadesoft/gd-image',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd9da30a42feb09d14c1c5210bccc22ba::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd9da30a42feb09d14c1c5210bccc22ba::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
