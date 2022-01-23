<?php


class Product
{
    public string $name;
    public int $cost;

    public function __construct(string $name, int $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCost()
    {
        return $this->cost;
    }
}

class BasketPosition
{
    private Product $product;
    public int $quantity;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): int
    {
        return $this->product->getCost() * $this->quantity;
    }
}

class Basket
{
    public $BasketPosition = [];

    public function addProduct(Product $product, $quantity)
    {
        $this->BasketPosition[] = new BasketPosition($product, $quantity);
    }

    public function getPrice(): int
    {
        $sum = 0;
        foreach ($this->BasketPosition as $item) {
            $sum += $item->getPrice();
        }
        return $sum;
    }

    public function describe()
    {
        $info = [];
        foreach ($this->BasketPosition as $item) {
            $name =  $item->getProduct()->getName();
            $count = $item->getQuantity();
            $position = $item->getPrice();
            $info[] = "$name - $position - $count шт";
        }
        return $info;
    }
}

class Order
{
    private Basket $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function getPrice(): int
    {
        return $this->basket->getPrice() + 300;
    }

    public function getBasket(): Basket
    {
        return $this->basket;
    }
}

$basket = new Basket();
$basket->addProduct(new Product('спички', 20), 20);
$basket->addProduct(new Product('хлеб', 55), 5);
$basket->addProduct(new Product('курица', 300), 2);

$order = new Order($basket);
$sum = $order->getPrice();
$info = implode("; ", $order->getBasket()->describe());
echo "Создан заказ, на общую сумму: $sum. Состав заказа: $info";
