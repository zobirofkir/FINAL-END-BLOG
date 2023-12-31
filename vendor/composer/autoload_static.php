<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf617260b50714b0894136612b244a1b9
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf617260b50714b0894136612b244a1b9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf617260b50714b0894136612b244a1b9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf617260b50714b0894136612b244a1b9::$classMap;

        }, null, ClassLoader::class);
    }
}
