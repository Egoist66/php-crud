<?php
declare(strict_types=1);
/**
 * loops and prints content
 * @param array $content
 * @param string $tag
 * @param bool $hasContainer
 * @param string $padding
 * @param string $class
 * @return void
 */
function loop(array $content, string $tag = 'div', bool $hasContainer = true, string $padding = '20px', string $class = 'section'): void
{
    if ((count($content) > 0) && $hasContainer) {
        foreach ($content as $key => $value) {
            echo "<$tag style='padding: {$padding}' class='{$key}-$class'>
            <div class='container'>
                <div class='wrapper'>
                    {$value}
                </div>
            </div>
        <$tag/>";
        }
    } else {
        foreach ($content as $key => $value) {
            echo "<$tag style='padding: {$padding}' class='{$key}-$class'>
                    
                <div class='wrapper'>
                    {$value}
                </div>
          
            <$tag/>";
        }
    }


}