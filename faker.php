<?php

include_once __DIR__ . '/vendor/fzaninotto/faker/src/autoload.php';

function connectDB()
{
    $host     = 'localhost';
    $user     = 'felix';
    $password = '211187';
    $db       = 'cms';

    static $connection = null;

    if ($connection === null) {
        $connection = new \PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password) or die('error connection');
    }

    return $connection;
}

$faker = Faker\Factory::create();
$dbConnect = connectDB();

$stmt = $dbConnect->prepare("
    INSERT INTO comments (comment, active, user_id, article_id, created_at, updated_at)
        VALUES (:comment, :active, :user_id, :article_id, :created_at, :updated_at)"
);

for ($i = 0; $i < 400; $i++) {
    $stmt->execute([
        'comment'        => $faker->sentence($nbWords = rand(15, 40), $variableNbWords = true),
        'active'        => rand(0, 1),
        'user_id' => rand(1, 8),
        'article_id' => rand(1, 300),
        'created_at' => $faker->dateTime($max = 'now', $timezone = null)->format('Y-m-d H:m:i'),
        'updated_at' => $faker->dateTime($max = 'now', $timezone = null)->format('Y-m-d H:m:i'),
    ]);

// $stmt = $dbConnect->prepare("
//     INSERT INTO articles (title, slug, text, created_at, updated_at, user_id, upload_id)
//         VALUES (:title, :slug, :text, :created_at, :updated_at, :user_id, :upload_id)"
// );

// for ($i = 0; $i < 300; $i++) {
//     $stmt->execute([
//         'title'        => $faker->sentence($nbWords = rand(1, 3), $variableNbWords = true),
//         'slug'        => $faker->unique()->slug,
//         'text' => $faker->sentence($nbWords = rand(50, 150), $variableNbWords = true),
//         'created_at' => $faker->dateTime($max = 'now', $timezone = null)->format('Y-m-d H:m:i'),
//         'updated_at' => $faker->dateTime($max = 'now', $timezone = null)->format('Y-m-d H:m:i'),
//         'user_id' => rand(1, 2),
//         'upload_id' => rand(1, 4),
//     ]);
}
