<?php

declare(strict_types = 1);

function show_category_option(object $pdo, string $table_name) {
    echo "<select class='input_field' name='select_category'>";

    $stmt = $pdo->prepare("SELECT id, name FROM {$table_name}");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
    }
    echo "</select>";
}