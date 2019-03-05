<?php

/**
 * Class GTextTableCell
 */
class GTextTableCell
{
    /**
     * @var int
     */
    /**
     * @var int
     */
    public $iColSpan = 1, $iRowSpan = 1;
    /**
     * @var int
     */
    /**
     * @var int
     */
    /**
     * @var int
     */
    /**
     * @var int
     */
    public $iMarginLeft = 5, $iMarginRight = 5, $iMarginTop = 5, $iMarginBottom = 5;
    /**
     * @var Text|null
     */
    public $iVal = NULL;
    /**
     * @var string
     */
    /**
     * @var string
     */
    private $iBGColor = '', $iFontColor = 'black';
    /**
     * @var int
     */
    /**
     * @var int
     */
    /**
     * @var int
     */
    private $iFF = FF_FONT1, $iFS = FS_NORMAL, $iFSize = 10;
    /**
     * @var int
     */
    /**
     * @var int
     */
    private $iRow = 0, $iCol = 0;
    /**
     * @var string
     */
    /**
     * @var string
     */
    private $iVertAlign = 'bottom', $iHorAlign = 'left';
    /**
     * @var bool
     */
    /**
     * @var bool|int
     */
    /**
     * @var bool|int
     */
    private $iMerged = FALSE, $iPRow = NULL, $iPCol = NULL;
    /**
     * @var null
     */
    private $iTable = NULL;
    /**
     * @var array
     */
    private $iGridColor = array('darkgray', 'darkgray', 'darkgray', 'darkgray');
    /**
     * @var array
     */
    private $iGridWeight = array(1, 1, 0, 0); // left,top,bottom,right;
    /**
     * @var array
     */
    private $iGridStyle = array(TGRID_SINGLE, TGRID_SINGLE, TGRID_SINGLE, TGRID_SINGLE); // left,top,bottom,right;
    /**
     * @var null
     */
    private $iNumberFormat = null;
    /**
     * @var null
     */
    /**
     * @var array|null
     */
    private $iIcon = null, $iIconConstrain = array();
    /**
     * @var string
     */
    /**
     * @var string
     */
    /**
     * @var string
     */
    /**
     * @var string
     */
    private $iCSIMtarget = '', $iCSIMwintarget = '', $iCSIMalt = '', $iCSIMArea = '';

    /**
     * GTextTableCell constructor.
     * @param string $aVal
     * @param int $aRow
     * @param int $aCol
     * @throws JpGraphExceptionL
     */
    public function __construct($aVal = '', $aRow = 0, $aCol = 0)
    {
        $this->iVal = new Text($aVal);
        $this->iRow = $aRow;
        $this->iCol = $aCol;
        $this->iPRow = $aRow; // Initialiy each cell is its own parent
        $this->iPCol = $aCol;
        $this->iIconConstrain = array(-1, -1);
    }

    /**
     * @param $aTable
     */
    public function Init($aTable)
    {
        $this->iTable = $aTable;
    }

    /**
     * @param $aTarget
     * @param string $aAlt
     * @param string $aWinTarget
     */
    public function SetCSIMTarget($aTarget, $aAlt = '', $aWinTarget = '')
    {
        $this->iCSIMtarget = $aTarget;
        $this->iCSIMwintarget = $aWinTarget;
        $this->iCSIMalt = $aAlt;
    }

    /**
     * @return string
     */
    public function GetCSIMArea()
    {
        if ($this->iCSIMtarget !== '')
            return $this->iCSIMArea;
        else
            return '';
    }

    /**
     * @param $aType
     * @param $aVal
     * @throws JpGraphExceptionL
     */
    public function SetImageConstrain($aType, $aVal)
    {
        if (!in_array($aType, array(TIMG_WIDTH, TIMG_HEIGHT))) {
            JpGraphError::RaiseL(27015);
        }
        $this->iIconConstrain = array($aType, $aVal);
    }

