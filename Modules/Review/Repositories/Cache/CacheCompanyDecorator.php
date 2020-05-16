<?php

namespace Modules\Review\Repositories\Cache;

use Modules\Review\Repositories\CompanyRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCompanyDecorator extends BaseCacheDecorator implements CompanyRepository
{
    public function __construct(CompanyRepository $company)
    {
        parent::__construct();
        $this->entityName = 'review.companies';
        $this->repository = $company;
    }
}
