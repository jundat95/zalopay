<?php
/************************************************************
 * *
 *  * Copyright © Boolfly. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@boolfly.com
 * *  @project   ZaloPay
 */
namespace Boolfly\ZaloPay\Gateway\Validator;

use Boolfly\ZaloPay\Gateway\Helper\Authorization;
use Boolfly\ZaloPay\Gateway\Helper\Rate;
use Boolfly\ZaloPay\Gateway\Request\AbstractDataBuilder;
use Magento\Payment\Gateway\Validator\AbstractValidator;
use Magento\Payment\Gateway\Validator\ResultInterfaceFactory;

/**
 * Class AbstractResponseValidator
 */
abstract class AbstractResponseValidator extends AbstractValidator
{

    /**
     * The amount that was authorised for this transaction
     */
    const TOTAL_AMOUNT = 'amount';

    /**
     * The transaction type that this transaction was processed under
     * One of: Purchase, MOTO, Recurring
     */
    const TRANSACTION_TYPE = 'transactionType';

    /**
     * Pay Url
     */
    const PAY_URL = 'orderurl';

    /**
     * Transaction Id
     */
    const TRANSACTION_ID = 'transId';

    /**
     * Error Code
     */
    const ERROR_CODE = 'errorCode';

    /**
     * Return Code
     */
    const RETURN_CODE = 'returncode';

    /**
     * Error Code Accept
     */
    const ERROR_CODE_ACCEPT = '0';

    /**
     * Return Code Accept
     */
    const RETURN_CODE_ACCEPT = 1;

    /**
     * Message
     */
    const RESPONSE_MESSAGE = 'message';

    /**
     * Local Response
     */
    const RESPONSE_LOCAL_MESSAGE = 'localMessage';

    /**
     * Order Type
     */
    const ORDER_TYPE = 'orderType';

    /**
     * Response Time
     */
    const RESPONSE_TIME = 'responseTime';

    /**
     * Pay type: qr or web
     */
    const PAY_TYPE = 'payType';

    /**
     * @var Rate
     */
    protected $helperRate;

    /**
     * @var Authorization
     */
    protected $authorization;

    /**
     * AbstractResponseValidator constructor.
     *
     * @param ResultInterfaceFactory $resultFactory
     * @param Authorization          $authorization
     * @param Rate                   $helperRate
     */
    public function __construct(
        ResultInterfaceFactory $resultFactory,
        Authorization $authorization,
        Rate $helperRate
    ) {
        parent::__construct($resultFactory);
        $this->helperRate    = $helperRate;
        $this->authorization = $authorization;
    }

    /**
     * @param array $response
     * @return boolean
     */
    protected function validateErrorCode(array $response)
    {
        return isset($response[self::ERROR_CODE])
            && ((string)$response[self::ERROR_CODE] === (string)self::ERROR_CODE_ACCEPT);
    }

    /**
     * @param array $response
     * @return boolean
     */
    protected function validateReturnCode(array $response)
    {
        return isset($response[self::RETURN_CODE])
            && ((string)$response[self::RETURN_CODE] === (string)self::RETURN_CODE_ACCEPT);
    }

    /**
     * @param array $response
     * @return boolean
     */
    protected function validateTransactionId(array $response)
    {
        return isset($response[self::TRANSACTION_ID])
            && $response[self::TRANSACTION_ID];
    }
}