    /**
     * @param $aFlag
     * @param float $aScale
     * @param int $aMix
     * @param int $aStdSize
     * @throws JpGraphExceptionL
     */
    public function SetCountryFlag($aFlag, $aScale = 1.0, $aMix = 100, $aStdSize = 3)
    {
        $this->iIcon = new IconPlot();
        $this->iIcon->SetCountryFlag($aFlag, 0, 0, $aScale, $aMix, $aStdSize);
    }

    /**
     * @param $aFile
     * @param float $aScale
     * @param int $aMix
     * @throws JpGraphExceptionL
     */
    public function SetImage($aFile, $aScale = 1.0, $aMix = 100)
    {
        $this->iIcon = new IconPlot($aFile, 0, 0, $aScale, $aMix);
    }

    /**
     * @param $aStr
     * @param float $aScale
     * @param int $aMix
     * @throws JpGraphExceptionL
     */
    public function SetImageFromString($aStr, $aScale = 1.0, $aMix = 100)
    {
        $this->iIcon = new IconPlot("", 0, 0, $aScale, $aMix);
        $this->iIcon->CreateFromString($aStr);
    }

    /**
     * @param $aRowSpan
     * @param $aColSpan
     */
    public function SetRowColSpan($aRowSpan, $aColSpan)
    {
        $this->iRowSpan = $aRowSpan;
        $this->iColSpan = $aColSpan;
        $this->iMerged = true;
    }

    /**
     * @param $aPRow
     * @param $aPCol
     * @param bool $aFlg
     */
    public function SetMerged($aPRow, $aPCol, $aFlg = true)
    {
        $this->iMerged = $aFlg;
        $this->iPRow = $aPRow;
        $this->iPCol = $aPCol;
    }

    /**
     * @return bool|int
     */
    public function IsMerged()
    {
        return $this->iMerged;
    }

    /**
     * @param $aF
     */
    public function SetNumberFormat($aF)
    {
        $this->iNumberFormat = $aF;
    }

    /**
     * @param $aTxt
     */
    public function Set($aTxt)
    {
        $this->iVal->Set($aTxt);
    }

    /**
     * @param $aFF
     * @param $aFS
     * @param $aFSize
     */
    public function SetFont($aFF, $aFS, $aFSize)
    {
        $this->iFF = $aFF;
        $this->iFS = $aFS;
        $this->iFSize = $aFSize;
        $this->iVal->SetFont($aFF, $aFS, $aFSize);
    }

    /**
     * @param $aColor
     */
    public function SetFillColor($aColor)
    {
        $this->iBGColor = $aColor;
    }

    /**
     * @param $aColor
     */
    public function SetFontColor($aColor)
    {
        $this->iFontColor = $aColor;
    }

    /**
     * @param $aLeft
     * @param null $aTop
     * @param null $aBottom
     * @param null $aRight
     */
    public function SetGridColor($aLeft, $aTop = null, $aBottom = null, $aRight = null)
    {
        if ($aLeft !== null) $this->iGridColor[0] = $aLeft;
        if ($aTop !== null) $this->iGridColor[1] = $aTop;
        if ($aBottom !== null) $this->iGridColor[2] = $aBottom;
        if ($aRight !== null) $this->iGridColor[3] = $aRight;
    }

    /**
     * @param $aLeft
     * @param null $aTop
     * @param null $aBottom
     * @param null $aRight
     */
    public function SetGridStyle($aLeft, $aTop = null, $aBottom = null, $aRight = null)
    {
        if ($aLeft !== null) $this->iGridStyle[0] = $aLeft;
        if ($aTop !== null) $this->iGridStyle[1] = $aTop;
        if ($aBottom !== null) $this->iGridStyle[2] = $aBottom;
        if ($aRight !== null) $this->iGridStyle[3] = $aRight;
    }

    /**
     * @param null $aLeft
     * @param null $aTop
     * @param null $aBottom
     * @param null $aRight
     */
    public function SetGridWeight($aLeft = null, $aTop = null, $aBottom = null, $aRight = null)
    {
        $weight_arr = array($aLeft, $aTop, $aBottom, $aRight);
        for ($i = 0; $i < count($weight_arr); $i++) {
            if ($weight_arr[$i] === "") {
                $weight_arr[$i] = 0;
            }
        }
        if ($aLeft !== null) $this->iGridWeight[0] = $weight_arr[0];
        if ($aTop !== null) $this->iGridWeight[1] = $weight_arr[1];
        if ($aBottom !== null) $this->iGridWeight[2] = $weight_arr[2];
        if ($aRight !== null) $this->iGridWeight[3] = $weight_arr[3];
    }

