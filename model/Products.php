<?php

    declare(strict_types = 1);

    class Product {
        private string $product_name;
        private float $product_price;
        private int $category_id;

        public function __construct(string $product_name, float $product_price, int $category_id) {
            $this->product_name = $product_name;
            $this->product_price = $product_price;
            $this->category_id = $category_id;
        }

        public static function extract_table(object $pdo): Array {
            $products = [];

            try {
                $stmt = $pdo->prepare("SELECT name, price, products_categories_id FROM products");
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $products[] = new Product($row['name'], $row['price'], $row['products_categories_id']);
                }
            } catch(PDOException $e) {
                echo "ERROR: " . $e->getMessage();
            }
            return $products;
        }

        public static function displayProducts(object $pdo, Array $products): void {
            $stmt = $pdo->prepare("SELECT name, id FROM products_categories");
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<button class="accordion">' . $row["name"] . '</button>';
                echo '<div class="panel">';

                foreach ($products as $product) {
                    if ($product->category_id == $row['id']) {
                        echo '<button class="selected_btn" onclick="addProduct(\'' . $product->product_name . '\', \'' .
                        $product->product_price . '\')">' . $product->product_name . ' - ' . $product->product_price . ' lei</button>';
                    }
                }
                echo '</div>';
            }
        }
    }
