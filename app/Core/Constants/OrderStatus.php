<?php

namespace App\Core\Constants;

use App\Core\Utils\Enum;

class OrderStatus extends Enum
{
    const CREATED = 'created';
    const EXPIRED = 'expired';
    const ANALYSIS = 'analysis';
    const PAID = 'paid';
    const COMPLETED = 'completed';
    const REFUNDED = 'refunded';
    const CHARGEBACK = 'chargeback';

    static $labels = [
        self::CREATED => 'registro criado',
        self::EXPIRED => 'prazo para pagamento expirado ou ordem cancelada',
        self::ANALYSIS => 'pago e em processo de análise anti-fraude',
        self::PAID => 'pago',
        self::COMPLETED => 'pago e saldo disponível',
        self::REFUNDED => 'pago e devolvido',
        self::CHARGEBACK => 'pago e com chargeback'
    ];
}
