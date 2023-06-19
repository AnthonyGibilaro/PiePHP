<?php

namespace Core;

class TemplateEngine {
    static function template($f) {
        
        $file_content = file_get_contents($f);
        $file_content = preg_replace('/\{\{\s*(.+?)\s*\}\}/', '<?= htmlentities ($1) ?>', $file_content);
        $file_content = preg_replace('/@if\s*\((.+?)\)/', '<?php if ($1): ?>', $file_content);
        $file_content = preg_replace('/@elseif\s*\((.+?)\)/', '<?php elseif ($1): ?>', $file_content);
        $file_content = str_replace('@else', '<?php else: ?>', $file_content);
        $file_content = str_replace('@endif', '<?php endif; ?>', $file_content);
        $file_content = preg_replace('/@foreach\s*\((.+?)\)/', '<?php foreach ($1): ?>', $file_content);
        $file_content = str_replace('@endforeach', '<?php endforeach; ?>', $file_content);
        $file_content = preg_replace('/@isset\s*\((.+?)\)/', '<?php if (isset($1)): ?>', $file_content);
        $file_content = str_replace('@endisset', '<?php endif; ?>', $file_content);
        $file_content = preg_replace('/@empty\s*\((.+?)\)/', '<?php if (empty ($1)): ?>', $file_content);
        $file_content = str_replace('@endempty', '<?php endif; ?>', $file_content);
        return $file_content;
    }
}