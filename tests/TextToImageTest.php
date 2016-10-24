<?php

class TextToImageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var FacebookAnonymousPublisher\TextToImage\TextToImage
     */
    protected $textToImage;

    public function setUp()
    {
        parent::setUp();

        $this->textToImage = new FacebookAnonymousPublisher\TextToImage\TextToImage();
    }

    public function test_make_throw_exception_if_not_set_font_path()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->textToImage->make('exception');
    }

    public function test_make()
    {
        $text = '朋友買了一件衣料，綠色的底子帶白色方格，當她拿給我們看時，一位對圍棋十分感與趣的同學說：「啊，好像棋盤似的。」「我看倒有點像稿紙。」我說。「真像一塊塊綠豆糕。」一位外號叫「大食客」的同學緊接著說。我們不禁哄堂大笑，同樣的一件衣料，每個人卻有不同的感覺。那位朋友連忙把衣料用紙包好，她覺得衣料就是衣料，不是棋盤，也不是稿紙，更不是綠豆糕。人人的欣賞觀點不盡相同，那是和個人的性格與生活環境有關。如果經常逛布店的話，便會發現很少有一匹布沒有人選購過；換句話說，任何質地或花色的衣料，都有人欣賞它。一位鞋店的老闆曾指著櫥窗裡一雙式樣毫不漂亮的鞋子說：「無論怎麼難看的樣子，還是有人喜歡，所以不怕賣不出去。」就以「人」來說，又何嘗不是如此？也許我們看某人不順眼，但是在他的男友和女友心中，往往認為他如「天仙」或「白馬王子」般地完美無缺。人總會去尋求自己喜歡的事物，每個人的看法或觀點不同，並沒有什麼關係，重要的是──人與人之間，應該有彼此容忍和尊重對方的看法與觀點的雅量。如果他能從這扇門望見日出的美景，你又何必要他走向那扇窗去聆聽鳥鳴呢？你聽你的鳥鳴，他看他的日出，彼此都會有等量的美的感受。人與人偶有摩擦，往往都是由於缺乏那分雅量的緣故；因此，為了減少摩擦，增進和諧，我們必須努力培養雅量。';

        $this->textToImage->setFont(__DIR__.'/fonts/NotoSansCJKtc-Regular.otf');

        $this->assertInstanceOf(Intervention\Image\Image::class, $this->textToImage->make($text));
    }

    public function test_break_text()
    {
        $origin = <<<EOF
朋友買了一件衣料，綠色的底子帶白色方格，當她拿給我們看時，一位對圍棋十分感與趣的同學說：
「啊，好像棋盤似的。」
「我看倒有點像稿紙。」我說。
「真像一塊塊綠豆糕。」一位外號叫「大食客」的同學緊接著說。
我們不禁哄堂大笑，同樣的一件衣料，每個人卻有不同的感覺。那位朋友連忙把衣料用紙包好，她覺得衣料就是衣料，不是棋盤，也不是稿紙，更不是綠豆糕。
人人的欣賞觀點不盡相同，那是和個人的性格與生活環境有關。

如果經常逛布店的話，便會發現很少有一匹布沒有人選購過；換句話說，任何質地或花色的衣料，都有人欣賞它。一位鞋店的老闆曾指著櫥窗裡一雙式樣毫不漂亮的鞋子說：「無論怎麼難看的樣子，還是有人喜歡，所以不怕賣不出去。」
就以「人」來說，又何嘗不是如此？也許我們看某人不順眼，但是在他的男友和女友心中，往往認為他如「天仙」或「白馬王子」般地完美無缺。
人總會去尋求自己喜歡的事物，每個人的看法或觀點不同，並沒有什麼關係，重要的是──人與人之間，應該有彼此容忍和尊重對方的看法與觀點的雅量。

如果他能從這扇門望見日出的美景，你又何必要他走向那扇窗去聆聽鳥鳴呢？你聽你的鳥鳴，他看他的日出，彼此都會有等量的美的感受。人與人偶有摩擦，往往都是由於缺乏那分雅量的緣故；因此，為了減少摩擦，增進和諧，我們必須努力培養雅量。
EOF;

        $except = <<<EOF
朋友買了一件衣料，綠色的底子帶白色方格，當她拿給
我們看時，一位對圍棋十分感與趣的同學說：
「啊，好像棋盤似的。」
「我看倒有點像稿紙。」我說。
「真像一塊塊綠豆糕。」一位外號叫「大食客」的同學
緊接著說。
我們不禁哄堂大笑，同樣的一件衣料，每個人卻有不同
的感覺。那位朋友連忙把衣料用紙包好，她覺得衣料就
是衣料，不是棋盤，也不是稿紙，更不是綠豆糕。
人人的欣賞觀點不盡相同，那是和個人的性格與生活環
境有關。

如果經常逛布店的話，便會發現很少有一匹布沒有人選
購過；換句話說，任何質地或花色的衣料，都有人欣賞
它。一位鞋店的老闆曾指著櫥窗裡一雙式樣毫不漂亮的
鞋子說：「無論怎麼難看的樣子，還是有人喜歡，所以
不怕賣不出去。」
就以「人」來說，又何嘗不是如此？也許我們看某人不
順眼，但是在他的男友和女友心中，往往認為他如「天
仙」或「白馬王子」般地完美無缺。
人總會去尋求自己喜歡的事物，每個人的看法或觀點不
同，並沒有什麼關係，重要的是──人與人之間，應該有
彼此容忍和尊重對方的看法與觀點的雅量。

如果他能從這扇門望見日出的美景，你又何必要他走向
那扇窗去聆聽鳥鳴呢？你聽你的鳥鳴，他看他的日出，
彼此都會有等量的美的感受。人與人偶有摩擦，往往都
是由於缺乏那分雅量的緣故；因此，為了減少摩擦，增
進和諧，我們必須努力培養雅量。
EOF;

        $this->assertSame($except, $this->textToImage->breakText($origin));
    }

    public function test_color_mutators()
    {
        $this->assertSame('000000', $this->textToImage->getColor());

        $this->textToImage->setColor('ffffff');

        $this->assertSame('ffffff', $this->textToImage->getColor());
    }

    public function test_font_path_mutators()
    {
        $this->assertNull($this->textToImage->getFontPath());

        $path = __DIR__.'/fonts/NotoSansCJKtc-Regular.otf';

        $this->textToImage->setFont($path);

        $this->assertSame($path, $this->textToImage->getFontPath());
    }
}
