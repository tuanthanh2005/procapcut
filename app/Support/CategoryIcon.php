<?php

namespace App\Support;

use DOMDocument;
use DOMElement;

class CategoryIcon
{
    public static function normalize(?string $value): string
    {
        $value = trim($value ?? '');
        // Older edit forms encoded the SVG again on every save.
        for ($depth = 0; $depth < 5 && preg_match('/^&(?:amp;)*lt;svg\b/i', $value); $depth++) {
            $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
        if (! preg_match('/^<svg\b/i', $value)) {
            return $value;
        }

        $document = new DOMDocument();
        $previousErrors = libxml_use_internal_errors(true);
        try {
            if (! $document->loadXML($value, LIBXML_NONET) || $document->doctype !== null
                || $document->documentElement->localName !== 'svg') {
                return '';
            }
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previousErrors);
        }

        $allowed = ['svg', 'g', 'path', 'circle', 'ellipse', 'line', 'polyline', 'polygon', 'rect', 'defs', 'linearGradient', 'radialGradient', 'stop', 'clipPath', 'mask', 'title', 'desc', 'use'];
        $clean = function (DOMElement $element) use (&$clean, $allowed): void {
            foreach (iterator_to_array($element->attributes) as $attribute) {
                $name = strtolower($attribute->nodeName);
                $value = trim($attribute->nodeValue);
                if (str_starts_with($name, 'on') || $name === 'style'
                    || (in_array($name, ['href', 'xlink:href'], true) && ! str_starts_with($value, '#'))
                    || (stripos($value, 'url(') !== false && ! preg_match('/^url\(\s*#[\w.-]+\s*\)$/i', $value))) {
                    $element->removeAttributeNode($attribute);
                }
            }
            foreach (iterator_to_array($element->childNodes) as $child) {
                if ($child instanceof DOMElement) {
                    if (! in_array($child->localName, $allowed, true)) {
                        $element->removeChild($child);
                    } else {
                        $clean($child);
                    }
                }
            }
        };
        $clean($document->documentElement);

        return $document->saveXML($document->documentElement);
    }
}