    /**
     * @param $aLeft
     * @param $aRight
     * @param $aTop
     * @param $aBottom
     */
    public function SetMargin($aLeft, $aRight, $aTop, $aBottom)
    {
        $this->iMarginLeft = $aLeft;
        $this->iMarginRight = $aRight;
        $this->iMarginTop = $aTop;
        $this->iMarginBottom = $aBottom;
    }

    /**
     * @param $aImg
     * @return float|int
     */
    public function GetWidth($aImg)
    {
        if ($this->iIcon !== null) {
            if ($this->iIconConstrain[0] == TIMG_WIDTH) {
                $this->iIcon->SetScale(1);
                $tmp = $this->iIcon->GetWidthHeight();
                $this->iIcon->SetScale($this->iIconConstrain[1] / $tmp[0]);
            } elseif ($this->iIconConstrain[0] == TIMG_HEIGHT) {
                $this->iIcon->SetScale(1);
                $tmp = $this->iIcon->GetWidthHeight();
                $this->iIcon->SetScale($this->iIconConstrain[1] / $tmp[1]);
            }
            $tmp = $this->iIcon->GetWidthHeight();
            $iwidth = $tmp[0];
        } else {
            $iwidth = 0;
        }
        if ($this->iTable->iCells[$this->iPRow][$this->iPCol]->iVal->dir == 0) {
            $pwidth = $this->iTable->iCells[$this->iPRow][$this->iPCol]->iVal->GetWidth($aImg);
        } elseif ($this->iTable->iCells[$this->iPRow][$this->iPCol]->iVal->dir == 90) {
            $pwidth = $this->iTable->iCells[$this->iPRow][$this->iPCol]->iVal->GetFontHeight($aImg) + 2;
        } else {
            $pwidth = $this->iTable->iCells[$this->iPRow][$this->iPCol]->iVal->GetWidth($aImg) + 2;
        }

        $pcolspan = $this->iTable->iCells[$this->iPRow][$this->iPCol]->iColSpan;
        return round(max($iwidth, $pwidth) / $pcolspan) + $this->iMarginLeft + $this->iMarginRight;
    }

    /**
     * @param $aImg
     * @return float|int
     */
    public function GetHeight($aImg)
    {
        if ($this->iIcon !== null) {
            if ($this->iIconConstrain[0] == TIMG_WIDTH) {
                $this->iIcon->SetScale(1);
                $tmp = $this->iIcon->GetWidthHeight();
                $this->iIcon->SetScale($this->iIconConstrain[1] / $tmp[0]);
            } elseif ($this->iIconConstrain[0] == TIMG_HEIGHT) {
                $this->iIcon->SetScale(1);
                $tmp = $this->iIcon->GetWidthHeight();
                $this->iIcon->SetScale($this->iIconConstrain[1] / $tmp[1]);
            }
            $tmp = $this->iIcon->GetWidthHeight();
            $iheight = $tmp[1];
        } else {
            $iheight = 0;
        }
        if ($this->iTable->iCells[$this->iPRow][$this->iPCol]->iVal->dir == 0) {
            $pheight = $this->iTable->iCells[$this->iPRow][$this->iPCol]->iVal->GetHeight($aImg);
        } else {
            $pheight = $this->iTable->iCells[$this->iPRow][$this->iPCol]->iVal->GetHeight($aImg) + 1;
        }
        $prowspan = $this->iTable->iCells[$this->iPRow][$this->iPCol]->iRowSpan;
        return round(max($iheight, $pheight) / $prowspan) + $this->iMarginTop + $this->iMarginBottom;
    }

