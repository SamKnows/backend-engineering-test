<?php declare(strict_types=1);

namespace App\Tests\Functional\Command;

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class AppAnalyseMetricsCommandTest
 *
 * @package App\Tests\Functional\Command
 */
class AppAnalyseMetricsCommandTest extends KernelTestCase
{
    /**
     * @return \Generator
     */
    public function detectionProvider(): \Generator
    {
        /**
         * The first test case is all about working statistics
         * from a basic set of values. Check out the input and
         * output files of what we expect.
         */
        yield [
            // Filename
            __DIR__ . '/../../../resources/fixtures/1.json',

            // Output
            __DIR__ . '/../../../resources/fixtures/1.output',
        ];

        /**
         * The second test case is all pattern detection, working
         * out when something out of the ordinary is happening.
         */
        yield [
            // Filename
            __DIR__ . '/../../../resources/fixtures/2.json',

            // Output
            __DIR__ . '/../../../resources/fixtures/2.output',
        ];
    }

    /**
     * Tests to ensure we're correctly detecting all slowdowns.
     *
     * @dataProvider detectionProvider
     *
     * @param string $filename The filename of the input fixture.
     * @param string $expected The expected output of the command.
     */
    public function testDetection(string $filename, string $expected): void
    {
        $kernel = self::createKernel();
        $kernel->boot();

        $application = new Application($kernel);

        $command = $application->find('app:analyse-metrics');

        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command' => $command->getName(),
            '--input' => \realpath($filename),
        ]);

        $this->assertStringEqualsFile(\realpath($expected), $commandTester->getDisplay());
    }
}
