<?php 

class Utils {


    public static function redirect(string $action, array $params = []) : void
    {
        $url = "index.php?action=$action";
        foreach ($params as $paramName => $paramValue) {
            $url .= "&$paramName=$paramValue";
        }
        header("Location: $url");
        exit();
    }

    public static function request(string $variableName, mixed $defaultValue = null, bool $raw = false) : mixed
    {
        $value = $_REQUEST[$variableName] ?? $defaultValue;

        if (!$raw && is_string($value)) {
            $value = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
        }

        return $value;
    }


    public static function file(string $variableName, mixed $defaultValue = null) : mixed
    {
        return $_FILES[$variableName] ?? $defaultValue;
    }

    public static function askConfirmation(string $message) : string
    {
        return "onclick=\"return confirm('$message');\"";
    }


    public static function formatShortDate(DateTime $date) : string
    {
        $today = new DateTime('today');
        if ($date >= $today) {
            return $date->format('H:i');
        }
        return $date->format('d.m');
    }

    public static function truncate(string $text, int $length = 15) : string
    {
        if (mb_strlen($text) <= $length) {
            return $text;
        }
        return mb_substr($text, 0, $length) . '...';
    }

}