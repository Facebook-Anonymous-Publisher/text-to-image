<?php

namespace FacebookAnonymousPublisher\TextToImage;

use Intervention\Image\AbstractFont;
use Intervention\Image\ImageManager;
use Mexitek\PHPColors\Color;

class TextToImage
{
    /**
     * Canvas background color.
     *
     * @var string
     */
    protected $color;

    /**
     * Canvas font file path.
     *
     * @var null|string
     */
    protected $fontPath = null;

    /**
     * Constructor.
     *
     * @param null|string $fontPath
     * @param string $color
     */
    public function __construct($fontPath = null, $color = '000000')
    {
        $this->image = new ImageManager;

        $this->fontPath = $fontPath;

        $this->color = $color;
    }

    /**
     * Create a text image.
     *
     * @param string $text
     *
     * @return \Intervention\Image\Image
     */
    public function make($text)
    {
        if (is_null($this->fontPath)) {
            throw new \InvalidArgumentException('Font file path is not set.');
        }

        $text = $this->breakText($text);

        $dimensions = $this->calculateDimensions($text);

        return $this->image
            ->canvas($dimensions['width'], $dimensions['height'], "#{$this->color}")
            ->text($text, $dimensions['width'] / 2, $dimensions['height'] / 2, function (AbstractFont $font) {
                $color = new Color($this->color);

                $font->file($this->fontPath);
                $font->size(48);
                $font->color($color->isDark() ? '#fff' : '#000');
                $font->align('center');
                $font->valign('middle');
            });
    }

    /**
     * Calculate canvas width and height.
     *
     * @param string $text
     *
     * @return array
     */
    protected function calculateDimensions($text)
    {
        $box = imagettfbbox(38, 0, $this->fontPath, $text);

        return [
            'width' => abs($box[4] - $box[0]),
            'height' => abs($box[5] - $box[1]),
        ];
    }

    /**
     * Ensure the length of each line is not longer than 48.
     *
     * @param string $text
     *
     * @return string
     */
    public function breakText($text)
    {
        $lines = explode(PHP_EOL, $text);

        foreach ($lines as &$line) {
            if (mb_strwidth($line) > 48) {
                $line = $this->segmentLine($line);
            }
        }

        return implode(PHP_EOL, $lines);
    }

    /**
     * Segment text to multiple lines if needed.
     *
     * @param string $text
     *
     * @return string
     */
    protected function segmentLine($text)
    {
        list($lines, $temp, $width) = [[], '', 0];

        foreach (preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY) as $word) {
            if ($width + mb_strwidth($word) > 48) {
                $lines[] = $temp;
                $temp = '';
                $width = 0;
            }

            $temp .= $word;

            $width += mb_strwidth($word);
        }

        $lines[] = $temp;

        return implode(PHP_EOL, $lines);
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set canvas background color.
     *
     * @param string $color
     *
     * @return $this
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFontPath()
    {
        return $this->fontPath;
    }

    /**
     * Set canvas font file path.
     *
     * @param string $path
     *
     * @return $this
     */
    public function setFont($path)
    {
        $this->fontPath = $path;

        return $this;
    }
}
