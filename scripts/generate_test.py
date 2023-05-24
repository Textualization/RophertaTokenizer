from transformers import AutoTokenizer

roberta_tokenizer = AutoTokenizer.from_pretrained("roberta-base")



with open("../vendor/gioni06/gpt3-tokenizer/tests/__fixtures__/long_text.txt", 'r') as f, \
     open("../tests/TokenizerTest.php", 'wt') as t:
    t.write("""<?php
namespace Textualization\Ropherta\Tests;

use Textualization\Ropherta\Tokenizer;
use PHPUnit\Framework\TestCase;

class TokenizerTest extends TestCase {
    private Tokenizer $tokenizer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tokenizer = new Tokenizer();
    }

    public function test_long_text() : void
    {
        $longText = file_get_contents(__DIR__ . '/../vendor/gioni06/gpt3-tokenizer/tests/__fixtures__/long_text.txt');
        $tokens = $this->tokenizer->encode($longText);
""")
    long_text = f.read()
    tokens = roberta_tokenizer(long_text, return_tensors="np")["input_ids"][0]
    t.write("""
        $this->assertEquals({}, count($tokens));
""".format(len(tokens)-2))

    #TODO test random tokens
    
    t.write("""
    }

    public function test_long_text_lines() : void
    {
""")
    lines = long_text.split("\n")
    for line in lines:
        t.write("""
        $tokens = $this->tokenizer->encode('{}');
""".format(line.replace("'", "\\'")))
        tokens = roberta_tokenizer(line, return_tensors="np")["input_ids"][0]
        t.write("""
        $this->assertEquals([{}], $tokens);
        $this->assertEquals({}, count($tokens));
""".format(",".join(map(str,tokens[1:-1])),len(tokens)-2))
    t.write("""
    }
    
    
}
""")
    
    
    
    
