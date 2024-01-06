<?php

    declare(strict_types = 1);

    namespace Coco\Tests\Unit;

    use Coco\encrypt\Encrypt;
    use PHPUnit\Framework\TestCase;

final class EncryptTest extends TestCase
{
    public function testA()
    {
        $key = '123456789';

        $str = 'hello 你好 123456789';

        $s = Encrypt::encrypt($str, $key);

        $result = Encrypt::decrypt($s, $key);

        $this->assertEquals($str, $result);
    }

    public function testB()
    {
        $key = '123456789';

        $str = 'hello 你好 123456789';

        $s = Encrypt::encrypt($str, $key);

        $result = Encrypt::decrypt($s . 'a', $key);

        $this->assertFalse($result);
    }

    public function testC()
    {
        $key = '123456789';

        $str = 'hello 你好 123456789';

        $s = Encrypt::encrypt($str, $key);

        $result = Encrypt::decrypt($s, $key . 'a');

        $this->assertFalse($result);
    }
}
