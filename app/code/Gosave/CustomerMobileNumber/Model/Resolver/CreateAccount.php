<?php

namespace Gosave\CustomerMobileNumber\Model\Resolver;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class CreateAccount implements ResolverInterface
{
    const FIRSTNAME = 'firstname';
    const LASTNAME  = 'lastname';

    public function __construct(
        private CustomerRepositoryInterface $customerRepository,
        private CustomerInterfaceFactory $customerFactory
    ) {}

    public function resolve(
        Field $field,
              $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    )
    {
        $mobileNumber = $args['input']['mobileNumber'];

        // Fix constant values
        $firstName = self::FIRSTNAME;
        $lastName  = self::LASTNAME;

        // Generate email using mobile
        $emailFormat = '%s@example.com';
        $email = sprintf($emailFormat, $mobileNumber);

        try {
            // Create a new customer
            $customer = $this->customerFactory->create();
            $customer->setFirstname($firstName);
            $customer->setLastname($lastName);
            $customer->setEmail($email);
            $customer->setCustomAttribute('mobile_number', $mobileNumber);
            $customer->setConfirmation(null);
            $customer = $this->customerRepository->save($customer);
        } catch (LocalizedException $e) {
            throw new GraphQlInputException(__('Customer with the given mobile number already exists.'));
        }

        // Return the created customer data
        $output = [
            'customer' => [
                'id' => $customer->getId(),
                'message' => 'Customer registration success'
            ],
        ];

        return $output;
    }
}
