<?php

class Product {
    public $code;
    public $name;
    public $price;

    public function __construct($code, $name, $price) {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }
}

class Basket {
    private $catalogue;
    private $items = [];

    public function __construct($catalogue) {
        $this->catalogue = $catalogue;
    }

    public function add($productCode) {
        $this->items[] = $productCode;
    }

    public function calculate() {
        $counts = array_count_values($this->items);
        $subtotal = 0.0;
        $discount = 0.0;
        $specialOfferCount = 0;

        foreach ($counts as $code => $qty) {
            $product = $this->catalogue[$code];
            if ($code === 'R01') {
                $pairs = intdiv($qty, 2);
                $remainder = $qty % 2;
                $subtotal += $qty * $product->price;
                $discount += $pairs * ($product->price / 2);
                $specialOfferCount = $pairs;
            } else {
                $subtotal += $qty * $product->price;
            }
        }

        // Delivery charge
        $afterDiscount = $subtotal - $discount;
        if ($afterDiscount < 50) {
            $delivery = 4.95;
        } elseif ($afterDiscount < 90) {
            $delivery = 2.95;
        } else {
            $delivery = 0.0;
        }

        $total = $afterDiscount + $delivery;
        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'specialOfferCount' => $specialOfferCount,
            'delivery' => $delivery,
            'total' => $total
        ];
    }
}

// Set up the product catalogue
$catalogue = [
    'R01' => new Product('R01', 'Red Widget', 32.95),
    'G01' => new Product('G01', 'Green Widget', 24.95),
    'B01' => new Product('B01', 'Blue Widget', 7.95),
];

$basket = new Basket($catalogue);

echo "Enter product codes separated by spaces (e.g. R01 G01 B01): ";
$line = trim(fgets(STDIN));
$codes = explode(' ', $line);

foreach ($codes as $code) {
    $code = strtoupper(trim($code));
    if (isset($catalogue[$code])) {
        $basket->add($code);
    } else {
        echo "Unknown product code: $code\n";
    }
}

$result = $basket->calculate();

echo "\n--- Basket Summary ---\n";
echo "Subtotal: $" . number_format($result['subtotal'], 2) . "\n";
if ($result['discount'] > 0) {
    echo "Discounts: -$" . number_format($result['discount'], 2) . " (Red Widget offer x{$result['specialOfferCount']})\n";
}
echo "Delivery: $" . number_format($result['delivery'], 2) . "\n";
echo "Total: $" . number_format($result['total'], 2) . "\n";