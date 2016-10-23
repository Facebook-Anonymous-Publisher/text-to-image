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
}
