<?php

namespace App\Services;

use App\Repositories\StatsRepository;
use App\Services\DTO\StatsFilter;
use DateTime;

class StatsService {

    private StatsRepository $repository;

    function __construct()
    {
        $this->repository = new StatsRepository();
    }

    public function getData(array $params): array
    {
        $filter = new StatsFilter();
        $filter->from = new DateTime($params['from']);
        $filter->to = new DateTime($params['to']);
        if (isset($params['typeId'])) {
            $filter->typeId = $params['typeId'];
        }

        return $this->repository->getPeriodStats($filter);
    }

}
