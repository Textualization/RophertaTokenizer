<?php
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

        $this->assertEquals(72466, count($tokens));

    }

    public function test_long_text_lines() : void
    {

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4], $tokens);
        $this->assertEquals(102, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([25302,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(99, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4], $tokens);
        $this->assertEquals(117, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me.');

        $this->assertEquals([1185,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4], $tokens);
        $this->assertEquals(84, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([1106,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung?');

        $this->assertEquals([8346,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116], $tokens);
        $this->assertEquals(131, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([894,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4], $tokens);
        $this->assertEquals(113, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([2409,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4], $tokens);
        $this->assertEquals(100, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([9962,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4], $tokens);
        $this->assertEquals(102, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([25302,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(99, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding.');

        $this->assertEquals([2264,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4], $tokens);
        $this->assertEquals(118, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([2264,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(98, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([2264,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(91, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(91, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(136, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([46755,3275,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([46755,3275,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4], $tokens);
        $this->assertEquals(143, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.');

        $this->assertEquals([250,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4], $tokens);
        $this->assertEquals(112, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([113,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4], $tokens);
        $this->assertEquals(148, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([2409,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4], $tokens);
        $this->assertEquals(100, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([9962,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4], $tokens);
        $this->assertEquals(123, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([894,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(163, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4], $tokens);
        $this->assertEquals(169, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise?');

        $this->assertEquals([8346,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116], $tokens);
        $this->assertEquals(178, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([36948,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(143, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4], $tokens);
        $this->assertEquals(146, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([894,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(163, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(182, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder.');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328,22,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4], $tokens);
        $this->assertEquals(189, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([894,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(169, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45], $tokens);
        $this->assertEquals(226, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4], $tokens);
        $this->assertEquals(102, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([25302,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(99, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4], $tokens);
        $this->assertEquals(117, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me.');

        $this->assertEquals([1185,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4], $tokens);
        $this->assertEquals(84, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([1106,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung?');

        $this->assertEquals([8346,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116], $tokens);
        $this->assertEquals(131, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([894,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4], $tokens);
        $this->assertEquals(113, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([2409,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4], $tokens);
        $this->assertEquals(100, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([9962,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4], $tokens);
        $this->assertEquals(102, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([25302,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(99, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding.');

        $this->assertEquals([2264,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4], $tokens);
        $this->assertEquals(118, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([2264,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(98, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([2264,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(91, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(91, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(136, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([46755,3275,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([46755,3275,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4], $tokens);
        $this->assertEquals(143, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.');

        $this->assertEquals([250,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4], $tokens);
        $this->assertEquals(112, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([113,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4], $tokens);
        $this->assertEquals(148, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([2409,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4], $tokens);
        $this->assertEquals(100, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([9962,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4], $tokens);
        $this->assertEquals(123, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([894,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(163, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4], $tokens);
        $this->assertEquals(169, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise?');

        $this->assertEquals([8346,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116], $tokens);
        $this->assertEquals(178, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([36948,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(143, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4], $tokens);
        $this->assertEquals(146, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([894,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(163, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(182, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder.');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328,22,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4], $tokens);
        $this->assertEquals(189, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([894,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(169, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45], $tokens);
        $this->assertEquals(226, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4], $tokens);
        $this->assertEquals(102, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([25302,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(99, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4], $tokens);
        $this->assertEquals(117, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me.');

        $this->assertEquals([1185,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4], $tokens);
        $this->assertEquals(84, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([1106,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung?');

        $this->assertEquals([8346,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116], $tokens);
        $this->assertEquals(131, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([894,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4], $tokens);
        $this->assertEquals(113, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([2409,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4], $tokens);
        $this->assertEquals(100, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([9962,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4], $tokens);
        $this->assertEquals(102, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([25302,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(99, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding.');

        $this->assertEquals([2264,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4], $tokens);
        $this->assertEquals(118, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([2264,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(98, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([2264,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(91, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(91, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(136, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([46755,3275,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([46755,3275,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4], $tokens);
        $this->assertEquals(143, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.');

        $this->assertEquals([250,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4], $tokens);
        $this->assertEquals(112, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([113,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4], $tokens);
        $this->assertEquals(148, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([2409,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4], $tokens);
        $this->assertEquals(100, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([9962,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4], $tokens);
        $this->assertEquals(123, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([894,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(163, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4], $tokens);
        $this->assertEquals(169, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise?');

        $this->assertEquals([8346,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116], $tokens);
        $this->assertEquals(178, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([36948,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(143, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4], $tokens);
        $this->assertEquals(146, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([894,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(163, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(182, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder.');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328,22,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4], $tokens);
        $this->assertEquals(189, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([894,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(169, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45], $tokens);
        $this->assertEquals(226, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4], $tokens);
        $this->assertEquals(102, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([25302,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(99, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4], $tokens);
        $this->assertEquals(117, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me.');

        $this->assertEquals([1185,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4], $tokens);
        $this->assertEquals(84, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([1106,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung?');

        $this->assertEquals([8346,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116], $tokens);
        $this->assertEquals(131, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([894,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4], $tokens);
        $this->assertEquals(113, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([2409,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4], $tokens);
        $this->assertEquals(100, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([9962,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4], $tokens);
        $this->assertEquals(102, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([25302,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(99, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding.');

        $this->assertEquals([2264,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4], $tokens);
        $this->assertEquals(118, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([2264,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(98, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([2264,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(91, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(91, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(136, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([46755,3275,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([46755,3275,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4], $tokens);
        $this->assertEquals(143, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.');

        $this->assertEquals([250,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4], $tokens);
        $this->assertEquals(112, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([113,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4], $tokens);
        $this->assertEquals(148, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([2409,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4], $tokens);
        $this->assertEquals(100, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([9962,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4], $tokens);
        $this->assertEquals(123, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([894,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(163, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4], $tokens);
        $this->assertEquals(169, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise?');

        $this->assertEquals([8346,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116], $tokens);
        $this->assertEquals(178, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([36948,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(143, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4], $tokens);
        $this->assertEquals(146, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([894,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(163, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(182, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder.');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328,22,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4], $tokens);
        $this->assertEquals(189, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([894,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(169, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45], $tokens);
        $this->assertEquals(226, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4], $tokens);
        $this->assertEquals(102, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([25302,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(99, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4], $tokens);
        $this->assertEquals(117, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me.');

        $this->assertEquals([1185,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4], $tokens);
        $this->assertEquals(84, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([1106,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung?');

        $this->assertEquals([8346,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116], $tokens);
        $this->assertEquals(131, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([894,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4], $tokens);
        $this->assertEquals(113, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([2409,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4], $tokens);
        $this->assertEquals(100, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([9962,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4], $tokens);
        $this->assertEquals(102, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([25302,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(99, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding.');

        $this->assertEquals([2264,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4], $tokens);
        $this->assertEquals(118, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([2264,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(98, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([2264,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(91, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(91, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(136, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([46755,3275,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([46755,3275,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4], $tokens);
        $this->assertEquals(143, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.');

        $this->assertEquals([250,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4], $tokens);
        $this->assertEquals(112, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([113,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4], $tokens);
        $this->assertEquals(148, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([2409,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4], $tokens);
        $this->assertEquals(100, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([9962,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4], $tokens);
        $this->assertEquals(123, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([894,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(163, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4], $tokens);
        $this->assertEquals(169, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise?');

        $this->assertEquals([8346,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116], $tokens);
        $this->assertEquals(178, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([36948,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(143, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4], $tokens);
        $this->assertEquals(146, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([894,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(163, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(182, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder.');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328,22,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4], $tokens);
        $this->assertEquals(189, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([894,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(169, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45], $tokens);
        $this->assertEquals(226, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4], $tokens);
        $this->assertEquals(102, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([25302,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(99, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4], $tokens);
        $this->assertEquals(117, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me.');

        $this->assertEquals([1185,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4], $tokens);
        $this->assertEquals(84, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([1106,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung?');

        $this->assertEquals([8346,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116], $tokens);
        $this->assertEquals(131, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([894,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4], $tokens);
        $this->assertEquals(113, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([2409,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4], $tokens);
        $this->assertEquals(100, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([9962,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4], $tokens);
        $this->assertEquals(102, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([25302,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(99, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding.');

        $this->assertEquals([2264,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4], $tokens);
        $this->assertEquals(118, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([2264,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(98, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([2264,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(91, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([894,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([113,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116], $tokens);
        $this->assertEquals(91, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([25302,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([9962,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([10462,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(95, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4], $tokens);
        $this->assertEquals(125, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([24989,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(136, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([46755,3275,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([9962,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4], $tokens);
        $this->assertEquals(116, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([46755,3275,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(97, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116], $tokens);
        $this->assertEquals(106, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([133,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4], $tokens);
        $this->assertEquals(120, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.');

        $this->assertEquals([3762,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4,91,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4], $tokens);
        $this->assertEquals(143, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.');

        $this->assertEquals([250,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4,85,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4], $tokens);
        $this->assertEquals(112, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([113,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([8275,154,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(69, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(126, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([243,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4], $tokens);
        $this->assertEquals(148, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([2409,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116,125,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4], $tokens);
        $this->assertEquals(100, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([9962,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4], $tokens);
        $this->assertEquals(123, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([894,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(163, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([894,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4,22,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([113,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4,91,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([2709,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328,178,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4], $tokens);
        $this->assertEquals(169, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise?');

        $this->assertEquals([8346,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116], $tokens);
        $this->assertEquals(178, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([36948,6,37,56,45,17931,17061,6,53,1153,70,5,55,4814,142,9,14,4,653,197,37,109,122,116,20,220,2341,439,23,707,131,114,37,58,7,2916,14,37,74,33,7,6187,101,7758,8,5,2783,9,7931,21,202,45,6515,6,8,37,222,45,23,70,619,1605,2310,8,20902,4,178,190,114,37,222,2916,5,2341,37,74,45,1877,39,3504,18,6378,25,5,558,3167,74,33,57,89,7,192,5,292,1021,108,17036,2341,213,6,37,74,33,342,11,39,266,59,4275,368,18,45,145,89,10,251,86,536,4,20,558,3167,21,5,3504,18,313,6,6287,13802,6,8,19,117,2969,4,653,59,114,37,431,4736,116], $tokens);
        $this->assertEquals(143, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([1708,14,74,28,2778,15718,8,7775,25,11,23843,107,9,544,4275,368,56,393,683,648,57,4812,4,832,3504,74,1819,283,1062,19,5,3299,31,5,1131,1911,138,6,15311,39,1041,9,519,10,22414,979,6,8,3264,5,3299,18,6492,45,7,146,143,2026,25,5,3299,2047,14,117,12,1264,21,655,4812,53,14,171,58,1364,11108,4,178,99,18,55,6,74,37,33,57,4378,1593,11,42,403,116,4275,368,222,11,754,6,4102,31,10079,3581,6601,71,8416,13,98,251,6,619,2198,157,8,190,1299,203,10601,8590,87,4505,4,509,662,6,77,4275,368,1960,11146,13356,31,9895,7416,6,37,303,1003,11229,11,39,3267,88,10,11385,4342,4691,4], $tokens);
        $this->assertEquals(146, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([894,4477,15,39,37497,12,3341,124,6,8,114,37,4639,39,471,10,410,37,115,192,39,6219,18951,6,2829,13567,196,8,6408,30,4709,5559,88,13116,9042,4,20,3267,11303,21,7533,441,7,1719,24,8,2551,1227,7,7117,160,143,1151,4,832,171,5856,6,8516,34717,7174,1118,19,5,1836,9,5,1079,9,123,6,21017,59,22445,352,25,37,1415,4,22,2264,18,1102,7,162,116,22,37,802,4,85,938,75,10,3366,4,832,929,6,10,4692,1050,929,1712,10,410,350,650,6,4477,17061,227,63,237,2950,6347,4,83,2783,9,21664,7931,4477,2504,66,15,5,2103,111,1960,11146,21,10,7290,32656,111,8,1065,24,89,10601,10,2170,14,37,56,682,847,66,9,41,22827,4320,8,15740,11,10,2579,6,821,39288,5120,4], $tokens);
        $this->assertEquals(163, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([243,969,10,6429,15898,66,19,10,15503,3988,8,15503,5276,102,54,4005,25922,6,3282,10,2016,15503,30977,14,2913,5,1086,9,69,795,3124,1567,5,18754,4,4275,368,172,1224,7,356,66,5,2931,23,5,22018,1650,4,43534,9,1895,115,28,1317,3022,5,41578,6,61,156,123,619,1341,5074,4,22,6179,59,114,38,3581,10,410,828,1181,8,4309,70,42,20175,1297,37,802,6,53,14,21,402,37,21,3276,7,109,142,37,21,341,7,8416,15,39,235,6,8,11,39,1455,194,1705,75,120,88,14,737,4,635,543,37,4021,1003,2500,39,235,6,37,460,6387,124,7,147,37,21,4,91,531,33,1381,24,10,6317,498,6,2572,39,2473,98,14,37,1979,75,33,7,356,23,5,2342,9834,2961,5856,6,8,129,2294,77,37,880,7,619,10,10439,6,22018,2400,89,14,37,56,393,1299,137,4], $tokens);
        $this->assertEquals(182, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder.');

        $this->assertEquals([113,7516,6,1840,1297,37,802,6,22,12196,10,34812,12685,756,24,16,14,38,348,4986,328,33659,7633,183,11,8,183,66,4,22008,265,101,42,1239,203,55,1351,87,608,110,308,265,23,184,6,8,15,299,9,14,89,18,5,26020,9,7290,6,7697,59,442,2341,7070,6,1099,8,22937,689,6,1511,19,430,82,70,5,86,98,14,47,64,393,120,7,216,1268,50,555,5192,19,106,4,85,64,70,213,7,11141,328,22,91,1299,10,7019,40452,62,15,39,18951,131,3148,1003,5764,62,15,39,124,1567,5,471,4929,98,14,37,115,5258,39,471,357,131,303,147,5,40452,21,6,8,794,14,24,21,2913,19,3739,9,410,1104,5284,61,37,399,75,216,99,7,146,9,131,8,77,37,1381,7,619,5,317,19,65,9,39,5856,37,4855,24,1335,124,142,25,1010,25,37,6699,24,37,21,6647,30,10,2569,44004,4], $tokens);
        $this->assertEquals(189, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([894,13763,124,88,39,320,737,4,22,28750,62,419,70,5,86,1297,37,802,6,22,405,817,47,12103,4,370,348,300,7,120,615,3581,4,1944,7290,647,2262,697,10,301,9,4808,4,286,4327,6,8378,38,213,124,7,5,4910,790,148,5,662,7,5375,66,5,1355,6,209,22629,32,460,202,2828,89,4441,49,1108,506,13651,4,38,12960,7,95,860,14,19,127,3504,131,38,1017,120,5836,66,15,5,1514,4,125,54,2215,6,2085,14,74,28,5,275,631,13,162,4,318,38,399,75,33,127,1041,7,206,59,38,1017,33,576,11,127,3120,10,251,86,536,6,38,1017,33,1613,62,7,5,3504,8,174,123,95,99,38,206,6,1137,123,960,38,74,6,905,123,216,95,99,38,619,4,91,1017,1136,235,160,39,8429,328], $tokens);
        $this->assertEquals(169, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([], $tokens);
        $this->assertEquals(0, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not');

        $this->assertEquals([2409,24,18,10,6269,2345,9,265,7,28,2828,62,89,23,110,8429,6,1686,159,23,110,40806,31,62,89,6,941,77,47,33,7,213,235,62,593,142,5,3504,16,543,9,1576,4,2647,6,89,18,202,103,1034,131,683,38,348,300,5,418,561,7,582,160,127,1041,108,1126,7,123,111,277,292,50,411,107,38,19792,111,14,18,2299,99,38,581,109,4,280,18,77,38,581,146,5,380,464,4,1234,9,70,600,6,38,348,300,7,120,62,6,127,2341,3607,23,292,4,22,178,37,1415,81,23,5,8054,6700,6,25535,15,5,7050,9,2451,268,4,22,15724,11,19919,328,22,37,802,4,85,21,457,375,411,8,5,1420,58,11034,1375,14346,6,24,21,190,423,87,457,375,6,55,101,297,7,707,4,7301,5,8054,6700,45,422,571,116,91,115,192,31,5,3267,14,24,56,57,278,13,237,1021,108,17036,25,24,197,33,57,131,24,1819,531,33,422,571,4,3216,6,53,21,24,678,7,11034,3581,149,14,8671,12,338,2611,1527,6496,116,7447,6,37,56,45], $tokens);
        $this->assertEquals(226, count($tokens));

    }
    
    
}
