<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Project;

echo "Immagini assegnate ai progetti:\n\n";

$projects = Project::select('id', 'title', 'image_path')->take(15)->get();

foreach($projects as $p) {
    $title = substr($p->title, 0, 40) . (strlen($p->title) > 40 ? '...' : '');
    echo "ID: {$p->id} | {$p->image_path} | {$title}\n";
}

echo "\nDistribuzione immagini:\n";
$imageDistribution = Project::selectRaw('image_path, COUNT(*) as count')
    ->groupBy('image_path')
    ->orderBy('count', 'desc')
    ->get();

foreach ($imageDistribution as $dist) {
    $imageName = basename($dist->image_path);
    echo "{$imageName}: {$dist->count} progetti\n";
}
