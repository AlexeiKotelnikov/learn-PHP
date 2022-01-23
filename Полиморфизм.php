<?php



interface Edible
{
    public function edible() : bool;

    public function taste() : string;
}

class Omnivore
{
    public function eat(Edible $edible)
    {
        if ($edible->edible()) {
            echo 'Очень вкусно, я съел: ' . get_class($edible) . '. На вкус... ' . $edible->taste();
        } else {
            echo 'Даже я такое не ем: ' . get_class($edible) . '. Фу.';
        }
    }
}

class Brick implements Edible
{
    public function edible() : bool
    {
        return false;
    }

    public function taste() : string
    {
        return "На вкус как кирпич.";
    }
}

class Eag implements Edible
{
    public function edible() : bool
    {
        return true;
    }

    public function taste() : string
    {
        return "Вполне съедобно.";
    }
}

class Bath implements Edible
{
    public function edible() : bool
    {
        return true;
    }

    public function taste() : string
    {
        return "Кхм... Ну это же ванна, кто в здравом уме будет есть ванну?";
    }
}

class FreshMeat implements Edible
{
    public function edible() : bool
    {
        return false;
    }

    public function taste() : string
    {
        return "Не особо съедобно. Конечно же если вы не Pudge :)";
    }
}

class Time implements Edible
{
    public function edible() : bool
    {
        return true;
    }

    public function taste() : string
    {
        return "Не знаю как на вкус, но кто-то его поглощает с удивительной быстротой, а значит очень даже съедобно";
    }
}

$om = new Omnivore();

echo $om->eat(new Brick()) . "<br>";
echo $om->eat(new FreshMeat()) . "<br>";
echo $om->eat(new Bath()) . "<br>";
echo $om->eat(new Eag()) . "<br>";
echo $om->eat(new Time()) . "<br>";
