<?php

namespace App\Quality;

enum ActionType
{
    case INCREMENT;
    case DECREMENT;
    case SET;
}
