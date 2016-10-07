<?php

use League\CommonMark\CommonMarkConverter;

function markdownToHtml(string $markdown)
{
    $converter = new CommonMarkConverter();

    return $converter->convertToHtml($markdown);
}

/**
 * Flash message function
 *
 * @param  string|null $title
 * @param  string|null $message
 * @return session
 */
function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash');

    if (func_num_args() == 0) {
        return $flash;
    }

    return $flash->info($title, $message);
}

function linkTo($body, $path, $type)
{
    $csrf = csrf_field();
    $method = method_field($type);

    if (is_object($path)) {
        $action = '/' . $path->getTable();

        if (in_array($type, ['PUT', 'PATCH', 'DELETE'])) {
            $action .= '/' . $path->getKey();
        }
    } else {
        $action = $path;
    }

    return <<<EOT
        <form method="POST" action="{$action}">
            $method
            $csrf
            <button type="submit">{$body}</button>
        </form>
EOT;
}