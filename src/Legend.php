<?php

/**
 * Class Legend
 */
class Legend
{
    /**
     * @var array
     */
    public $txtcol = array();
    /**
     * @var int
     */
    /**
     * @var int
     */
    /**
     * @var int
     */
    public $font_family = FF_DEFAULT, $font_style = FS_NORMAL, $font_size = 8; // old. 12
    /**
     * @var array
     */
    private $color = array(120, 120, 120); // Default frame color
    /**
     * @var array
     */
    private $fill_color = array(245, 245, 245); // Default fill color
    /**
     * @var bool
     */
    private $shadow = false; // Shadow around legend "box"
    /**
     * @var string
     */
    private $shadow_color = 'darkgray';
    /**
     * @var int
     */
    /**
     * @var int
     */
    private $mark_abs_hsize = _DEFAULT_LPM_SIZE, $mark_abs_vsize = _DEFAULT_LPM_SIZE;
    /**
     * @var int
     */
    /**
     * @var int
     */
    /**
     * @var int
     */
    private $xmargin = 10, $ymargin = 0, $shadow_width = 2;
    /**
     * @var int
     */
    private $xlmargin = 4;
    /**
     * @var int
     */
    private $ylinespacing = 5;

    // We need a separate margin since the baseline of the last text would coincide with the bottom otherwise
    /**
     * @var int
     */
    private $ybottom_margin = 8;

    /**
     * @var float
     */
    /**
     * @var float
     */
    /**
     * @var float
     */
    /**
     * @var float
     */
    private $xpos = 0.05, $ypos = 0.15, $xabspos = -1, $yabspos = -1;
    /**
     * @var string
     */
    /**
     * @var string
     */
    private $halign = "right", $valign = "top";
    /**
     * @var string
     */
    private $font_color = 'black';
    /**
     * @var bool
     */
    /**
     * @var bool
     */
    private $hide = false, $layout_n = 1;
    /**
     * @var int
     */
    /**
     * @var int
     */
    private $weight = 1, $frameweight = 1;
    /**
     * @var string
     */
    private $csimareas = '';
    /**
     * @var bool
     */
    private $reverse = false;
    /**
     * @var int
     */
    /**
     * @var int
     */
    /**
     * @var int
     */
    private $bkg_gradtype = -1, $bkg_gradfrom = 'lightgray', $bkg_gradto = 'gray';

    //---------------
    // CONSTRUCTOR
    /**
     * Legend constructor.
     */
    public function __construct()
    {
        // Empty
    }
    //---------------
    // PUBLIC METHODS
    /**
     * @param bool $aHide
     */
    public function Hide($aHide = true)
    {
        $this->hide = $aHide;
    }

    /**
     * @param $aXMarg
     */
    public function SetHColMargin($aXMarg)
    {
        $this->xmargin = $aXMarg;
    }

    /**
     * @param $aSpacing
     */
    public function SetVColMargin($aSpacing)
    {
        $this->ylinespacing = $aSpacing;
    }

    /**
     * @param $aXMarg
     */
    public function SetLeftMargin($aXMarg)
    {
        $this->xlmargin = $aXMarg;
    }

    // Synonym

    /**
     * @param $aSpacing
     */
    public function SetLineSpacing($aSpacing)
    {
        $this->ylinespacing = $aSpacing;
    }

    /**
     * @param string $aShow
     * @param int $aWidth
     */
    public function SetShadow($aShow = 'gray', $aWidth = 4)
    {
        if (is_string($aShow)) {
            $this->shadow_color = $aShow;
            $this->shadow = true;
        } else {
            $this->shadow = $aShow;
        }
        $this->shadow_width = $aWidth;
    }

    /**
     * @param $aSize
     */
    public function SetMarkAbsSize($aSize)
    {
        $this->mark_abs_vsize = $aSize;
        $this->mark_abs_hsize = $aSize;
    }

    /**
     * @param $aSize
     */
    public function SetMarkAbsVSize($aSize)
    {
        $this->mark_abs_vsize = $aSize;
    }

    /**
     * @param $aSize
     */
    public function SetMarkAbsHSize($aSize)
    {
        $this->mark_abs_hsize = $aSize;
    }

