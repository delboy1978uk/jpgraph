<?php

//===================================================
// CLASS DisplayValue
// Description: Used to print data values at data points
//===================================================

/**
 * Class DisplayValue
 */
class DisplayValue
{
    /**
     * @var int
     */
    public $margin = 5;
    /**
     * @var bool
     */
    public $show = false;
    /**
     * @var string
     */
    /**
     * @var string
     */
    public $valign = '', $halign = 'center';
    /**
     * @var string
     */
    /**
     * @var string
     */
    public $format = '%.1f', $negformat = '';
    /**
     * @var int
     */
    /**
     * @var int
     */
    /**
     * @var int
     */
    private $ff = FF_DEFAULT, $fs = FS_NORMAL, $fsize = 8;
    /**
     * @var string
     */
    private $iFormCallback = '';
    /**
     * @var int
     */
    private $angle = 0;
    /**
     * @var string
     */
    /**
     * @var string
     */
    private $color = 'navy', $negcolor = '';
    /**
     * @var bool
     */
    private $iHideZero = false;
    /**
     * @var Text|null
     */
    public $txt = null;

    /**
     * DisplayValue constructor.
     */
    public function __construct()
    {
        $this->txt = new Text();
    }

    /**
     * @param bool $aFlag
     */
    public function Show($aFlag = true)
    {
        $this->show = $aFlag;
    }

    /**
     * @param $aColor
     * @param string $aNegcolor
     */
    public function SetColor($aColor, $aNegcolor = '')
    {
        $this->color = $aColor;
        $this->negcolor = $aNegcolor;
    }

    /**
     * @param $aFontFamily
     * @param int $aFontStyle
     * @param int $aFontSize
     */
    public function SetFont($aFontFamily, $aFontStyle = FS_NORMAL, $aFontSize = 8)
    {
        $this->ff = $aFontFamily;
        $this->fs = $aFontStyle;
        $this->fsize = $aFontSize;
    }

    /**
     * @param $aImg
     */
    public function ApplyFont($aImg)
    {
        $aImg->SetFont($this->ff, $this->fs, $this->fsize);
    }

    /**
     * @param $aMargin
     */
    public function SetMargin($aMargin)
    {
        $this->margin = $aMargin;
    }

    /**
     * @param $aAngle
     */
    public function SetAngle($aAngle)
    {
        $this->angle = $aAngle;
    }

    /**
     * @param $aHAlign
     * @param string $aVAlign
     */
    public function SetAlign($aHAlign, $aVAlign = '')
    {
        $this->halign = $aHAlign;
        $this->valign = $aVAlign;
    }

    /**
     * @param $aFormat
     * @param string $aNegFormat
     */
    public function SetFormat($aFormat, $aNegFormat = '')
    {
        $this->format = $aFormat;
        $this->negformat = $aNegFormat;
    }

    /**
     * @param $aFunc
     */
    public function SetFormatCallback($aFunc)
    {
        $this->iFormCallback = $aFunc;
    }

    /**
     * @param bool $aFlag
     */
    public function HideZero($aFlag = true)
    {
        $this->iHideZero = $aFlag;
    }

    /**
     * @param $img
     * @param $aVal
     * @param $x
     * @param $y
     */
    public function Stroke($img, $aVal, $x, $y)
    {

        if ($this->show) {
            if ($this->negformat == '') {
                $this->negformat = $this->format;
            }
            if ($this->negcolor == '') {
                $this->negcolor = $this->color;
            }

            if ($aVal === NULL || (is_string($aVal) && ($aVal == '' || $aVal == '-' || $aVal == 'x'))) {
                return;
            }

            if (is_numeric($aVal) && $aVal == 0 && $this->iHideZero) {
                return;
            }

            // Since the value is used in different cirumstances we need to check what
            // kind of formatting we shall use. For example, to display values in a line
            // graph we simply display the formatted value, but in the case where the user
            // has already specified a text string we don't fo anything.
            if ($this->iFormCallback != '') {
                $f = $this->iFormCallback;
                $sval = call_user_func($f, $aVal);
            } elseif (is_numeric($aVal)) {
                if ($aVal >= 0) {
                    $sval = sprintf($this->format, $aVal);
                } else {
                    $sval = sprintf($this->negformat, $aVal);
                }
            } else {
                $sval = $aVal;
            }

            $y = $y - sign($aVal) * $this->margin;

            $this->txt->Set($sval);
            $this->txt->SetPos($x, $y);
            $this->txt->SetFont($this->ff, $this->fs, $this->fsize);
            if ($this->valign == '') {
                if ($aVal >= 0) {
                    $valign = "bottom";
                } else {
                    $valign = "top";
                }
            } else {
                $valign = $this->valign;
            }
            $this->txt->Align($this->halign, $valign);

            $this->txt->SetOrientation($this->angle);
            if ($aVal > 0) {
                $this->txt->SetColor($this->color);
            } else {
                $this->txt->SetColor($this->negcolor);
            }
            $this->txt->Stroke($img);
        }
    }
}