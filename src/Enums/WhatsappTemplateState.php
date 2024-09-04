<?php

namespace Iutrace\Botmaker\Enums;

class WhatsappTemplateState
{
    const ACCOUNT_PENDING    = 'ACCOUNT_PENDING';
    const APPROVED           = 'APPROVED';
    const REJECTED           = 'REJECTED';
    const BOTMAKER_PENDING   = 'BOTMAKER_PENDING';

    public static function allStates()
    {
        return [
            self::ACCOUNT_PENDING,
            self::APPROVED,
            self::REJECTED,
            self::BOTMAKER_PENDING,
        ];
    }

    public static function getState($state){

        $state ?? self::ACCOUNT_PENDING;

        if(!in_array($state, self::allStates())){
            throw new \Exception("invalid state");
        }

        return $state;
    }
}