    /**
     * @param string $aHorAlign
     * @param string $aVertAlign
     * @throws JpGraphExceptionL
     */
    public function SetAlign($aHorAlign = 'left', $aVertAlign = 'bottom')
    {
        $aHorAlign = strtolower($aHorAlign);
        $aVertAlign = strtolower($aVertAlign);
        $chk = array('left', 'right', 'center', 'bottom', 'top', 'middle');
        if (!in_array($aHorAlign, $chk) || !in_array($aVertAlign, $chk)) {
            JpGraphError::RaiseL(27011, $aHorAlign, $aVertAlign);
        }
        $this->iVertAlign = $aVertAlign;
        $this->iHorAlign = $aHorAlign;
    }

    /**
     *
     */
    public function AdjustMarginsForGrid()
    {
        if ($this->iCol > 0) {
            switch ($this->iGridStyle[0]) {
                case TGRID_SINGLE:
                    $wf = 1;
                    break;
                case TGRID_DOUBLE:
                    $wf = 3;
                    break;
                case TGRID_DOUBLE2:
                    $wf = 4;
                    break;
            }
            $this->iMarginLeft += $this->iGridWeight[0] * $wf;
        }
        if ($this->iRow > 0) {
            switch ($this->iGridStyle[1]) {
                case TGRID_SINGLE:
                    $wf = 1;
                    break;
                case TGRID_DOUBLE:
                    $wf = 3;
                    break;
                case TGRID_DOUBLE2:
                    $wf = 4;
                    break;
            }
            $this->iMarginTop += $this->iGridWeight[1] * $wf;
        }
        if ($this->iRow + $this->iRowSpan - 1 < $this->iTable->iSize[0] - 1) {
            switch ($this->iGridStyle[2]) {
                case TGRID_SINGLE:
                    $wf = 1;
                    break;
                case TGRID_DOUBLE:
                    $wf = 3;
                    break;
                case TGRID_DOUBLE2:
                    $wf = 4;
                    break;
            }
            $this->iMarginBottom += $this->iGridWeight[2] * $wf;
        }
        if ($this->iCol + $this->iColSpan - 1 < $this->iTable->iSize[1] - 1) {
            switch ($this->iGridStyle[3]) {
                case TGRID_SINGLE:
                    $wf = 1;
                    break;
                case TGRID_DOUBLE:
                    $wf = 3;
                    break;
                case TGRID_DOUBLE2:
                    $wf = 4;
                    break;
            }
            $this->iMarginRight += $this->iGridWeight[3] * $wf;
        }
    }

    /**
     * @param $aImg
     * @param $aX
     * @param $aY
     * @param $aWidth
     * @param $aHeight
     * @param int $aDir
     */
    public function StrokeVGrid($aImg, $aX, $aY, $aWidth, $aHeight, $aDir = 1)
    {
        // Left or right grid line
        // For the right we increase the X-pos and for the right we decrease it. This is
        // determined by the direction argument.
        $idx = $aDir == 1 ? 0 : 3;

        // We don't stroke the grid lines that are on the edge of the table since this is
        // the place of the border.
        if ((($this->iCol > 0 && $idx == 0) || ($this->iCol + $this->iColSpan - 1 < $this->iTable->iSize[1] - 1 && $idx == 3))
            && $this->iGridWeight[$idx] > 0) {
            $x = $aDir == 1 ? $aX : $aX + $aWidth - 1;
            $y = $aY + $aHeight - 1;
            $aImg->SetColor($this->iGridColor[$idx]);
            switch ($this->iGridStyle[$idx]) {
                case TGRID_SINGLE:
                    for ($i = 0; $i < $this->iGridWeight[$idx]; ++$i)
                        $aImg->Line($x + $i * $aDir, $aY, $x + $i * $aDir, $y);
                    break;

                case TGRID_DOUBLE:
                    for ($i = 0; $i < $this->iGridWeight[$idx]; ++$i)
                        $aImg->Line($x + $i * $aDir, $aY, $x + $i * $aDir, $y);
                    $x += $this->iGridWeight[$idx] * 2;
                    for ($i = 0; $i < $this->iGridWeight[$idx]; ++$i)
                        $aImg->Line($x + $i * $aDir, $aY, $x + $i * $aDir, $y);
                    break;

                case TGRID_DOUBLE2:
                    for ($i = 0; $i < $this->iGridWeight[$idx] * 2; ++$i)
                        $aImg->Line($x + $i * $aDir, $aY, $x + $i * $aDir, $y);
                    $x += $this->iGridWeight[$idx] * 3;
                    for ($i = 0; $i < $this->iGridWeight[$idx]; ++$i)
                        $aImg->Line($x + $i * $aDir, $aY, $x + $i * $aDir, $y);
                    break;
            }
        }
    }

