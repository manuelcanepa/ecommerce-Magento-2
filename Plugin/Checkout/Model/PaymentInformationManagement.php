<?php
namespace Improntus\Moova\Plugin\Checkout\Model;

/**
 * Class PaymentInformationManagement
 *
 * @author Improntus <http://www.improntus.com> - Ecommerce done right
 * @package Improntus\Moova\Plugin\Checkout\Model
 */
class PaymentInformationManagement
{
    /**
     * @var \Improntus\Moova\Helper\Data
     */
    protected $helper;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * PaymentInformationManagement constructor.
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Improntus\Moova\Helper\Data $helper
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Improntus\Moova\Helper\Data $helper
    ) {
        $this->logger = $logger;
        $this->helper = $helper;
    }

    /**
     * @param \Magento\Checkout\Model\PaymentInformationManagement $subject
     * @param $cartId
     * @param \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
     * @param \Magento\Quote\Api\Data\AddressInterface $address
     */
    public function beforeSavePaymentInformation(
        \Magento\Checkout\Model\PaymentInformationManagement $subject,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $address
    ) {
        $extAttributes = $address->getExtensionAttributes();

        if (!empty($extAttributes))
        {
            $this->helper->transportFieldsFromExtensionAttributesToObject(
                $extAttributes,
                $address,
                'extra_checkout_billing_address_fields'
            );
        }
    }
}