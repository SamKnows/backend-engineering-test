<?php declare(strict_types=1);

namespace App\Command;

use App\AnalyseMetrics\Service\Analyser;
use App\AnalyseMetrics\Service\File;
use App\AnalyseMetrics\Service\FileDataFormatter;
use App\AnalyseMetrics\Service\MetricDataSet;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AppAnalyseMetricsCommand
 *
 * @package App\Command
 */
class AppAnalyseMetricsCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:analyse-metrics';

    private $templating;

    /**
     * AppAnalyseMetricsCommand constructor.
     * @param ContainerInterface $container
     * @param string|null $name
     */
    public function __construct(ContainerInterface $container, string $name = null)
    {
        $this->templating = $container->get('twig');
        parent::__construct($name);
    }

    /**
     * Configure the command.
     */
    protected function configure(): void
    {
        $this->setDescription('Analyses the metrics to generate a report.');
        $this->addOption('input', null, InputOption::VALUE_REQUIRED, 'The location of the test input');
    }

    /**
     * Detect slow-downs in the data and output them to stdout.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $metricsFile = $input->getOption('input');

        $analyser = null;
        try {
            $file = new File($metricsFile);
            $fileDataFormatter = new FileDataFormatter($file->read(), new MetricDataSet());
            $analyser = new Analyser($fileDataFormatter->getContent());
        } catch (\Exception $exception) {
            $exception->getMessage();
        }

        $template = $this->templating->render('analyser.html.twig', [
            'data' => $analyser->parse()->toArray(),
        ]);

        $output->write($template);
    }
}
