<?php

namespace Stevebauman\Maintenance\Seeders;

use Stevebauman\Maintenance\Services\ConfigService;
use Stevebauman\Maintenance\Services\PriorityService;
use Illuminate\Database\Seeder;

/**
 * Class PrioritySeeder.
 */
class PrioritySeeder extends Seeder
{
    /**
     * @var PriorityService
     */
    protected $priority;

    /**
     * @var ConfigService
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param PriorityService $priority
     */
    public function __construct(PriorityService $priority, ConfigService $config)
    {
        $this->priority = $priority;
        $this->config = $config->setPrefix('maintenance');
    }

    /**
     * Runs the seeding operations.
     */
    public function run()
    {
        $priorities = $this->getSeedData();

        foreach ($priorities as $prioritiy) {
            $this->priority->setInput($prioritiy)->firstOrCreate();
        }
    }

    /**
     * Retrieves the seed data from the maintenance configuration.
     *
     * @return mixed
     */
    private function getSeedData()
    {
        return $this->config->get('seed.priorities');
    }
}