    /**
     * @param $aWeight
     */
    public function SetLineWeight($aWeight)
    {
        $this->weight = $aWeight;
    }

    /**
     * @param $aWeight
     */
    public function SetFrameWeight($aWeight)
    {
        $this->frameweight = $aWeight;
    }

    /**
     * @param int $aDirection
     */
    public function SetLayout($aDirection = LEGEND_VERT)
    {
        $this->layout_n = $aDirection == LEGEND_VERT ? 1 : 99;
    }

    /**
     * @param $aCols
     */
    public function SetColumns($aCols)
    {
        $this->layout_n = $aCols;
    }

    /**
     * @param bool $f
     */
    public function SetReverse($f = true)
    {
        $this->reverse = $f;
    }

    // Set color on frame around box

    /**
     * @param $aFontColor
     * @param string $aColor
     */
    public function SetColor($aFontColor, $aColor = 'black')
    {
        $this->font_color = $aFontColor;
        $this->color = $aColor;
    }

    /**
     * @param $aFamily
     * @param int $aStyle
     * @param int $aSize
     */
    public function SetFont($aFamily, $aStyle = FS_NORMAL, $aSize = 10)
    {
        $this->font_family = $aFamily;
        $this->font_style = $aStyle;
        $this->font_size = $aSize;
    }

    /**
     * @param $aX
     * @param $aY
     * @param string $aHAlign
     * @param string $aVAlign
     */
    public function SetPos($aX, $aY, $aHAlign = 'right', $aVAlign = 'top')
    {
        $this->Pos($aX, $aY, $aHAlign, $aVAlign);
    }

    /**
     * @param $aX
     * @param $aY
     * @param string $aHAlign
     * @param string $aVAlign
     */
    public function SetAbsPos($aX, $aY, $aHAlign = 'right', $aVAlign = 'top')
    {
        $this->xabspos = $aX;
        $this->yabspos = $aY;
        $this->halign = $aHAlign;
        $this->valign = $aVAlign;
    }

    /**
     * @param $aX
     * @param $aY
     * @param string $aHAlign
     * @param string $aVAlign
     * @throws JpGraphExceptionL
     */
    public function Pos($aX, $aY, $aHAlign = 'right', $aVAlign = 'top')
    {
        if (!($aX < 1 && $aY < 1)) {
            JpGraphError::RaiseL(25120);//(" Position for legend must be given as percentage in range 0-1");
        }
        $this->xpos = $aX;
        $this->ypos = $aY;
        $this->halign = $aHAlign;
        $this->valign = $aVAlign;
    }

    /**
     * @param $aColor
     */
    public function SetFillColor($aColor)
    {
        $this->fill_color = $aColor;
    }

    /**
     *
     */
    public function Clear()
    {
        $this->txtcol = array();
    }

    /**
     * @param $aTxt
     * @param $aColor
     * @param string $aPlotmark
     * @param int $aLinestyle
     * @param string $csimtarget
     * @param string $csimalt
     * @param string $csimwintarget
     */
    public function Add($aTxt, $aColor, $aPlotmark = '', $aLinestyle = 0, $csimtarget = '', $csimalt = '', $csimwintarget = '')
    {
        $this->txtcol[] = array($aTxt, $aColor, $aPlotmark, $aLinestyle, $csimtarget, $csimalt, $csimwintarget);
    }

    /**
     * @return string
     */
    public function GetCSIMAreas()
    {
        return $this->csimareas;
    }

    /**
     * @param string $aFrom
     * @param string $aTo
     * @param int $aGradType
     */
    public function SetBackgroundGradient($aFrom = 'navy', $aTo = 'silver', $aGradType = 2)
    {
        $this->bkg_gradtype = $aGradType;
        $this->bkg_gradfrom = $aFrom;
        $this->bkg_gradto = $aTo;
    }

    /**
     * @return bool
     */
    public function HasItems()
    {
        return (boolean)(count($this->txtcol));
    }

