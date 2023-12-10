<?php

include_once "../model/db_queries.php";

function show_stats(object $pdo, int $time_period = null): void
{
    $total_for_day = 0;
    $row = null;
    $name = null;
    $price = null;
    $total = null;
    $count = null;

    $stmt = get_stats($pdo, $time_period);

    echo "<h3 class='stats_header'>";

    if(isset($time_period))
    {
        switch($time_period)
        {   
            case 0: echo "Today"; break;
            case 1: echo "Yesterday"; break;
            case 7: echo "7 Days"; break;
            case 30: echo "30 Days"; break;
        }
    }
    else
    {
        echo "All Time";
    }

    echo "</h3>";

    echo "<div class='stats'>";

    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $name = $row["name"];
        $price = $row["price"];
        $total = $row["total"];
        $count = $row["count"];
        $total_for_day += $total;

        echo "<p><span class='stats_name'>{$name}:</span> {$price} * {$count} = {$total}</p>";
    }

    echo "<p><span class='stats_total'>Total: {$total_for_day}</span></p></div>";
}