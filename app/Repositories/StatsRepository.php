<?php

namespace App\Repositories;

use App\Services\DTO\StatsFilter;
use DateTime;
use \DB;

class StatsRepository {

    public function getPeriodStats(StatsFilter $filter): array
    {
        /*
SELECT SUM(p.price) as price, t.name as type
FROM purchases p
LEFT JOIN types t ON t.id = p.type_id
GROUP BY p.type_id
ORDER BY SUM(p.price) DESC
         */
        $data = DB::table('purchases')
            ->select(DB::raw('SUM(price) as price, product'))
            ->where('created_at', '=>', $filter->from->format('Y-m-d'))
            ->where('created_at', '<=', $filter->to->format('Y-m-d'));

        if ($filter->typeId) {
            $data->where('type_id', $filter->typeId);
            $data->groupBy('product');
        } else {
            $data->groupBy('type_id');
        }

        return $data->get();
    }

}