    /**
     * @param $aImg
     * @param $aX
     * @param $aY
     * @param $aWidth
     * @param $aHeight
     * @param int $aDir
     */
    public function StrokeHGrid($aImg, $aX, $aY, $aWidth, $aHeight, $aDir = 1)
    {
        // Top or bottom grid line
        // For the left we increase the X-pos and for the right we decrease it. This is
        // determined by the direction argument.
        $idx = $aDir == 1 ? 1 : 2;

        // We don't stroke the grid lines that are on the edge of the table since this is
        // the place of the border.
        if ((($this->iRow > 0 && $idx == 1) || ($this->iRow + $this->iRowSpan - 1 < $this->iTable->iSize[0] - 1 && $idx == 2))
            && $this->iGridWeight[$idx] > 0) {
            $y = $aDir == 1 ? $aY : $aY + $aHeight - 1;
            $x = $aX + $aWidth - 1;
            $aImg->SetColor($this->iGridColor[$idx]);
            switch ($this->iGridStyle[$idx]) {
                case TGRID_SINGLE:
                    for ($i = 0; $i < $this->iGridWeight[$idx]; ++$i)
                        $aImg->Line($aX, $y + $i, $x, $y + $i);
                    break;

                case TGRID_DOUBLE:
                    for ($i = 0; $i < $this->iGridWeight[$idx]; ++$i)
                        $aImg->Line($aX, $y + $i, $x, $y + $i);
                    $y += $this->iGridWeight[$idx] * 2;
                    for ($i = 0; $i < $this->iGridWeight[$idx]; ++$i)
                        $aImg->Line($aX, $y + $i, $x, $y + $i);
                    break;

                case TGRID_DOUBLE2:
                    for ($i = 0; $i < $this->iGridWeight[$idx] * 2; ++$i)
                        $aImg->Line($aX, $y + $i, $x, $y + $i);
                    $y += $this->iGridWeight[$idx] * 3;
                    for ($i = 0; $i < $this->iGridWeight[$idx]; ++$i)
                        $aImg->Line($aX, $y + $i, $x, $y + $i);
                    break;
            }
        }
    }

