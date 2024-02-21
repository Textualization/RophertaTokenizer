from transformers import AutoTokenizer

xlm_roberta_tokenizer = AutoTokenizer.from_pretrained("intfloat/multilingual-e5-small")

def tokenize(text):
    WHITESPACE = set([' ', '\t']) #'\r', '\t', '\n'])
    length = len(text)
    result = []
    while len(text) > 512:
        idx = 511
        while idx > 0 and text[idx] not in WHITESPACE: ##not text[idx].isspace():
            idx -= 1
        if idx <= 0:
            idx = 512
        segment = text[0:idx]
        text = text[idx:]
        token_ids = xlm_roberta_tokenizer(segment, return_tensors="np")["input_ids"][0]
        if len(result) == 0:
            result.append(token_ids[0])
        result.extend(token_ids[1:-1])
        if len(text) == 0:
            result.append(token_ids[-1])

    if len(text) > 0:
        token_ids = xlm_roberta_tokenizer(text, return_tensors="np")["input_ids"][0]
        if len(result) == 0:
            result.append(token_ids[0])
        result.extend(token_ids[1:])

    return result

input_texts = [
    'query: how much protein should a female eat',
    'query: 南瓜的家常做法',
    "passage: As a general guideline, the CDC's average requirement of protein for women ages 19 to 70 is 46 grams per day. But, as you can see from this chart, you'll need to increase that if you're expecting or training for a marathon. Check out the chart below to see how much protein you should be eating each day.",
    "passage: 1.清炒南瓜丝 原料:嫩南瓜半个 调料:葱、盐、白糖、鸡精 做法: 1、南瓜用刀薄薄的削去表面一层皮,用勺子刮去瓤 2、擦成细丝(没有擦菜板就用刀慢慢切成细丝) 3、锅烧热放油,入葱花煸出香味 4、入南瓜丝快速翻炒一分钟左右,放盐、一点白糖和鸡精调味出锅 2.香葱炒南瓜 原料:南瓜1只 调料:香葱、蒜末、橄榄油、盐 做法: 1、将南瓜去皮,切成片 2、油锅8成热后,将蒜末放入爆香 3、爆香后,将南瓜片放入,翻炒 4、在翻炒的同时,可以不时地往锅里加水,但不要太多 5、放入盐,炒匀 6、南瓜差不多软和绵了之后,就可以关火 7、撒入香葱,即可出锅",
    'query: órden social y su relación con los derechos de las personas',
    "passage: Je veux chercher si dans l’ordre civil il peut y avoir quelque regle d’administration légitime & sûre, en prenant les hommes tels qu’ils sont, & les loix telles qu’elles peuvent être : Je tâcherai d’allier toujours dans cette recherche ce que le droit permet avec ce que l’intérêt prescrit, afin que la justice & l’utilité ne se trouvent point divisées."
]



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
        $tokens = $this->tokenizer->encode($longText);
""")
    long_text = f.read()
    tokens = tokenize(long_text)
    t.write("""
        $this->assertEquals({}, count($tokens));
""".format(len(tokens)))

    #TODO test random tokens
    
    t.write("""
    }

    public function test_multingual_lines() : void
    {
""")
    for line in input_texts:
        t.write("""
        $tokens = $this->tokenizer->encode('{}');
""".format(line.replace("'", "\\'")))
        tokens = tokenize(line)
        t.write("""
        $this->assertEquals({}, count($tokens));
        $this->assertEquals([{}], $tokens);
""".format(len(tokens),",".join(map(str,tokens))))
    t.write("""
    }

    public function test_long_text_lines() : void
    {
""")
    lines = long_text.split("\n")
    for line in lines:
        if not line:
            continue
        t.write("""
        $tokens = $this->tokenizer->encode('{}');
""".format(line.replace("'", "\\'")))
        tokens = tokenize(line)
        t.write("""
        $this->assertEquals({}, count($tokens));
        $this->assertEquals([{}], $tokens);
""".format(len(tokens),",".join(map(str,tokens))))
    t.write("""
    }
    
    
}
""")
    
    
    
    
