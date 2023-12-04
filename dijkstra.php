<?php

$graph = [
    'A' => ['B' => 2],
    'B' => ['C' => 6, 'D' => 8],
    'C' => ['D' => 5],
    'D' => []
];

function dijkstra($graph, $start) {
    $distances = [];
    $visited = [];
    $queue = new SplPriorityQueue();

    foreach ($graph as $vertex => $adjacency) {
        $distances[$vertex] = INF;
        $visited[$vertex] = false;
    }

    $distances[$start] = 0;
    $queue->insert($start, 0);

    while (!$queue->isEmpty()) {
        $u = $queue->extract();
        if ($visited[$u]) {
            continue;
        }
        $visited[$u] = true;

        foreach ($graph[$u] as $v => $weight) {
            $alt = $distances[$u] + $weight;
            if ($alt < $distances[$v]) {
                $distances[$v] = $alt;
                $queue->insert($v, -$alt);
            }
        }
    }

    return $distances;
}

$startNode = 'A';
$result = dijkstra($graph, $startNode);

foreach ($result as $vertex => $distance) {
    echo "Shortest distance from $startNode to $vertex is $distance\n";
}