    /**
     * @param $aImg
     * @param $aX
     * @param $aY
     * @param $aWidth
     * @param $aHeight
     * @throws JpGraphExceptionL
     */
    public function Stroke($aImg, $aX, $aY, $aWidth, $aHeight)
    {
        // If this is a merged cell we only stroke if it is the parent cell.
        // The parent cell holds the merged cell block
        if ($this->iMerged && ($this->iRow != $this->iPRow || $this->iCol != $this->iPCol)) {
            return;
        }

        if ($this->iBGColor != '') {
            $aImg->SetColor($this->iBGColor);
            $aImg->FilledRectangle($aX, $aY, $aX + $aWidth - 1, $aY + $aHeight - 1);
        }

        $coords = $aX . ',' . $aY . ',' . ($aX + $aWidth - 1) . ',' . $aY . ',' . ($aX + $aWidth - 1) . ',' . ($aY + $aHeight - 1) . ',' . $aX . ',' . ($aY + $aHeight - 1);
        if (!empty($this->iCSIMtarget)) {
            $this->iCSIMArea = '<area shape="poly" coords="' . $coords . '" href="' . $this->iCSIMtarget . '"';
            if (!empty($this->iCSIMwintarget)) {
                $this->iCSIMArea .= " target=\"" . $this->iCSIMwintarget . "\"";
            }
            if (!empty($this->iCSIMalt)) {
                $this->iCSIMArea .= ' alt="' . $this->iCSIMalt . '" title="' . $this->iCSIMalt . "\" ";
            }
            $this->iCSIMArea .= " />\n";
        }

        $this->StrokeVGrid($aImg, $aX, $aY, $aWidth, $aHeight);
        $this->StrokeVGrid($aImg, $aX, $aY, $aWidth, $aHeight, -1);
        $this->StrokeHGrid($aImg, $aX, $aY, $aWidth, $aHeight);
        $this->StrokeHGrid($aImg, $aX, $aY, $aWidth, $aHeight, -1);

        if ($this->iIcon !== null) {
            switch ($this->iHorAlign) {
                case 'left':
                    $x = $aX + $this->iMarginLeft;
                    $hanchor = 'left';
                    break;
                case 'center':
                case 'middle':
                    $x = $aX + $this->iMarginLeft + round(($aWidth - $this->iMarginLeft - $this->iMarginRight) / 2);
                    $hanchor = 'center';
                    break;
                case 'right':
                    $x = $aX + $aWidth - $this->iMarginRight - 1;
                    $hanchor = 'right';
                    break;
                default:
                    JpGraphError::RaiseL(27012, $this->iHorAlign);
            }

            switch ($this->iVertAlign) {
                case 'top':
                    $y = $aY + $this->iMarginTop;
                    $vanchor = 'top';
                    break;
                case 'center':
                case 'middle':
                    $y = $aY + $this->iMarginTop + round(($aHeight - $this->iMarginTop - $this->iMarginBottom) / 2);
                    $vanchor = 'center';
                    break;
                case 'bottom':
                    $y = $aY + $aHeight - 1 - $this->iMarginBottom;
                    $vanchor = 'bottom';
                    break;
                default:
                    JpGraphError::RaiseL(27012, $this->iVertAlign);
            }
            $this->iIcon->SetAnchor($hanchor, $vanchor);
            $this->iIcon->_Stroke($aImg, $x, $y);
        }
        $this->iVal->SetColor($this->iFontColor);
        $this->iVal->SetFont($this->iFF, $this->iFS, $this->iFSize);
        switch ($this->iHorAlign) {
            case 'left':
                $x = $aX + $this->iMarginLeft;
                break;
            case 'center':
            case 'middle':
                $x = $aX + $this->iMarginLeft + round(($aWidth - $this->iMarginLeft - $this->iMarginRight) / 2);
                break;
            case 'right':
                $x = $aX + $aWidth - $this->iMarginRight - 1;
                break;
            default:
                JpGraphError::RaiseL(27012, $this->iHorAlign);
        }
        // A workaround for the shortcomings in the TTF font handling in GD
        // The anchor position for rotated text (=90) is to "short" so we add
        // an offset based on the actual font size
        if ($this->iVal->dir != 0 && $this->iVal->font_family >= 10) {
            $aY += 4 + round($this->iVal->font_size * 0.8);
        }
        switch ($this->iVertAlign) {
            case 'top':
                $y = $aY + $this->iMarginTop;
                break;
            case 'center':
            case 'middle':
                $y = $aY + $this->iMarginTop + round(($aHeight - $this->iMarginTop - $this->iMarginBottom) / 2);
                //$y -= round($this->iVal->GetFontHeight($aImg)/2);
                $y -= round($this->iVal->GetHeight($aImg) / 2);
                break;
            case 'bottom':
                //$y = $aY+$aHeight-1-$this->iMarginBottom-$this->iVal->GetFontHeight($aImg);
                $y = $aY + $aHeight - $this->iMarginBottom - $this->iVal->GetHeight($aImg);
                break;
            default:
                JpGraphError::RaiseL(27012, $this->iVertAlign);
        }
        $this->iVal->SetAlign($this->iHorAlign, 'top');
        if ($this->iNumberFormat !== null && is_numeric($this->iVal->t)) {
            $this->iVal->t = sprintf($this->iNumberFormat, $this->iVal->t);
        }
        $this->iVal->Stroke($aImg, $x, $y);
    }
}

