<?php


abstract class Dish
{
    public string $name;
    public int $cost;

    public function __construct(string $name, int $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }

    abstract public function getName(): string;

    abstract public function getPrice(): int;
}

class Dish1 extends Dish
{
    public function getName() : string
    {
        return "хлеб";
    }

    public function getPrice(): int
    {
        return 115;
    }
}

class Dish2 extends Dish
{
    public function getName(): string
    {
        return "мясо";
    }

    public function getPrice(): int
    {
        return 500;
    }
}

class Dish3 extends Dish
{
    public function getName(): string
    {
        return "голубцы";
    }

    public function getPrice(): int
    {
        return 1000;
    }
}



class Cook
{
    protected array $order = [];

    public function addDishToOrder(Dish $dish)
    {
        $this->order[] = $dish;
    }

    protected function getTotalSum(): int
    {
        $totalSum = 0;
        foreach ($this->order as $dish) {
            $totalSum += $dish->getPrice();
        }
        return $totalSum;
    }

    protected function getFoodList()
    {
        foreach ($this->order as $dish) {
            echo 'Повар приготовил: ' . $dish->getName() . "<br>";
        }
    }

    public function prepareFood()
    {
        echo "Стоимость заказа: " . $this->getTotalSum() . "<br>";
    }
}

class Chef extends Cook
{
	public function prepareFood()
    {
        parent::getFoodList();
        echo 'Стоимость заказа: ' . $this->getTotalSum() * 5;
    }
}

$dish1 = new Dish1("хлеб", 115);
$dish2 = new Dish2("мясо", 500);
$dish3 = new Dish3("голубцы", 1000);

$cook = new Cook();
$cook->addDishToOrder($dish1);
$cook->addDishToOrder($dish2);
$cook->addDishToOrder($dish3);
$cook->prepareFood();

$chef = new Chef();
$chef->addDishToOrder($dish1);
$chef->addDishToOrder($dish2);
$chef->addDishToOrder($dish3);
$chef->prepareFood();
