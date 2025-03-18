<?php
/**
 * StreamFileTest class file
 *
 * @author Sebastian Krein <darealfive@gmx.de>
 */

declare(strict_types=1);

use Darealfive\IoStream\filter\whitespace\WhitespaceFilter;
use Darealfive\IoStream\filter\whitespace\WhitespaceFilterType;
use Darealfive\IoStream\input\StreamFile;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

/**
 * Class StreamFileTest
 */
#[UsesClass(WhitespaceFilter::class)]
#[UsesClass(WhitespaceFilterType::class)]
#[CoversClass(StreamFile::class)]
final class StreamFileTest extends TestCase
{
    #[DataProvider('dataproviderInputFiles')]
    public function testConstructorWorks(string $file): void
    {
        $input = new StreamFile($file);
        $this->assertSame($file, $input->file);
    }

    #[DataProvider('dataproviderInputFiles')]
    public function testConstructorThrowsException(): void
    {
        $this->expectException(\Darealfive\IoStream\exception\Exception::class);
        new StreamFile(__DIR__ . DIRECTORY_SEPARATOR . 'none_existing_file.txt');
    }

    #[DataProvider('dataproviderInputFiles')]
    public function testReadFile(string $file, array $expectedLines, ...$filters): void
    {
        $input = new StreamFile($file, ...$filters);
        foreach ($input->read() as $line) {

            $expectedLine = array_shift($expectedLines);
            $this->assertEquals($expectedLine, $line);
        }

        $this->assertEmpty($expectedLines);
    }

    public static function dataproviderInputFiles(): array
    {
        return [
            [
                'file'          => realpath(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'input.txt'),
                'expectedLines' => [
                    "this\n",
                    "is\n",
                    "separated\n",
                    "by\n",
                    "new\n",
                    "line",
                ],
            ],
            [
                'file'          => realpath(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'input.txt'),
                'expectedLines' => [
                    "this",
                    "is",
                    "separated",
                    "by",
                    "new",
                    "line",
                ],
                WhitespaceFilter::instantiate(
                    WhitespaceFilterType::R_TRIM,
                    WhitespaceFilter::LINE_BREAKS
                ),
            ]
        ];
    }
}