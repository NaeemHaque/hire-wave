<?php

namespace App\Helpers;

class MarkdownHelper
{
    public static function render($text)
    {
        $html = $text;

        $html = preg_replace('/^### (.*$)/m', '<h3 class="text-xl font-semibold text-white mt-6 mb-3">$1</h3>', $html);
        $html = preg_replace('/^## (.*$)/m', '<h2 class="text-2xl font-semibold text-white mt-6 mb-3">$1</h2>', $html);
        $html = preg_replace('/^# (.*$)/m', '<h1 class="text-3xl font-bold text-white mt-6 mb-3">$1</h1>', $html);

        $html = preg_replace('/\*\*(.*?)\*\*/', '<strong class="font-semibold">$1</strong>', $html);
        $html = preg_replace('/\*(.*?)\*/', '<em class="italic">$1</em>', $html);
        $html = preg_replace('/`(.*?)`/', '<code class="bg-white/10 px-1 py-0.5 rounded text-sm">$1</code>', $html);

        $html = preg_replace('/\[([^\]]+)\]\(([^)]+)\)/', '<a href="$2" class="text-blue-400 hover:text-blue-300 transition-colors" target="_blank">$1</a>', $html);

        $html = preg_replace('/^\- (.*$)/m', '<li class="text-gray-300">$1</li>', $html);
        $html = preg_replace('/^(\d+)\. (.*$)/m', '<li class="text-gray-300">$2</li>', $html);
        $html = preg_replace('/(<li.*<\/li>)/s', '<ul class="list-disc list-inside space-y-2 text-gray-300">$1</ul>', $html);

        $html = preg_replace('/^(?!<[h|u|o]|<li>)([^\s].*$)/m', '<p class="text-gray-300 mb-4">$1</p>', $html);

        // Remove empty paragraph
        $html = preg_replace('/<p[^>]*><\/p>/', '', $html);

        return $html;
    }
}
