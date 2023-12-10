<?php

declare(strict_types = 1);


function get_value(object $pdo, string $table_name, string $get_value,
                    string $comapre_value_name, string $compare_value)
{
    $sql = "SELECT {$get_value} FROM {$table_name} " . 
            "WHERE {$comapre_value_name} = :{$comapre_value_name}";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":{$comapre_value_name}", $compare_value);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function get_values(object $pdo, string $table_name, Array $get_values,
                    Array $compare_values)
{
    $sql = "SELECT ";

    foreach($get_values as $value)
    {
        $sql .= $value . ',';
    }

    $sql = rtrim($sql, ',');
    $sql .= " FROM {$table_name} WHERE (";


    foreach($compare_values as $value_name => $value)
    {
        $sql .= "{$value_name}=:{$value_name} AND ";
    }

    $sql = rtrim($sql, " AND ") . ");";
    $stmt = $pdo->prepare($sql);

    foreach($compare_values as $value_name => &$value)
    {
        $stmt->bindParam(":{$value_name}", $value);
    }

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function insert(object $pdo, string $table_name, Array $values): void
{
    $sql = "INSERT INTO {$table_name} (";
    $sql_values = "VALUES (";

    foreach($values as $value_name => $value)
    {
        $sql .= "{$value_name},";
        $sql_values .= ":{$value_name},";
    }

    $sql = rtrim($sql, ',') . ") " . rtrim($sql_values, ',') . ");";
    $stmt = $pdo->prepare($sql);

    foreach($values as $value_name => &$value)
    {
        $stmt->bindParam(":{$value_name}", $value);
    }

    $stmt->execute();
}


function delete($pdo, string $table_name, Array $compare_values): void
{
    $sql = "DELETE FROM {$table_name}";

    if(empty($compare_values))
    {
        $stmt->execute();
        return;
    }

    $sql .=  " WHERE (";

    foreach($compare_values as $value_name => $value)
    {
        $sql .= "{$value_name}=:{$value_name} AND ";
    }

    $sql = rtrim($sql, " AND ") . ");";
    $stmt = $pdo->prepare($sql);

    foreach($compare_values as $value_name => &$value)
    {
        $stmt->bindParam(":{$value_name}", $value);
    }

    $stmt->execute();
}


function get_stats(object $pdo, int $time_period = null)
{

    $sql = "SELECT p.name, p.price, COUNT(*) as count, (COUNT(*) * p.price) as total " .
        "FROM sales as s " .
        "INNER JOIN products as p ON s.product_id = p.id " .
        "INNER JOIN users as u ON s.user_id = u.id ";

    if(isset($time_period))
    {
        $sql .= "WHERE CURRENT_DATE-DATE(s.sold_at)";

        if($time_period <= 1)
        {
            $sql .= "=";
        }
        else
        {
            $sql .= "<=";
        }

        $sql .= "{$time_period} ";
    }
    
    $sql .= "GROUP BY p.name " .
        "ORDER BY total";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    return $stmt;
}


function delete_all_data_from_table(object $pdo, string $table_name): void 
{
    $sql = "TRUNCATE TABLE {$table_name};";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}