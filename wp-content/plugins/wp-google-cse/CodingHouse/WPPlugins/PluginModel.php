<?php
namespace CodingHouse\WPPlugins;

require_once __DIR__ . '/WPField.php';

abstract class PluginModel
{
    protected static $pluginName = '';
    protected static $options = [];

    abstract public static function registerFields(): void;

    abstract public static function settings_links(array $links = []): array;

    abstract public static function add_admin_pages(): void;

    abstract public static function template(): bool;

    public function getPluginName(): string
    {
        return self::$pluginName;
    }

    public static function activate(): bool
    {
        return true;
    }

    public static function deactivate(): bool
    {
        return true;
    }

    public static function uninstall(): bool
    {
        foreach (self::$options as $option) {
            if (!$deleted = delete_option($option)) {
                return false;
            }
        }

        return true;
    }

    public static function enqueue(): void
    {
        return;
    }

    public static function register(): void
    {
        return;
    }

    public static function registerField(WPField $field, callable $callback): void
    {
        register_setting($field->getGroup(), $field->getName(), $callback);
        add_settings_field(
            $field->getName(),
            $field->getLabel(),
            $callback,
            self::$pluginName, $field->getSection(), ['label_for' => $field->getLabelFor(), 'class' => $field->getCssClass()]
        );

        return;
    }
}
