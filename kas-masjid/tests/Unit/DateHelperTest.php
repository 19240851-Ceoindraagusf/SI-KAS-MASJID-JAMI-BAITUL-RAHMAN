<?php

namespace Tests\Unit;

use App\Helpers\DateHelper;
use Tests\TestCase;

class DateHelperTest extends TestCase
{
    public function test_it_formats_audit_log_time_in_indonesia_timezone(): void
    {
        $result = DateHelper::formatIndonesianAuditLog('2026-07-06 00:00:00 UTC');

        $this->assertSame('06 Juli 2026, 07:00:00', $result);
    }
}
