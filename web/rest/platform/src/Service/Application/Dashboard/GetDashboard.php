<?php

namespace Service\Application\Dashboard;

use Model\Dashboard\Dashboard;
use Model\Dashboard\DashboardBrand;

class GetDashboard
{
    public function __construct()
    {
    }

    public function execute(): Dashboard
    {

        return new Dashboard(
            [
                new DashboardBrand(
                    1,
                    '$name',
                    '$nif',
                    '$sipDomain',
                    10,
                )
            ],
            1,
            2,
            3
        );
    }
}
