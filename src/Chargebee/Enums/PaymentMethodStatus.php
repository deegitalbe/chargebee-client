<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Enums;

enum PaymentMethodStatus: string
{
    case VALID = "valid";
    case EXPIRING = "expiring";
    case EXPIRED = "expired";
    case INVALID = "invalid";
    case PENDING_VERIFICATION = "pending_verification";
}
