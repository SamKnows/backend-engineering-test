<?php declare(strict_types=1);

namespace App\Command;

use App\Service\MetricService;
use App\ViewModel\MetricStatsViewModel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Twig\Environment;

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

    /**
     * @var MetricService
     */
    private $metricService;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * AppAnalyseMetricsCommand constructor.
     * @param string|null $name
     * @param MetricService $metricService
     * @param Environment $twig
     */
    public function __construct(
        string $name = null,
        MetricService $metricService,
        Environment $twig
    ) {
        parent::__construct($name);

        $this->metricService = $metricService;
        $this->twig = $twig;
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
     *
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $file = $input->getOption('input');
        $metrics = $this->metricService->getMetricsFromFile($file);
        $statsViewModel = new MetricStatsViewModel();
        $statsViewModel->averageSpeed = $metrics->averageSpeed();
        $statsViewModel->medianSpeed = $metrics->medianSpeed();
        $statsViewModel->minimumSpeed = $metrics->minimumSpeed();
        $statsViewModel->maximumSpeed = $metrics->maximumSpeed();
        $statsViewModel->fromDate = $metrics->fromDate();
        $statsViewModel->toDate = $metrics->toDate();

        $output->write($this->twig->render('stats.txt.twig', ['viewModel' => $statsViewModel]));
    }
}
