<?php

namespace Iutrace\Botmaker\Enums;

class WhatsappTemplateState
{
    const ACCOUNT_PENDING    = 'account_pending';
    const APPROVED           = 'approved';
    const REJECTED           = 'rejected';
    const BOTMAKER_PENDING   = 'botmaker_pending';

    public static function allStates()
    {
        return [
            self::ACCOUNT_PENDING,
            self::APPROVED,
            self::REJECTED,
            self::BOTMAKER_PENDING,
        ];
    }
}