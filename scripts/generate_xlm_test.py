from transformers import AutoTokenizer

xlm_roberta_tokenizer = AutoTokenizer.from_pretrained("intfloat/multilingual-e5-small")



with open("../vendor/gioni06/gpt3-tokenizer/tests/__fixtures__/long_text.txt", 'r') as f, \
     open("../tests/XLMTokenizerTest.php", 'wt') as t:
    t.write("""<?php
namespace Textualization\Ropherta\Tests;

use Textualization\Ropherta\XLMTokenizer;
use Textualization\Ropherta\Tokenizer\Vendor;
use PHPUnit\Framework\TestCase;

class XLMTokenizerTest extends TestCase {
    private XLMTokenizer $tokenizer;

    protected function setUp(): void
    {
        parent::setUp();
        if (! file_exists(Vendor::model())) {
            $this->markTestSkipped('Execute Vendor::check()');
        }
        $this->tokenizer = new XLMTokenizer();
    }

    public function test_long_text() : void
    {
        $longText = file_get_contents(__DIR__ . '/../vendor/gioni06/gpt3-tokenizer/tests/__fixtures__/long_text.txt');
        $tokens = $this->tokenizer->encode(substr($longText, 0, 512));
""")
    long_text = f.read()
    tokens = xlm_roberta_tokenizer(long_text[:512], return_tensors="np")["input_ids"][0]
    t.write("""
        $this->assertEquals({}, count($tokens));
""".format(len(tokens)))

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
        tokens = xlm_roberta_tokenizer(line, return_tensors="np")["input_ids"][0]
        t.write("""
        $this->assertEquals([{}], $tokens);
        $this->assertEquals({}, count($tokens));
""".format(",".join(map(str,tokens)),len(tokens)))
    t.write("""
    }
    
    
}
""")
    
    
    
    
