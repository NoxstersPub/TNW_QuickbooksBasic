<?php
/**
 * Copyright © 2018 TechNWeb, Inc. All rights reserved.
 * See TNW_LICENSE.txt for license details.
 */
namespace TNW\QuickbooksBasic\Model\Logger\Processor;

class UidProcessor
{
    private $uid;

    public function __construct($length = 7)
    {
        if (!is_int($length) || $length > 64 || $length < 1) {
            throw new \InvalidArgumentException('The uid length must be an integer between 1 and 64');
        }

        $this->uid = substr(hash('sha256', uniqid('', true)), 0, $length);
    }

    public function __invoke(array $record)
    {
        $record['extra']['uid'] = $this->uid;

        return $record;
    }

    public function uid()
    {
        return $this->uid;
    }
}