    /**
     * @param $aImg
     * @throws JpGraphExceptionL
     */
    public function Stroke($aImg)
    {
        // Constant
        $fillBoxFrameWeight = 1;

        if ($this->hide) return;

        $aImg->SetFont($this->font_family, $this->font_style, $this->font_size);

        if ($this->reverse) {
            $this->txtcol = array_reverse($this->txtcol);
        }

        $n = count($this->txtcol);
        if ($n == 0) return;

        // Find out the max width and height of each column to be able
        // to size the legend box.
        $numcolumns = ($n > $this->layout_n ? $this->layout_n : $n);
        for ($i = 0; $i < $numcolumns; ++$i) {
            $colwidth[$i] = $aImg->GetTextWidth($this->txtcol[$i][0]) +
                2 * $this->xmargin + 2 * $this->mark_abs_hsize;
            $colheight[$i] = 0;

        }

        // Find our maximum height in each row
        $rows = 0;
        $rowheight[0] = 0;
        for ($i = 0; $i < $n; ++$i) {
            $h = max($this->mark_abs_vsize, $aImg->GetTextHeight($this->txtcol[$i][0])) + $this->ylinespacing;

            // Makes sure we always have a minimum of 1/4 (1/2 on each side) of the mark as space
            // between two vertical legend entries
            //$h = round(max($h,$this->mark_abs_vsize+$this->ymargin));
            //echo "Textheight #$i: tetxheight=".$aImg->GetTextHeight($this->txtcol[$i][0]).', ';
            //echo "h=$h ({$this->mark_abs_vsize},{$this->ymargin})<br>";
            if ($i % $numcolumns == 0) {
                $rows++;
                $rowheight[$rows - 1] = 0;
            }
            $rowheight[$rows - 1] = max($rowheight[$rows - 1], $h) + 1;
        }

        $abs_height = 0;
        for ($i = 0; $i < $rows; ++$i) {
            $abs_height += $rowheight[$i];
        }

        // Make sure that the height is at least as high as mark size + ymargin
        $abs_height = max($abs_height, $this->mark_abs_vsize);
        $abs_height += $this->ybottom_margin;

        // Find out the maximum width in each column
        for ($i = $numcolumns; $i < $n; ++$i) {
            $colwidth[$i % $numcolumns] = max(
                $aImg->GetTextWidth($this->txtcol[$i][0]) + 2 * $this->xmargin + 2 * $this->mark_abs_hsize,
                $colwidth[$i % $numcolumns]);
        }

        // Get the total width
        $mtw = 0;
        for ($i = 0; $i < $numcolumns; ++$i) {
            $mtw += $colwidth[$i];
        }

        // remove the last rows interpace margin (since there is no next row)
        $abs_height -= $this->ylinespacing;


        // Find out maximum width we need for legend box
        $abs_width = $mtw + $this->xlmargin + ($numcolumns - 1) * $this->mark_abs_hsize;

        if ($this->xabspos === -1 && $this->yabspos === -1) {
            $this->xabspos = $this->xpos * $aImg->width;
            $this->yabspos = $this->ypos * $aImg->height;
        }

        // Positioning of the legend box
        if ($this->halign == 'left') {
            $xp = $this->xabspos;
        } elseif ($this->halign == 'center') {
            $xp = $this->xabspos - $abs_width / 2;
        } else {
            $xp = $aImg->width - $this->xabspos - $abs_width;
        }

        $yp = $this->yabspos;
        if ($this->valign == 'center') {
            $yp -= $abs_height / 2;
        } elseif ($this->valign == 'bottom') {
            $yp -= $abs_height;
        }

        // Stroke legend box
        $aImg->SetColor($this->color);
        $aImg->SetLineWeight($this->frameweight);
        $aImg->SetLineStyle('solid');

        if ($this->shadow) {
            $aImg->ShadowRectangle($xp, $yp,
                $xp + $abs_width + $this->shadow_width + 2,
                $yp + $abs_height + $this->shadow_width + 2,
                $this->fill_color, $this->shadow_width + 2, $this->shadow_color);
        } else {
            $aImg->SetColor($this->fill_color);
            $aImg->FilledRectangle($xp, $yp, $xp + $abs_width, $yp + $abs_height);
            $aImg->SetColor($this->color);
            $aImg->Rectangle($xp, $yp, $xp + $abs_width, $yp + $abs_height);
        }

        if ($this->bkg_gradtype >= 0) {
            $grad = new Gradient($aImg);
            $grad->FilledRectangle($xp + 1, $yp + 1,
                $xp + $abs_width - 3, $yp + $abs_height - 3,
                $this->bkg_gradfrom, $this->bkg_gradto,
                $this->bkg_gradtype);
        }

        // x1,y1 is the position for the legend marker + text
        // The vertical position is the baseline position for the text
        // and every marker is adjusted acording to that.

        // For multiline texts this get more complicated.

        $x1 = $xp + $this->xlmargin;
        $y1 = $yp + $rowheight[0] - $this->ylinespacing + 2; // The ymargin is included in rowheight

        // Now, y1 is the bottom vertical position of the first legend, i.e if
        // the legend has multiple lines it is the bottom line.

        $grad = new Gradient($aImg);
        $patternFactory = null;

        // Now stroke each legend in turn
        // Each plot has added the following information to  the legend
        // p[0] = Legend text
        // p[1] = Color,
        // p[2] = For markers a reference to the PlotMark object
        // p[3] = For lines the line style, for gradient the negative gradient style
        // p[4] = CSIM target
        // p[5] = CSIM Alt text
        $i = 1;
        $row = 0;
        foreach ($this->txtcol as $p) {

            // STROKE DEBUG BOX
            if (_JPG_DEBUG) {
                $aImg->SetLineWeight(1);
                $aImg->SetColor('red');
                $aImg->SetLineStyle('solid');
                $aImg->Rectangle($x1, $y1, $xp + $abs_width - 1, $y1 - $rowheight[$row]);
            }

            $aImg->SetLineWeight($this->weight);
            $x1 = round($x1) + 1; // We add one to not collide with the border
            $y1 = round($y1);

            // This is the center offset up from the baseline which is
            // considered the "center" of the marks. This gets slightly complicated since
            // we need to consider if the text is a multiline paragraph or if it is only
            // a single line. The reason is that for single line the y1 corresponds to the baseline
            // and that is fine. However for a multiline paragraph there is no single baseline
            // and in that case the y1 corresponds to the lowest y for the bounding box. In that
            // case we center the mark in the middle of the paragraph
            if (!preg_match('/\n/', $p[0])) {
                // Single line
                $marky = ceil($y1 - $this->mark_abs_vsize / 2) - 1;
            } else {
                // Paragraph
                $marky = $y1 - $aImg->GetTextHeight($p[0]) / 2;

                //  echo "y1=$y1, p[o]={$p[0]}, marky=$marky<br>";
            }

            //echo "<br>Mark #$i: marky=$marky<br>";

            $x1 += $this->mark_abs_hsize;

            if (!empty($p[2]) && $p[2]->GetType() > -1) {


                // Make a plot mark legend. This is constructed with a mark which
                // is run through with a line

                // First construct a bit of the line that looks exactly like the
                // line in the plot
                $aImg->SetColor($p[1]);
                if (is_string($p[3]) || $p[3] > 0) {
                    $aImg->SetLineStyle($p[3]);
                    $aImg->StyleLine($x1 - $this->mark_abs_hsize, $marky, $x1 + $this->mark_abs_hsize, $marky);
                }

                // Stroke a mark using image
                if ($p[2]->GetType() == MARK_IMG) {
                    $p[2]->Stroke($aImg, $x1, $marky);
                }

                // Stroke a mark with the standard size
                // (As long as it is not an image mark )
                if ($p[2]->GetType() != MARK_IMG) {

                    // Clear any user callbacks since we ont want them called for
                    // the legend marks
                    $p[2]->iFormatCallback = '';
                    $p[2]->iFormatCallback2 = '';

                    // Since size for circles is specified as the radius
                    // this means that we must half the size to make the total
                    // width behave as the other marks
                    if ($p[2]->GetType() == MARK_FILLEDCIRCLE || $p[2]->GetType() == MARK_CIRCLE) {
                        $p[2]->SetSize(min($this->mark_abs_vsize, $this->mark_abs_hsize) / 2);
                        $p[2]->Stroke($aImg, $x1, $marky);
                    } else {
                        $p[2]->SetSize(min($this->mark_abs_vsize, $this->mark_abs_hsize));
                        $p[2]->Stroke($aImg, $x1, $marky);
                    }
                }
            } elseif (!empty($p[2]) && (is_string($p[3]) || $p[3] > 0)) {
                // Draw a styled line
                $aImg->SetColor($p[1]);
                $aImg->SetLineStyle($p[3]);
                $aImg->StyleLine($x1 - $this->mark_abs_hsize, $marky, $x1 + $this->mark_abs_hsize, $marky);
                $aImg->StyleLine($x1 - $this->mark_abs_hsize, $marky + 1, $x1 + $this->mark_abs_hsize, $marky + 1);
            } else {
                // Draw a colored box
                $color = $p[1];

                // We make boxes slightly larger to better show
                $boxsize = max($this->mark_abs_vsize, $this->mark_abs_hsize) + 2;

                $ym = $marky - ceil($boxsize / 2); // Marker y-coordinate

                // We either need to plot a gradient or a
                // pattern. To differentiate we use a kludge.
                // Patterns have a p[3] value of < -100
                if ($p[3] < -100) {
                    // p[1][0] == iPattern, p[1][1] == iPatternColor, p[1][2] == iPatternDensity
                    if ($patternFactory == null) {
                        $patternFactory = new RectPatternFactory();
                    }
                    $prect = $patternFactory->Create($p[1][0], $p[1][1], 1);
                    $prect->SetBackground($p[1][3]);
                    $prect->SetDensity($p[1][2] + 1);
                    $prect->SetPos(new Rectangle($x1, $ym, $boxsize, $boxsize));
                    $prect->Stroke($aImg);
                    $prect = null;
                } else {
                    if (is_array($color) && count($color) == 2) {
                        // The client want a gradient color
                        $grad->FilledRectangle($x1 - $boxsize / 2, $ym,
                            $x1 + $boxsize / 2, $ym + $boxsize,
                            $color[0], $color[1], -$p[3]);
                    } else {
                        $aImg->SetColor($p[1]);
                        $aImg->FilledRectangle($x1 - $boxsize / 2, $ym, $x1 + $boxsize / 2, $ym + $boxsize);
                    }

                    // Draw a plot frame line
                    $aImg->SetColor($this->color);
                    $aImg->SetLineWeight($fillBoxFrameWeight);
                    $aImg->Rectangle($x1 - $boxsize / 2, $ym,
                        $x1 + $boxsize / 2, $ym + $boxsize);
                }
            }
            $aImg->SetColor($this->font_color);
            $aImg->SetFont($this->font_family, $this->font_style, $this->font_size);
            $aImg->SetTextAlign('left', 'baseline');

            $debug = false;
            $aImg->StrokeText($x1 + $this->mark_abs_hsize + $this->xmargin, $y1, $p[0],
                0, 'left', $debug);

            // Add CSIM for Legend if defined
            if (!empty($p[4])) {

                $xs = $x1 - $this->mark_abs_hsize;
                $ys = $y1 + 1;
                $xe = $x1 + $aImg->GetTextWidth($p[0]) + $this->mark_abs_hsize + $this->xmargin;
                $ye = $y1 - $rowheight[$row] + 1;
                $coords = "$xs,$ys,$xe,$y1,$xe,$ye,$xs,$ye";
                if (!empty($p[4])) {
                    $this->csimareas .= "<area shape=\"poly\" coords=\"$coords\" href=\"" . htmlentities($p[4]) . "\"";

                    if (!empty($p[6])) {
                        $this->csimareas .= " target=\"" . $p[6] . "\"";
                    }

                    if (!empty($p[5])) {
                        $tmp = sprintf($p[5], $p[0]);
                        $this->csimareas .= " title=\"$tmp\" alt=\"$tmp\" ";
                    }
                    $this->csimareas .= " />\n";
                }
            }

            if ($i >= $this->layout_n) {
                $x1 = $xp + $this->xlmargin;
                $row++;
                if (!empty($rowheight[$row]))
                    $y1 += $rowheight[$row];
                $i = 1;
            } else {
                $x1 += $colwidth[($i - 1) % $numcolumns];
                ++$i;
            }
        }
    }
} 

