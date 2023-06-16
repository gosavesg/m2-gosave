<?php

namespace Gosave\CustomerMobileNumber\Model;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class CheckMobileNumber
{
    private $customerRepository;
    private $searchCriteriaBuilder;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Check if the mobile number exists in customer records.
     *
     * @param string $mobileNumber
     * @return bool
     */
    public function isMobileNumberExists($mobileNumber)
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('mobile_number', $mobileNumber, 'eq')
            ->create();

        $customerList = $this->customerRepository->getList($searchCriteria);
        $totalCustomers = $customerList->getTotalCount();

        return ($totalCustomers > 0);
    }
}
