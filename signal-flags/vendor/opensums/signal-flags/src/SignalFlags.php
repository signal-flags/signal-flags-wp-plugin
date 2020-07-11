<?php

declare(strict_types=1);

namespace SignalFlagsPlugin\SignalFlags;

class SignalFlags {

    protected $flagsDir = __DIR__.'/../flags';

    protected static $defaults = [
        'flagsFile' => 'flags-0',
    ];

    public function __construct(array $options = []) {
        $this->settings = array_merge(self::$defaults, $options);
        $this->setDefaultFlags($this->settings['flagsFile']);
    }

    public function setDefaultFlags(string $file, bool $absolute = false): self {
        try {
            $fileName = $absolute ? $file : "{$this->flagsDir}/{$file}.php";
            $flags = file_exists($fileName) ? include($fileName) : false;
            if ($flags) {
                $this->flags = $flags;
                return $this;
            }
        } catch (\Throwable $e) {
        }
        throw new \Exception('Could not load flags file ' . $fileName);
    }

    public function all(): array {
        return $this->flags['flags'];
    }

    public function keys(): array {
        return array_keys($this->flags['flags']);
    }

    public function get(string $id, array $options = []): string {
        if (!array_key_exists($id, $this->flags['flags'])) {
            throw new \Exception("Signal flag $id does not exist");
        }
        return $this->applyOptions($this->flags['flags'][$id], $options);
    }

    public function has(string $id): bool {
        return array_key_exists($id, $this->flags['flags']);
    }

    public function getFlagSetFiles() {
        return glob(__DIR__.'/../flags/*');
    }

    public function getMeta() {
        return $this->flags['meta'];
    }

    protected function applyOptions(string $svg, array $options = []): string {
        $styles = [];
        foreach ($options as $option => $value) {
            if ($value === null) continue;
            switch ($option) {
                case 'height':
                    if (is_numeric($value)) {
                        $styles[] = "height: {$value}px";
                    } elseif ($value === 'inline') {
                        $styles[] = 'display: inline';
                        $styles[] = 'vertical-align: text-bottom';
                        $styles[] = 'height: 1.2em';
                    } elseif ($value === 'inline-l') {
                        $styles[] = 'display: inline';
                        $styles[] = 'vertical-align: text-bottom';
                        $styles[] = 'height: 1.5em';
                    } elseif ($value === 'inline-s') {
                        $styles[] = 'display: inline';
                        $styles[] = 'vertical-align: text-bottom';
                        $styles[] = 'height: 1em';
                    } else {
                        $styles[] = "height: {$value}";
                    }
                    break;
                case 'display':
                    $styles[] = "display: {$value}";
                    break;
                case 'width':
                    $styles[] = is_numeric($value) ? "width: {$value}px" : "width: {$value}";
                    break;
                case 'margin':
                    $styles[] = is_numeric($value) ? "margin: {$value}px" : "margin: {$value}";
                    break;
                case 'display':
                    $styles[] = "display: {$value}";
                    break;
                default:
            }
        }
        if (!$styles) return $svg;
        $styles = implode('; ', $styles);
        return str_replace('<svg', "<svg style='$styles'", $svg);
    }
}
