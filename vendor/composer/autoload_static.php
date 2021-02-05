<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9cbf19285bc84ae9952a79fcb581f318
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9cbf19285bc84ae9952a79fcb581f318::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9cbf19285bc84ae9952a79fcb581f318::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}