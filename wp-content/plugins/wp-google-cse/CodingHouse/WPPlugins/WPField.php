<?php
namespace CodingHouse\WPPlugins;

// NOTE: This is not being used at the moment, but could be
// useful in the future to simplify the registerFields() method

class WPField {
    protected $name = '';
    protected $group = '';
    protected $label = '';
    protected $section = '';
    protected $labelFor = '';
    protected $cssClass = '';
    protected $type = '';
    protected $help = '';

    public function setName(string $name): void
    {
        $this->name = $name;
        return;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setGroup(string $group): void
    {
        $this->group = $group;
        return;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
        return;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setSection(string $section): void
    {
        $this->section = $section;
        return;
    }

    public function getSection(): string
    {
        return $this->section;
    }

    public function setLabelFor(string $labelFor): void
    {
        $this->labelFor = $labelFor;
        return;
    }

    public function getLabelFor(): string
    {
        return $this->labelFor;
    }

    public function setCssClass(string $cssClass): void
    {
        $this->cssClass = $cssClass;
        return;
    }

    public function getCssClass(): string
    {
        return $this->cssClass;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
        return;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setHelp(string $help): void
    {
        $this->help = $help;
        return;
    }

    public function getHelp(): string
    {
        return $this->help;
    }
}
