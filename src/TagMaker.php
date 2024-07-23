<?php declare(strict_types=1);

namespace AhjDev\PhpTagMaker;

use DOMDocument;

final class TagMaker
{
    private bool $formatOutput = false;

    public function __construct()
    {
        \assert(\extension_loaded('dom'), 'Extension Dom not found');
    }

    /**
     * Nicely formats output with indentation and extra space.
     */
    public function formatOutput(bool $option): self
    {
        $this->formatOutput = $option;
        return $this;
    }

    public function run(Node $node): string
    {
        $dom  = new DOMDocument();
        $dom->formatOutput = $this->formatOutput;
        $dom->appendChild(
            $dom->importNode(
                $node->toDomNode(),
                true
            )
        );
        return $dom->saveHTML();
    }

    public static function build(Node $node): string
    {
        return (new self)->run($node);
    }
}
