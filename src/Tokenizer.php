<?php

namespace Textualization\Ropherta;

use Gioni06\Gpt3Tokenizer\Gpt3Tokenizer;
use Gioni06\Gpt3Tokenizer\Gpt3TokenizerConfig;

class Tokenizer extends Gpt3Tokenizer {

    public function __construct($useCache = true)
    {
        $config = new Gpt3TokenizerConfig();
        parent::__construct($config
                            -> mergesPath(__DIR__.'/merges.txt')
                            -> vocabPath(__DIR__.'/vocab.json')
                            -> useCache($useCache));
    }
}
