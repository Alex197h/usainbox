<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3ac6a1e6a87e61b143cd953154d600f0
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'CreatePasswordResetsTable' => __DIR__ . '/../..' . '/database/migrations/2014_10_12_100000_create_password_resets_table.php',
        'CreateQuestionsTable' => __DIR__ . '/../..' . '/database/migrations/2017_01_13_095703_create_questions_table.php',
        'CreateReservationsTable' => __DIR__ . '/../..' . '/database/migrations/2017_01_13_100415_create_reservations_table.php',
        'CreateShippingOffersTable' => __DIR__ . '/../..' . '/database/migrations/2017_01_13_081749_create_shipping_offers_table.php',
        'CreateTransportOffersTable' => __DIR__ . '/../..' . '/database/migrations/2017_01_13_081902_create_transport_offers_table.php',
        'CreateTransportStepTable' => __DIR__ . '/../..' . '/database/migrations/2017_01_20_093955_create_transport_step_table.php',
        'CreateTypeVehicleTable' => __DIR__ . '/../..' . '/database/migrations/2017_01_13_080009_create_type_vehicle_table.php',
        'CreateUsersTable' => __DIR__ . '/../..' . '/database/migrations/2014_10_12_000000_create_users_table.php',
        'CreateVehiclesTable' => __DIR__ . '/../..' . '/database/migrations/2017_01_13_075954_create_vehicles_table.php',
        'DatabaseSeeder' => __DIR__ . '/../..' . '/database/seeds/DatabaseSeeder.php',
        'ShippingOfferSeeder' => __DIR__ . '/../..' . '/database/seeds/ShippingOfferSeeder.php',
        'TestCase' => __DIR__ . '/../..' . '/tests/TestCase.php',
        'TransportOffersSeeder' => __DIR__ . '/../..' . '/database/seeds/TransportOffersSeeder.php',
        'TypeVehicleSeeder' => __DIR__ . '/../..' . '/database/seeds/TypeVehicleSeeder.php',
        'UsersSeeder' => __DIR__ . '/../..' . '/database/seeds/UsersSeeder.php',
        'VehicleSeeder' => __DIR__ . '/../..' . '/database/seeds/VehicleSeeder.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3ac6a1e6a87e61b143cd953154d600f0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3ac6a1e6a87e61b143cd953154d600f0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3ac6a1e6a87e61b143cd953154d600f0::$classMap;

        }, null, ClassLoader::class);
    }
}
