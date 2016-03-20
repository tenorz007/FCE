<?php
/**
 * Created by BrainMaestro
 * Date: 13/3/2016
 * Time: 1:53 PM
 */

namespace Fce\Utility;

class Status
{
    /**
     * Constants for depicting the status of a section or question set.
     */
    const OPEN = 'Open';
    const LOCKED = 'Locked';
    const IN_PROGRESS = 'In Progress';
    const DONE = 'Done';

    const STATUSES = [
        self::OPEN,
        self::LOCKED,
        self::IN_PROGRESS,
        self::DONE
    ];
}