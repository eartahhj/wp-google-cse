<?php
namespace CodingHouse\WPPlugins;

abstract class PluginModel
{
    protected static $pluginName = '';

    abstract static function registerFields(): void;

    abstract static function settings_links(array $links = []): array;

    abstract static function add_admin_pages(): void;

    abstract static function template(): bool;

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
}
