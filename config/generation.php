<?php

use Codeat3\BladeIconGeneration\IconProcessor;
use Illuminate\Support\Str;

$svgNormalization = static function (string $tempFilepath, array $iconSet, SplFileInfo $sourceFile) {
    // perform generic optimizations
    $iconProcessor = new IconProcessor($tempFilepath, $iconSet, $sourceFile);
    $iconProcessor
        ->optimize(pre: function (&$svgEL) use ($sourceFile) {
            if (Str::of($sourceFile->getRealPath())->endsWith('-outline.svg')) {
                // outline icons
                $svgAsString = $svgEL->ownerDocument->saveXML();
                if ($svgEL->getAttribute('fill') !== 'none') {
                    $svgEL->setAttribute('fill', 'none');
                }

                if ($svgEL->getAttribute('stroke') !== 'currentColor') {
                    $svgEL->setAttribute('stroke', 'currentColor');
                }

                if (
                    ! Str::of($svgAsString)->contains(['fill'])
                    && ! Str::of($svgAsString)->contains(['stroke'])
                ) {
                    $svgEL->setAttribute('fill', 'currentColor');
                }
            } elseif (Str::of($sourceFile->getRealPath())->endsWith('-sharp.svg')) {
                $svgAsString = $svgEL->ownerDocument->saveXML();
                if ($svgEL->getAttribute('fill') !== 'currentColor') {
                    $svgEL->setAttribute('fill', 'currentColor');
                }
                if (
                    ! Str::of($svgAsString)->contains(['fill'])
                    && ! Str::of($svgAsString)->contains(['stroke'])
                ) {
                    $svgEL->setAttribute('fill', 'currentColor');
                }
            } else {
                $svgAsString = $svgEL->ownerDocument->saveXML();
                // solid icons
                if ($svgEL->getAttribute('fill') !== 'currentColor') {
                    $svgEL->setAttribute('fill', 'currentColor');
                }
                if (
                    ! Str::of($svgAsString)->contains(['fill'])
                    && ! Str::of($svgAsString)->contains(['stroke'])
                ) {
                    $svgEL->setAttribute('fill', 'currentColor');
                }
            }
        })
        ->postOptimizationAsString(function ($svgLine) use ($sourceFile) {
            // if (Str::of($sourceFile->getRealPath())->endsWith('add-circle-outline.svg')) {

            if (Str::of($sourceFile->getRealPath())->endsWith('-outline.svg')) {
                // outline icons
                $svgLine = str_replace([
                    'stroke="#000"',
                ], 'stroke="currentColor"', $svgLine);
                $svgLine = str_replace([
                    'stroke="black"',
                ], 'stroke="currentColor"', $svgLine);
                $svgLine = str_replace([
                    'stroke:#000;',
                ], 'stroke:currentColor;', $svgLine);
            } elseif (Str::of($sourceFile->getRealPath())->endsWith('-sharp.svg')) {
                // if (Str::of($svgLine)->contains(['<polygon', '<line'])) {
                //     // sharp icons
                //     $svgLine = str_replace([
                //         'stroke:#000;',
                //     ], 'stroke:currentColor;', $svgLine);
                // }
                $svgLine = str_replace([
                    'stroke="#000"',
                ], 'stroke="currentColor"', $svgLine);
                $svgLine = str_replace([
                    'stroke:#000;',
                ], 'stroke:currentColor;', $svgLine);
            } else {
                // solid icons

                $svgLine = str_replace([
                    'stroke:#000;',
                ], 'stroke:currentColor;', $svgLine);
            }

            // }
            // $svgLine = str_replace([
            //     'stroke="#000"',
            // ], 'stroke="currentColor"', $svgLine);
            // $svgLine = str_replace([
            //     'stroke:#000',
            // ], 'stroke=currentColor', $svgLine);
            // $svgLine = str_replace([
            //     'fill:none',
            // ], 'fill=currentColor', $svgLine);
            return $svgLine;
        })
        ->save();
};

return [
    [
        // Define a source directory for the sets like a node_modules/ or vendor/ directory...
        'source' => __DIR__ . '/../dist/',

        // Define a destination directory for your icons. The below is a good default...
        'destination' => __DIR__ . '/../resources/svg',

        // Enable "safe" mode which will prevent deletion of old icons...
        'safe' => false,

        // Call an optional callback to manipulate the icon
        // with the pathname of the icon and the settings from above...
        'after' => $svgNormalization,

        // 'is-solid' => true,

    ],
];
