<?php

namespace App\Types;

/**
 * Tag
 */
enum Tag: string
{
    case MANAGEMENT    = 'Management';
    case DATABASE      = 'Database';
    case SYSTEM_DESIGN = 'SystemDesign';

    /**
     * message
     *
     * @return string
     */
    public function message(): string
    {
        return "指定したタグは{$this->value}です";
    }
}
