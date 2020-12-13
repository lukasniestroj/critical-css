<?php


namespace LukasNiestroj\CriticalCss\XClass;

/**
 * Class PageRenderer
 * @package LukasNiestroj\CriticalCss\XClass
 */
class PageRenderer extends \TYPO3\CMS\Core\Page\PageRenderer
{

    /**
     * @return string
     */
    protected function renderCssFiles()
    {
        $cssFiles = '';
        if (!empty($this->cssFiles)) {
            foreach ($this->cssFiles as $file => $properties) {
                $tag = $this->createCssTag($properties, $file);
                if ($properties['forceOnTop']) {
                    $cssFiles = $tag . $cssFiles;
                } else {
                    $cssFiles .= $tag;
                }
            }
        }
        return $cssFiles;
    }

    /**
     * @return string
     */
    protected function renderCssLibraries()
    {
        $cssFiles = '';
        if (!empty($this->cssLibs)) {
            foreach ($this->cssLibs as $file => $properties) {
                $tag = $this->createCssTag($properties, $file);
                if ($properties['forceOnTop']) {
                    $cssFiles = $tag . $cssFiles;
                } else {
                    $cssFiles .= $tag;
                }
            }
        }
        return $cssFiles;
    }


    /**
     * Create link (inline=0) or style (inline=1) tag
     *
     * @param array $properties
     * @param string $file
     * @return string
     */
    private function createCssTag(array $properties, string $file): string
    {
        if ($properties['inline'] && @is_file($file)) {
            $tag = $this->createInlineCssTagFromFile($file, $properties);
        } else {
            $href = $this->getStreamlinedFileName($file);
            if ($properties['critical']) {
                $tag = '<link rel="' . htmlspecialchars($properties['rel'])
                    . '" type="text/css" href="' . htmlspecialchars($href)
                    . '" media="' . htmlspecialchars($properties['media']) . '"'
                    . ($properties['title'] ? ' title="' . htmlspecialchars($properties['title']) . '"' : '')
                    . $this->endingSlash . '>';
            } else {
                // https://www.filamentgroup.com/lab/load-css-simpler/
                $tag = '<link rel="' . htmlspecialchars($properties['rel'])
                    . '" href="' . htmlspecialchars($href)
                    . '" media="print"'
                    . ' onload="this.media=\''. htmlspecialchars($properties['media']) .'\'"'
                    . ($properties['title'] ? ' title="' . htmlspecialchars($properties['title']) . '"' : '')
                    . $this->endingSlash . '>';
                $tag .= LF;
                // append a noscript fallback
                $tag .= '<noscript><link rel="' . htmlspecialchars($properties['rel'])
                    . '" type="text/css" href="' . htmlspecialchars($href)
                    . '" media="' . htmlspecialchars($properties['media']) . '"'
                    . ($properties['title'] ? ' title="' . htmlspecialchars($properties['title']) . '"' : '')
                    . $this->endingSlash . '></noscript>';
            }
        }
        if ($properties['allWrap']) {
            $wrapArr = explode($properties['splitChar'] ?: '|', $properties['allWrap'], 2);
            $tag = $wrapArr[0] . $tag . $wrapArr[1];
        }
        $tag .= LF;

        return $tag;
    }
}