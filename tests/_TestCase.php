<?php

declare(strict_types=1);

namespace Tests\Enjoys\Forms\Renderer\Bootstrap4;

class _TestCase extends \PHPUnit\Framework\TestCase
{
    public function stringOneLine(string $input, bool $replaceTab = true): string
    {
        if ($replaceTab) {
            $input = str_replace(["\t", str_repeat(" ", 4)], "", $input);
        }

        return str_replace(["\r\n", "\r", "\n"], "", $input);
    }
}
