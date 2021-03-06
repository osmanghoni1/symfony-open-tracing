<?php

declare(strict_types=1);

namespace Adtechpotok\Bundle\SymfonyOpenTracing\Service;

use Jaeger\Config;
use OpenTracing\GlobalTracer;
use OpenTracing\NoopTracer;
use OpenTracing\Tracer;

class OpenTracingService
{
    /**
     * @var Tracer
     */
    protected $tracer;

    /**
     * @param string $appName
     * @param array  $config
     */
    public function __construct(string $appName, array $config)
    {
        if (isset($config['null_tracer']) && $config['null_tracer']) {
            $this->tracer = new NoopTracer();
        } else {
            (new Config($config, $appName))->initializeTracer();

            $this->tracer = GlobalTracer::get();
        }
    }

    /**
     * @return Tracer
     */
    public function getTracer(): Tracer
    {
        return $this->tracer;
    }
}
