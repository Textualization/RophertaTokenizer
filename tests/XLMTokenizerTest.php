<?php
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

        $this->assertEquals(136, count($tokens));

    }

    public function test_multingual_lines() : void
    {

        $tokens = $this->tokenizer->encode('query: how much protein should a female eat');

        $this->assertEquals([0,41,1294,12,3642,5045,21308,5608,10,117776,73203,2], $tokens);
        $this->assertEquals(12, count($tokens));

        $tokens = $this->tokenizer->encode('query: 南瓜的家常做法');

        $this->assertEquals([0,41,1294,12,6,4617,39613,43,1433,6856,115371,2], $tokens);
        $this->assertEquals(12, count($tokens));

        $tokens = $this->tokenizer->encode('passage: As a general guideline, the CDC\'s average requirement of protein for women ages 19 to 70 is 46 grams per day. But, as you can see from this chart, you\'ll need to increase that if you\'re expecting or training for a marathon. Check out the chart below to see how much protein you should be eating each day.');

        $this->assertEquals([0,46692,12,1301,10,4537,17997,2256,4,70,7915,441,25,7,83080,64209,674,111,21308,100,24793,10,4188,953,47,2358,83,7621,16190,7,117,5155,5,4966,4,237,398,831,1957,1295,903,116287,4,398,25,1181,3871,47,51312,450,2174,398,25,107,41206,214,707,23189,100,10,179365,5,38679,1810,70,116287,35064,47,1957,3642,5045,21308,398,5608,186,118992,12638,5155,5,2], $tokens);
        $this->assertEquals(80, count($tokens));

        $tokens = $this->tokenizer->encode('passage: 1.清炒南瓜丝 原料:嫩南瓜半个 调料:葱、盐、白糖、鸡精 做法: 1、南瓜用刀薄薄的削去表面一层皮,用勺子刮去瓤 2、擦成细丝(没有擦菜板就用刀慢慢切成细丝) 3、锅烧热放油,入葱花煸出香味 4、入南瓜丝快速翻炒一分钟左右,放盐、一点白糖和鸡精调味出锅 2.香葱炒南瓜 原料:南瓜1只 调料:香葱、蒜末、橄榄油、盐 做法: 1、将南瓜去皮,切成片 2、油锅8成热后,将蒜末放入爆香 3、爆香后,将南瓜片放入,翻炒 4、在翻炒的同时,可以不时地往锅里加水,但不要太多 5、放入盐,炒匀 6、南瓜差不多软和绵了之后,就可以关火 7、撒入香葱,即可出锅');

        $this->assertEquals([0,46692,12,615,7318,54107,4617,39613,59580,6,105336,12,88232,4617,39613,6193,3294,6,17619,8794,12,243853,37,152890,37,3515,25407,37,60793,8539,6,115371,12,74559,4617,39613,1173,27322,27080,27080,43,101523,1677,51655,191224,10103,4,1173,244307,1344,146698,1677,3,82258,67903,2803,36332,59580,132,3029,67903,10569,10930,887,1173,27322,34159,7847,2803,36332,59580,16,101216,138300,82264,11802,5853,6858,4,2283,243853,2603,248002,1040,184005,201,37,2283,4617,39613,59580,16390,21233,54107,684,22801,15369,4,5853,152890,37,18318,3515,25407,264,60793,8539,17619,7835,1040,138300,787,8849,243853,54107,4617,39613,6,105336,12,4617,39613,418,5344,6,17619,8794,12,8849,243853,37,169622,27415,37,249924,244053,6858,37,152890,6,115371,12,74559,1726,4617,39613,1677,10103,4,7847,2803,5143,82258,6858,138300,1019,2803,11802,1826,4,1726,169622,27415,153207,20265,8849,101216,20265,8849,1826,4,1726,4617,39613,5143,153207,4,21233,54107,201,37,213,21233,54107,62736,4,1441,562,1898,955,7818,138300,2008,3490,1553,4,1273,7402,30583,190,37,153207,152890,4,54107,244285,305,37,4617,39613,86579,60772,264,202992,274,8856,4,20297,15900,5505,361,37,79007,2283,8849,243853,4,30060,1040,138300,2], $tokens);
        $this->assertEquals(231, count($tokens));

        $tokens = $this->tokenizer->encode('query: órden social y su relación con los derechos de las personas');

        $this->assertEquals([0,41,1294,12,6,6997,555,2265,113,166,20398,158,388,54347,8,576,6968,2], $tokens);
        $this->assertEquals(18, count($tokens));

        $tokens = $this->tokenizer->encode('passage: Je veux chercher si dans l’ordre civil il peut y avoir quelque regle d’administration légitime & sûre, en prenant les hommes tels qu’ils sont, & les loix telles qu’elles peuvent être : Je tâcherai d’allier toujours dans cette recherche ce que le droit permet avec ce que l’intérêt prescrit, afin que la justice & l’utilité ne se trouvent point divisées.');

        $this->assertEquals([0,46692,12,845,54226,135000,78,807,96,26,59548,9782,211,4372,113,12036,38944,6835,133,104,26,137858,121942,6032,619,33518,13,4,22,6,113207,199,74949,8131,7,1103,26,7870,2045,4,619,199,459,4084,101494,7,1103,26,16684,22270,4385,152,845,162268,8287,104,26,65844,56,11259,807,3393,22938,405,41,95,29582,10747,1609,405,41,96,26,61640,231061,4,17770,41,21,87338,619,96,26,87738,2312,108,40,24215,660,6275,45,1824,8493,5,2], $tokens);
        $this->assertEquals(95, count($tokens));

    }

    public function test_long_text_lines() : void
    {

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,2], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(86, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2], $tokens);
        $this->assertEquals(131, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me.');

        $this->assertEquals([0,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,2], $tokens);
        $this->assertEquals(93, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([0,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,2], $tokens);
        $this->assertEquals(113, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung?');

        $this->assertEquals([0,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,2], $tokens);
        $this->assertEquals(146, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([0,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,2], $tokens);
        $this->assertEquals(124, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([0,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,2], $tokens);
        $this->assertEquals(111, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(105, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,2], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(86, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding.');

        $this->assertEquals([0,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,2], $tokens);
        $this->assertEquals(129, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(110, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(136, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(149, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,2], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(147, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,2], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(147, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,2], $tokens);
        $this->assertEquals(165, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.');

        $this->assertEquals([0,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(160, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([0,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,2], $tokens);
        $this->assertEquals(111, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([0,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,2], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(190, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(148, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,2], $tokens);
        $this->assertEquals(183, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise?');

        $this->assertEquals([0,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,2], $tokens);
        $this->assertEquals(195, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(157, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(190, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(200, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder.');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,2], $tokens);
        $this->assertEquals(212, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(184, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,2], $tokens);
        $this->assertEquals(246, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,2], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(86, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2], $tokens);
        $this->assertEquals(131, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me.');

        $this->assertEquals([0,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,2], $tokens);
        $this->assertEquals(93, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([0,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,2], $tokens);
        $this->assertEquals(113, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung?');

        $this->assertEquals([0,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,2], $tokens);
        $this->assertEquals(146, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([0,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,2], $tokens);
        $this->assertEquals(124, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([0,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,2], $tokens);
        $this->assertEquals(111, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(105, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,2], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(86, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding.');

        $this->assertEquals([0,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,2], $tokens);
        $this->assertEquals(129, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(110, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(136, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(149, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,2], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(147, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,2], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(147, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,2], $tokens);
        $this->assertEquals(165, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.');

        $this->assertEquals([0,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(160, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([0,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,2], $tokens);
        $this->assertEquals(111, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([0,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,2], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(190, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(148, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,2], $tokens);
        $this->assertEquals(183, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise?');

        $this->assertEquals([0,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,2], $tokens);
        $this->assertEquals(195, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(157, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(190, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(200, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder.');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,2], $tokens);
        $this->assertEquals(212, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(184, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,2], $tokens);
        $this->assertEquals(246, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,2], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(86, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2], $tokens);
        $this->assertEquals(131, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me.');

        $this->assertEquals([0,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,2], $tokens);
        $this->assertEquals(93, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([0,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,2], $tokens);
        $this->assertEquals(113, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung?');

        $this->assertEquals([0,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,2], $tokens);
        $this->assertEquals(146, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([0,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,2], $tokens);
        $this->assertEquals(124, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([0,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,2], $tokens);
        $this->assertEquals(111, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(105, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,2], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(86, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding.');

        $this->assertEquals([0,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,2], $tokens);
        $this->assertEquals(129, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(110, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(136, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(149, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,2], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(147, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,2], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(147, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,2], $tokens);
        $this->assertEquals(165, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.');

        $this->assertEquals([0,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(160, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([0,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,2], $tokens);
        $this->assertEquals(111, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([0,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,2], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(190, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(148, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,2], $tokens);
        $this->assertEquals(183, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise?');

        $this->assertEquals([0,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,2], $tokens);
        $this->assertEquals(195, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(157, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(190, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(200, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder.');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,2], $tokens);
        $this->assertEquals(212, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(184, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,2], $tokens);
        $this->assertEquals(246, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,2], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(86, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2], $tokens);
        $this->assertEquals(131, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me.');

        $this->assertEquals([0,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,2], $tokens);
        $this->assertEquals(93, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([0,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,2], $tokens);
        $this->assertEquals(113, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung?');

        $this->assertEquals([0,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,2], $tokens);
        $this->assertEquals(146, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([0,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,2], $tokens);
        $this->assertEquals(124, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([0,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,2], $tokens);
        $this->assertEquals(111, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(105, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,2], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(86, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding.');

        $this->assertEquals([0,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,2], $tokens);
        $this->assertEquals(129, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(110, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(136, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(149, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,2], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(147, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,2], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(147, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,2], $tokens);
        $this->assertEquals(165, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.');

        $this->assertEquals([0,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(160, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([0,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,2], $tokens);
        $this->assertEquals(111, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([0,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,2], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(190, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(148, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,2], $tokens);
        $this->assertEquals(183, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise?');

        $this->assertEquals([0,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,2], $tokens);
        $this->assertEquals(195, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(157, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(190, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(200, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder.');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,2], $tokens);
        $this->assertEquals(212, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(184, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,2], $tokens);
        $this->assertEquals(246, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,2], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(86, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2], $tokens);
        $this->assertEquals(131, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me.');

        $this->assertEquals([0,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,2], $tokens);
        $this->assertEquals(93, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([0,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,2], $tokens);
        $this->assertEquals(113, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung?');

        $this->assertEquals([0,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,2], $tokens);
        $this->assertEquals(146, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([0,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,2], $tokens);
        $this->assertEquals(124, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([0,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,2], $tokens);
        $this->assertEquals(111, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(105, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,2], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(86, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding.');

        $this->assertEquals([0,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,2], $tokens);
        $this->assertEquals(129, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(110, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(136, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(149, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,2], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(147, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,2], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(147, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,2], $tokens);
        $this->assertEquals(165, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.');

        $this->assertEquals([0,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(160, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([0,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,2], $tokens);
        $this->assertEquals(111, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([0,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,2], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(190, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(148, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,2], $tokens);
        $this->assertEquals(183, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise?');

        $this->assertEquals([0,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,2], $tokens);
        $this->assertEquals(195, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(157, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(190, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(200, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder.');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,2], $tokens);
        $this->assertEquals(212, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(184, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,2], $tokens);
        $this->assertEquals(246, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,2], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(86, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2], $tokens);
        $this->assertEquals(131, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me.');

        $this->assertEquals([0,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,2], $tokens);
        $this->assertEquals(93, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([0,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,2], $tokens);
        $this->assertEquals(113, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung?');

        $this->assertEquals([0,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,2], $tokens);
        $this->assertEquals(146, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([0,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,2], $tokens);
        $this->assertEquals(124, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([0,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,2], $tokens);
        $this->assertEquals(111, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(105, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,2], $tokens);
        $this->assertEquals(119, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(86, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding.');

        $this->assertEquals([0,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,2], $tokens);
        $this->assertEquals(129, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(110, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that.');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(136, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel.');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,2], $tokens);
        $this->assertEquals(139, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five.');

        $this->assertEquals([0,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,2], $tokens);
        $this->assertEquals(135, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(145, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case?');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,2], $tokens);
        $this->assertEquals(103, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.');

        $this->assertEquals([0,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,2], $tokens);
        $this->assertEquals(122, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,2], $tokens);
        $this->assertEquals(127, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(107, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,2], $tokens);
        $this->assertEquals(140, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(149, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,2], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(147, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,2], $tokens);
        $this->assertEquals(141, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.');

        $this->assertEquals([0,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,2], $tokens);
        $this->assertEquals(133, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(147, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(109, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now?');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,2], $tokens);
        $this->assertEquals(115, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(130, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,2], $tokens);
        $this->assertEquals(132, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.');

        $this->assertEquals([0,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,2], $tokens);
        $this->assertEquals(165, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.');

        $this->assertEquals([0,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,2], $tokens);
        $this->assertEquals(128, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out.');

        $this->assertEquals([0,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,2], $tokens);
        $this->assertEquals(160, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(77, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(137, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought.');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,2], $tokens);
        $this->assertEquals(155, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively.');

        $this->assertEquals([0,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick? But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill.');

        $this->assertEquals([0,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,2], $tokens);
        $this->assertEquals(111, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([0,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,2], $tokens);
        $this->assertEquals(134, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(190, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,2], $tokens);
        $this->assertEquals(148, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell!');

        $this->assertEquals([0,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('" He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder. He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury.');

        $this->assertEquals([0,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,2], $tokens);
        $this->assertEquals(152, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk! And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing.');

        $this->assertEquals([0,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,2], $tokens);
        $this->assertEquals(183, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise?');

        $this->assertEquals([0,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,2], $tokens);
        $this->assertEquals(195, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('True, he had not slept peacefully, but probably all the more deeply because of that. What should he do now? The next train went at seven; if he were to catch that he would have to rush like mad and the collection of samples was still not packed, and he did not at all feel particularly fresh and lively. And even if he did catch the train he would not avoid his boss\'s anger as the office assistant would have been there to see the five o\'clock train go, he would have put in his report about Gregor\'s not being there a long time ago. The office assistant was the boss\'s man, spineless, and with no understanding. What about if he reported sick?');

        $this->assertEquals([0,87599,4,764,1902,959,67208,18,88669,126351,4,1284,31895,756,70,1286,53894,538,6637,111,450,5,4865,5608,764,54,5036,32,581,11737,25550,23409,99,59671,74,2174,764,3542,47,105556,450,764,2806,765,47,6,86532,1884,17946,136,70,42486,111,121413,7,509,7464,959,43824,297,4,136,764,6777,959,99,756,12319,106480,63335,136,6867,538,5,3493,3853,2174,764,6777,105556,70,25550,764,2806,959,71864,1919,55983,25,7,348,56,237,70,23179,195644,2806,765,2809,2685,47,1957,70,43606,36,25,238,21135,25550,738,4,764,2806,765,3884,23,1919,13416,1672,139256,25,7,959,8035,2685,10,4989,1733,6650,5,581,23179,195644,509,70,55983,25,7,332,4,25927,13,9393,4,136,678,110,100094,5,4865,1672,2174,764,113771,133054,32,2], $tokens);
        $this->assertEquals(157, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('But that would be extremely strained and suspicious as in fifteen years of service Gregor had never once yet been ill. His boss would certainly come round with the doctor from the medical insurance company, accuse his parents of having a lazy son, and accept the doctor\'s recommendation not to make any claim as the doctor believed that no-one was ever ill but that many were workshy. And what\'s more, would he have been entirely wrong in this case? Gregor did in fact, apart from excessive sleepiness after sleeping for so long, feel completely well and even felt much hungrier than usual. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.');

        $this->assertEquals([0,4966,450,2806,186,111531,177488,297,136,166,181960,223,237,23,809,18266,33,5369,111,4516,139256,1902,8306,24145,14373,2809,99825,5,18763,55983,2806,68782,1380,68807,678,70,22072,1295,70,29874,42169,14380,4,61689,184,1919,27863,111,19441,10,21,3285,775,4,136,26946,70,22072,25,7,67330,2320,959,47,3249,2499,63043,237,70,22072,18822,71,450,110,9,3630,509,17669,99825,1284,450,5941,3542,43240,3038,5,3493,2367,25,7,1286,4,2806,764,765,2809,167969,44691,23,903,7225,32,139256,6777,23,15824,4,34955,1295,218527,60268,12741,7,7103,198465,100,221,4989,4,12319,64557,5299,136,3853,29131,5045,80756,25388,3501,115723,5,6561,42141,4,3229,139256,3362,433,4323,350,1295,63134,71,48869,7,4,764,14037,66570,27198,297,23,1919,11958,3934,10,189026,493,1249,5,2], $tokens);
        $this->assertEquals(161, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What\'s happened to me? " he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.');

        $this->assertEquals([0,1529,21,53,98,1919,16294,34639,9,5062,4420,4,136,2174,764,60520,297,1919,10336,10,10176,764,5809,1957,1919,119455,186,12097,4,161549,54,4806,136,101637,71,390,187,17007,3934,13629,4902,40059,7,5,581,186,59725,509,7941,538,19048,47,29256,442,136,115058,43542,47,122753,5773,2499,3095,5,18763,5941,6049,7,4,53974,126351,6117,19,154186,678,70,13267,111,70,10588,111,4049,4,259,4126,1672,4358,9393,538,237,764,54811,5,44,52231,25,7,73659,47,163,32,44,764,17569,5,1650,58954,25,18,10,48869,5,18763,17155,4,10,27798,14135,17155,102971,10,10176,5792,19336,4,21,53,88669,126351,17721,6863,22759,16031,58982,7,5,62,42486,111,67773,13,121413,7,21,53,93403,1810,98,70,23180,20,3362,433,509,10,26983,2069,40575,669,20,136,36917,442,2685,80756,10,49726,450,764,1902,78684,59226,1810,111,142,58755,3674,41260,136,18276,71,23,10,26267,4,6,8726,48141,123789,5,2], $tokens);
        $this->assertEquals(190, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn\'t get into that position. However hard he threw himself onto his right, he always rolled back to where he was. He must have tried it a hundred times, shut his eyes so that he wouldn\'t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before.');

        $this->assertEquals([0,1650,168360,10,108596,112031,71,1810,678,10,16387,1256,136,16387,19328,2750,11736,1257,54969,4,40129,214,10,99162,16387,842,4902,450,127918,70,28271,111,604,92319,16294,98186,70,21455,56,5,139256,7068,69347,47,6713,1810,70,76896,99,70,115,1181,92949,5,130403,7,111,102044,5809,186,49782,5962,1916,70,28238,4,3129,7228,4049,12319,32233,17110,5,44,81826,1672,2174,87,60268,10,10176,4785,51713,136,90820,756,903,351,100033,830,764,17569,4,1284,450,509,9844,764,509,51,2886,47,54,6637,764,509,11814,47,198465,98,1919,7108,4,136,23,1919,13379,11341,69427,25,18,2046,3934,450,19069,5,33306,7941,764,159399,434,66570,98,188,1919,7108,4,764,11343,67411,71,4420,47,7440,764,509,5,1529,8110,765,37842,442,10,75281,20028,4,8633,18,1919,46223,221,450,764,68746,25,18,765,47,6713,99,70,21917,24658,214,6049,7,4,136,4734,118066,3229,764,80723,47,12319,10,126561,4,115,1181,24503,2685,450,764,1902,8306,29131,8108,5,2], $tokens);
        $this->assertEquals(200, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('"Oh, God", he thought, "what a strenuous career it is that I\'ve chosen! Travelling day in and day out. Doing business like this takes much more effort than doing your own business at home, and on top of that there\'s the curse of travelling, worries about making train connections, bad and irregular food, contact with different people all the time so that you can never get to know anyone or become friendly with them. It can all go to Hell! " He felt a slight itch up on his belly; pushed himself slowly up on his back towards the headboard so that he could lift his head better; found where the itch was, and saw that it was covered with lots of little white spots which he didn\'t know what to make of; and when he tried to feel the place with one of his legs he drew it quickly back because as soon as he touched it he was overcome by a cold shudder.');

        $this->assertEquals([0,44,56886,4,3430,830,764,17569,4,44,124409,10,8082,539,10821,80997,442,83,450,87,25,272,19667,19,38,30720,2069,5155,23,136,5155,1810,5,984,214,8063,1884,903,51776,5045,1286,71834,3501,20594,935,10002,8063,99,5368,4,136,98,2663,111,450,2685,25,7,70,22074,13,111,26983,2069,4,6,23432,10484,1672,20662,25550,94878,7,4,6494,136,105843,15381,4,5470,678,12921,3395,756,70,1733,221,450,398,831,8306,2046,47,3714,35672,707,24209,101786,678,2856,5,1650,831,756,738,47,43153,38,44,1529,29131,10,91,20016,442,206,1257,98,1919,186,12097,74,25944,297,66570,191975,1257,98,1919,4420,98186,70,10336,24351,221,450,764,5809,60520,1919,10336,11522,74,14037,7440,70,442,206,509,4,136,24124,450,442,509,127918,678,71358,111,10176,35011,13162,7,3129,764,15935,25,18,3714,2367,47,3249,111,74,136,3229,764,37842,47,12319,70,3687,678,1632,111,1919,6049,7,764,169361,442,69405,4420,6637,237,33662,237,764,23996,297,442,764,509,645,45738,390,10,91097,8633,70764,5,2], $tokens);
        $this->assertEquals(212, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('He slid back into his former position. "Getting up early all the time", he thought, "it makes you stupid. You\'ve got to get enough sleep. Other travelling salesmen live a life of luxury. For instance, whenever I go back to the guest house during the morning to copy out the contract, these gentlemen are always still sitting there eating their breakfasts. I ought to just try that with my boss; I\'d get kicked out on the spot. But who knows, maybe that would be the best thing for me. If I didn\'t have my parents to think about I\'d have given in my notice a long time ago, I\'d have gone up to the boss and told him just what I think, tell him everything I would, let him know just what I feel. He\'d fall right off his desk!');

        $this->assertEquals([0,1529,132692,4420,3934,1919,36770,19069,5,44,10429,19514,1257,39395,756,70,1733,830,764,17569,4,44,217,30482,398,110833,5,2583,25,272,4163,47,2046,20174,60268,5,64511,26983,2069,40575,1055,6867,10,6897,111,44752,44616,5,1326,110527,4,217684,87,738,4420,47,70,121399,18276,20271,70,42141,47,43658,1810,70,18264,4,6097,21507,133,1055,621,11343,7464,129842,2685,118992,2363,118285,7,5,87,36,46526,47,1660,9790,450,678,759,55983,74,87,25,71,2046,200,76622,1810,98,70,13162,5,4966,2750,93002,4,51139,450,2806,186,70,2965,13580,100,163,5,4263,87,15935,25,18,765,759,27863,47,5351,1672,87,25,71,765,34475,23,759,60322,10,4989,1733,6650,4,87,25,71,765,74955,1257,47,70,55983,136,30745,4049,1660,2367,87,5351,4,14192,4049,26818,87,2806,4,2633,4049,3714,1660,2367,87,12319,5,1529,25,71,6817,7108,5773,1919,8,1042,38,2], $tokens);
        $this->assertEquals(184, count($tokens));

        $tokens = $this->tokenizer->encode('');

        $this->assertEquals([0,2], $tokens);
        $this->assertEquals(2, count($tokens));

        $tokens = $this->tokenizer->encode('And it\'s a funny sort of business to be sitting up there at your desk, talking down at your subordinates from up there, especially when you have to go right up close because the boss is hard of hearing. Well, there\'s still some hope; once I\'ve got the money together to pay off my parents\' debt to him - another five or six years I suppose - that\'s definitely what I\'ll do. That\'s when I\'ll make the big change. First of all though, I\'ve got to get up, my train leaves at five. " And he looked over at the alarm clock, ticking on the chest of drawers. "God in Heaven! " he thought. It was half past six and the hands were quietly moving forwards, it was even later than half past, more like quarter to seven. Had the alarm clock not rung? He could see from the bed that it had been set for four o\'clock as it should have been; it certainly must have rung. Yes, but was it possible to quietly sleep through that furniture-rattling noise? True, he had not');

        $this->assertEquals([0,3493,442,25,7,10,99864,12096,111,8063,47,186,129842,1257,2685,99,935,8,1042,4,56661,7565,99,935,163888,63614,1295,1257,2685,4,41866,3229,398,765,47,738,7108,1257,20903,6637,70,55983,83,7941,111,129271,5,22576,4,2685,25,7,7464,3060,15673,74,24145,87,25,272,4163,70,17265,25842,47,8783,5773,759,27863,25,130815,47,4049,20,15700,43606,707,37195,5369,87,139124,20,450,25,7,58621,2367,87,25,1181,54,5,9925,25,7,3229,87,25,1181,3249,70,6957,15549,5,23972,111,756,21208,4,87,25,272,4163,47,2046,1257,4,759,25550,31358,7,99,43606,5,44,3493,764,54811,645,99,70,28949,501,21135,4,1053,41324,98,70,290,271,111,79442,1314,5,44,124938,23,179030,38,44,764,17569,5,1650,509,23552,11015,37195,136,70,44540,3542,92136,538,98567,40225,7,4,442,509,3853,14432,3501,23552,11015,4,1286,1884,128274,47,59671,5,28129,70,28949,501,21135,959,120649,32,1529,5809,1957,1295,70,11958,450,442,1902,2809,5423,100,22759,36,25,238,21135,237,442,5608,765,2809,74,442,68782,8110,765,120649,5,32635,4,1284,509,442,7722,47,92136,538,60268,8305,450,181750,9,2175,18,2069,110,3075,32,87599,4,764,1902,959,2], $tokens);
        $this->assertEquals(246, count($tokens));

    }
    
    
}
