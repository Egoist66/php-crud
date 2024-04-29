<?php
declare(strict_types=1);
/**
 * loops and prints content
 * @param array $content
 * @param bool $hasContainer
 * @param int $padding
 * @return void
 */
function loop(array $content, bool $hasContainer = true, int $padding = 0): void
{
    if ((count($content) > 0) && $hasContainer) {
        foreach ($content as $key => $value) {
            echo "<section style='padding: {$padding}px 0 {$padding}px 0' class='{$key}-section'>
            <div class='container'>
                <div class='wrapper'>
                    {$value}
                </div>
            </div>
        </section>";
        }
    }
    else {
        foreach ($content as $key => $value) {
            echo "<section style='padding: {$padding}px 0 {$padding}px 0' class='{$key}-section'>
                    
                <div class='wrapper'>
                    {$value}
                </div>
          
            </section>";
        }
    }



}