<?php

namespace Tests\Unit;

use App\Support\CategoryIcon;
use PHPUnit\Framework\TestCase;

class CategoryIconTest extends TestCase
{
    public function test_encoded_svg_is_repaired_and_stays_stable_on_repeated_saves(): void
    {
        $svg = '<svg viewBox="0 0 24 24"><path fill="#10a37f" d="M0 0h24v24z"/></svg>';
        $encoded = htmlspecialchars(htmlspecialchars($svg, ENT_QUOTES), ENT_QUOTES);
        $icon = CategoryIcon::normalize($encoded);
        $this->assertSame(CategoryIcon::normalize($svg), $icon);
        $this->assertSame($icon, CategoryIcon::normalize($icon));
        $this->assertStringContainsString('<path', $icon);
        $this->assertSame('📦', CategoryIcon::normalize('📦'));
    }

    public function test_repaired_svg_does_not_execute_scripts_or_load_external_content(): void
    {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" onload="alert(1)"><script>alert(1)</script><foreignObject/><use href="https://example.com/icon.svg#x"/><path fill="url(https://example.com/x)" d="M0 0h1"/></svg>';
        $icon = CategoryIcon::normalize(htmlspecialchars($svg, ENT_QUOTES));
        foreach (['onload', '<script', 'foreignObject', 'https://'] as $value) {
            $this->assertStringNotContainsString($value, $icon);
        }
        $this->assertStringContainsString('<path', $icon);
    }
}
