<?php



interface Reader
{
    public function read() : array;
}

interface Writer
{
    public function write(array $data);
}

interface Converter
{
    public function convert(string $item) : string;
}

class Import
{
    private Reader $reader;
    private Writer $writer;
    private array $converters = [];

    public function from(Reader $reader) : Import
    {
        $this->reader = $reader;
        return $this;
    }

    public function to(Writer $writer) : Import
    {
        $this->writer = $writer;
        return $this;
    }

    public function with(Converter $converter) : Import
    {
        $this->converters[] = $converter;
        return $this;
    }

    public function execute()
    {
        $data = $this->reader->read();

        foreach ($this->converters as $converter) {
            foreach ($data as &$dataItem) {
                $dataItem = $converter->convert($dataItem);
            }
        }

        $this->writer->write($data);
    }
}

class ArrayReader implements Reader
{
    public array $data = ['Понтиак', 'Митсубиси', 'Мерседес', 'Татра', 'Омнимобиль'];

    public function read(): array
    {
        return $this->data;
    }
}

class JustWriter implements Writer
{
    public function write(array $data)
    {
        var_dump($data);
    }
}

class TranslitConverter implements Converter
{
    private array $codes = [
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'e',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'y',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'c',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sch',
        'ь' => '',
        'ы' => 'y',
        'ъ' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',

        'А' => 'A',
        'Б' => 'B',
        'В' => 'V',
        'Г' => 'G',
        'Д' => 'D',
        'Е' => 'E',
        'Ё' => 'E',
        'Ж' => 'Zh',
        'З' => 'Z',
        'И' => 'I',
        'Й' => 'Y',
        'К' => 'K',
        'Л' => 'L',
        'М' => 'M',
        'Н' => 'N',
        'О' => 'O',
        'П' => 'P',
        'Р' => 'R',
        'С' => 'S',
        'Т' => 'T',
        'У' => 'U',
        'Ф' => 'F',
        'Х' => 'H',
        'Ц' => 'C',
        'Ч' => 'Ch',
        'Ш' => 'Sh',
        'Щ' => 'Sch',
        'Ь' => '',
        'Ы' => 'Y',
        'Ъ' => '',
        'Э' => 'E',
        'Ю' => 'Yu',
        'Я' => 'Ya',
    ];

    public function convert(string $item): string
    {
        $strData = mb_str_split($item);
        foreach ($strData as &$simbol) {
            if (array_key_exists($simbol, $this->codes)) {
                $simbol = $this->codes[$simbol];
            }
        }
        return implode('', $strData);
    }
}

class StringConverter implements Converter
{
    public function convert(string $item): string
    {
        return mb_convert_case($item, MB_CASE_UPPER);
    }
}

(new Import())->from(new ArrayReader())->to(new JustWriter())->with(new TranslitConverter())->with(new StringConverter())->execute();
