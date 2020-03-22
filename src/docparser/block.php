<?php

namespace wulfheart\lxcd\docparser;

use Illuminate\Support\Facades\Log;

use function Composer\Autoload\includeFile;


class Block
{
    private $description;
    private $inlinetag;
    private $summary;
    private $params;

    public function __construct()
    {
        $this->params = [];
    }

    public function parse(string $docblock)
    {
        $docblock = trim($docblock, " \t\n\r\0\x0B/*");
        // Remove whitespace from the start of the line
        $lines = explode("\n", $docblock);
        foreach ($lines as $key => $line) {
            $lines[$key] = ltrim($line, " *");
        }

        // Everything else is trimmed away because of trim
        $this->summary = $lines[0];
        if (!empty($lines[1])) {
            // TODO: Poor Error Handling
            return "A summary has to end with two newlines!";
        }

        // Description construction
        $desc_start = 2;
        $desc_end = 0;
        for ($i = $desc_start; $i < count($lines); $i++) {
            // Remove outer whitespace
            $lines[$i] = trim($lines[$i]);
            if (empty($lines[$i])) {
                $desc_end = $i;
                break;
            }
        }
        $desc_array = array_slice($lines, $desc_start, $desc_end - $desc_start);
        $this->description = implode(" ", $desc_array);

        // Tags
        // ! Just don't start a line with an @ unless it is a param. What 
        // ! are you thinking? This is only a naive implementation!
        foreach ($lines as $line) {
            if (!empty($line) && Helpers::has_prefix($line, "@param")) {
                array_push($this->params, new Param($line));
            }
        }
        dd($this->params);
    }

    
}
