<?php

// image smooth arc
/**
 * @param $img
 * @param $cx
 * @param $cy
 * @param $a
 * @param $b
 * @param $aaAngleX
 * @param $aaAngleY
 * @param $color
 * @param $start
 * @param $stop
 * @param $seg
 */
function imageSmoothArcDrawSegment(&$img, $cx, $cy, $a, $b, $aaAngleX, $aaAngleY, $color, $start, $stop, $seg)
{
    // Originally written from scratch by Ulrich Mierendorff, 06/2006
    // Rewritten and improved, 04/2007, 07/2007

    // Please do not use THIS function directly. Scroll down to imageSmoothArc(...).

    $fillColor = imageColorExactAlpha($img, $color[0], $color[1], $color[2], $color[3]);

    $xStart = abs($a * cos($start));
    $yStart = abs($b * sin($start));
    $xStop = abs($a * cos($stop));
    $yStop = abs($b * sin($stop));
    $dxStart = 0;
    $dyStart = 0;
    $dxStop = 0;
    $dyStop = 0;
    if ($xStart != 0)
        $dyStart = $yStart / $xStart;
    if ($xStop != 0)
        $dyStop = $yStop / $xStop;
    if ($yStart != 0)
        $dxStart = $xStart / $yStart;
    if ($yStop != 0)
        $dxStop = $xStop / $yStop;
    if (abs($xStart) >= abs($yStart)) {
        $aaStartX = true;
    } else {
        $aaStartX = false;
    }
    if ($xStop >= $yStop) {
        $aaStopX = true;
    } else {
        $aaStopX = false;
    }

    for ($x = 0; $x < $a; $x += 1) {

        $_y1 = $dyStop * $x;
        $_y2 = $dyStart * $x;
        if ($xStart > $xStop) {
            $error1 = $_y1 - (int)($_y1);
            $error2 = 1 - $_y2 + (int)$_y2;
            $_y1 = $_y1 - $error1;
            $_y2 = $_y2 + $error2;
        } else {
            $error1 = 1 - $_y1 + (int)$_y1;
            $error2 = $_y2 - (int)($_y2);
            $_y1 = $_y1 + $error1;
            $_y2 = $_y2 - $error2;
        }


        if ($seg == 0 || $seg == 2) {
            $i = $seg;
            if (!($start > $i * M_PI / 2 && $x > $xStart)) {
                if ($i == 0) {
                    $xp = +1;
                    $yp = -1;
                    $xa = +1;
                    $ya = 0;
                } else {
                    $xp = -1;
                    $yp = +1;
                    $xa = 0;
                    $ya = +1;
                }
                if ($stop < ($i + 1) * (M_PI / 2) && $x <= $xStop) {
                    $diffColor1 = imageColorExactAlpha($img, $color[0], $color[1], $color[2], 127 - (127 - $color[3]) * $error1);
                    $y1 = $_y1;
                    if ($aaStopX) imageSetPixel($img, $cx + $xp * ($x) + $xa, $cy + $yp * ($y1 + 1) + $ya, $diffColor1);

                } else {
                    $y = $b * sqrt(1 - ($x * $x) / ($a * $a));
                    $error = $y - (int)($y);
                    $y = (int)($y);
                    $diffColor = imageColorExactAlpha($img, $color[0], $color[1], $color[2], 127 - (127 - $color[3]) * $error);
                    $y1 = $y;
                    if ($x < $aaAngleX) imageSetPixel($img, $cx + $xp * $x + $xa, $cy + $yp * ($y1 + 1) + $ya, $diffColor);
                }
                if ($start > $i * M_PI / 2 && $x <= $xStart) {
                    $diffColor2 = imageColorExactAlpha($img, $color[0], $color[1], $color[2], 127 - (127 - $color[3]) * $error2);
                    $y2 = $_y2;
                    if ($aaStartX) imageSetPixel($img, $cx + $xp * $x + $xa, $cy + $yp * ($y2 - 1) + $ya, $diffColor2);
                } else {
                    $y2 = 0;
                }
                if ($y2 <= $y1) imageLine($img, $cx + $xp * $x + $xa, $cy + $yp * $y1 + $ya, $cx + $xp * $x + $xa, $cy + $yp * $y2 + $ya, $fillColor);
            }
        }

        if ($seg == 1 || $seg == 3) {
            $i = $seg;
            if (!($stop < ($i + 1) * M_PI / 2 && $x > $xStop)) {
                if ($i == 1) {
                    $xp = -1;
                    $yp = -1;
                    $xa = 0;
                    $ya = 0;
                } else {
                    $xp = +1;
                    $yp = +1;
                    $xa = 1;
                    $ya = 1;
                }
                if ($start > $i * M_PI / 2 && $x < $xStart) {
                    $diffColor2 = imageColorExactAlpha($img, $color[0], $color[1], $color[2], 127 - (127 - $color[3]) * $error2);
                    $y1 = $_y2;
                    if ($aaStartX) imageSetPixel($img, $cx + $xp * $x + $xa, $cy + $yp * ($y1 + 1) + $ya, $diffColor2);

                } else {
                    $y = $b * sqrt(1 - ($x * $x) / ($a * $a));
                    $error = $y - (int)($y);
                    $y = (int)$y;
                    $diffColor = imageColorExactAlpha($img, $color[0], $color[1], $color[2], 127 - (127 - $color[3]) * $error);
                    $y1 = $y;
                    if ($x < $aaAngleX) imageSetPixel($img, $cx + $xp * $x + $xa, $cy + $yp * ($y1 + 1) + $ya, $diffColor);
                }
                if ($stop < ($i + 1) * M_PI / 2 && $x <= $xStop) {
                    $diffColor1 = imageColorExactAlpha($img, $color[0], $color[1], $color[2], 127 - (127 - $color[3]) * $error1);
                    $y2 = $_y1;
                    if ($aaStopX) imageSetPixel($img, $cx + $xp * $x + $xa, $cy + $yp * ($y2 - 1) + $ya, $diffColor1);
                } else {
                    $y2 = 0;
                }
                if ($y2 <= $y1) imageLine($img, $cx + $xp * $x + $xa, $cy + $yp * $y1 + $ya, $cx + $xp * $x + $xa, $cy + $yp * $y2 + $ya, $fillColor);
            }
        }
    }


    for ($y = 0; $y < $b; $y += 1) {

        $_x1 = $dxStop * $y;
        $_x2 = $dxStart * $y;
        if ($yStart > $yStop) {
            $error1 = $_x1 - (int)($_x1);
            $error2 = 1 - $_x2 + (int)$_x2;
            $_x1 = $_x1 - $error1;
            $_x2 = $_x2 + $error2;
        } else {
            $error1 = 1 - $_x1 + (int)$_x1;
            $error2 = $_x2 - (int)($_x2);
            $_x1 = $_x1 + $error1;
            $_x2 = $_x2 - $error2;
        }


        if ($seg == 0 || $seg == 2) {
            $i = $seg;
            if (!($start > $i * M_PI / 2 && $y > $yStop)) {
                if ($i == 0) {
                    $xp = +1;
                    $yp = -1;
                    $xa = 1;
                    $ya = 0;
                } else {
                    $xp = -1;
                    $yp = +1;
                    $xa = 0;
                    $ya = 1;
                }
                if ($stop < ($i + 1) * (M_PI / 2) && $y <= $yStop) {
                    $diffColor1 = imageColorExactAlpha($img, $color[0], $color[1], $color[2], 127 - (127 - $color[3]) * $error1);
                    $x1 = $_x1;
                    if (!$aaStopX) imageSetPixel($img, $cx + $xp * ($x1 - 1) + $xa, $cy + $yp * ($y) + $ya, $diffColor1);
                }
                if ($start > $i * M_PI / 2 && $y < $yStart) {
                    $diffColor2 = imageColorExactAlpha($img, $color[0], $color[1], $color[2], 127 - (127 - $color[3]) * $error2);
                    $x2 = $_x2;
                    if (!$aaStartX) imageSetPixel($img, $cx + $xp * ($x2 + 1) + $xa, $cy + $yp * ($y) + $ya, $diffColor2);
                } else {
                    $x = $a * sqrt(1 - ($y * $y) / ($b * $b));
                    $error = $x - (int)($x);
                    $x = (int)($x);
                    $diffColor = imageColorExactAlpha($img, $color[0], $color[1], $color[2], 127 - (127 - $color[3]) * $error);
                    $x1 = $x;
                    if ($y < $aaAngleY && $y <= $yStop) imageSetPixel($img, $cx + $xp * ($x1 + 1) + $xa, $cy + $yp * $y + $ya, $diffColor);
                }
            }
        }

        if ($seg == 1 || $seg == 3) {
            $i = $seg;
            if (!($stop < ($i + 1) * M_PI / 2 && $y > $yStart)) {
                if ($i == 1) {
                    $xp = -1;
                    $yp = -1;
                    $xa = 0;
                    $ya = 0;
                } else {
                    $xp = +1;
                    $yp = +1;
                    $xa = 1;
                    $ya = 1;
                }
                if ($start > $i * M_PI / 2 && $y < $yStart) {
                    $diffColor2 = imageColorExactAlpha($img, $color[0], $color[1], $color[2], 127 - (127 - $color[3]) * $error2);
                    $x1 = $_x2;
                    if (!$aaStartX) imageSetPixel($img, $cx + $xp * ($x1 - 1) + $xa, $cy + $yp * $y + $ya, $diffColor2);
                }
                if ($stop < ($i + 1) * M_PI / 2 && $y <= $yStop) {
                    $diffColor1 = imageColorExactAlpha($img, $color[0], $color[1], $color[2], 127 - (127 - $color[3]) * $error1);
                    $x2 = $_x1;
                    if (!$aaStopX) imageSetPixel($img, $cx + $xp * ($x2 + 1) + $xa, $cy + $yp * $y + $ya, $diffColor1);
                } else {
                    $x = $a * sqrt(1 - ($y * $y) / ($b * $b));
                    $error = $x - (int)($x);
                    $x = (int)($x);
                    $diffColor = imageColorExactAlpha($img, $color[0], $color[1], $color[2], 127 - (127 - $color[3]) * $error);
                    $x1 = $x;
                    if ($y < $aaAngleY && $y < $yStart) imageSetPixel($img, $cx + $xp * ($x1 + 1) + $xa, $cy + $yp * $y + $ya, $diffColor);
                }
            }
        }
    }
}


/**
 * @param $img
 * @param $cx
 * @param $cy
 * @param $w
 * @param $h
 * @param $color
 * @param $start
 * @param $stop
 */
function imageSmoothArc(&$img, $cx, $cy, $w, $h, $color, $start, $stop)
{
    // Originally written from scratch by Ulrich Mierendorff, 06/2006
    // Rewritten and improved, 04/2007, 07/2007
    // compared to old version:
    // + Support for transparency added
    // + Improved quality of edges & antialiasing

    // note: This function does not represent the fastest way to draw elliptical
    // arcs. It was written without reading any papers on that subject. Better
    // algorithms may be twice as fast or even more.

    // what it cannot do: It does not support outlined arcs, only filled

    // Parameters:
    // $cx      - Center of ellipse, X-coord
    // $cy      - Center of ellipse, Y-coord
    // $w       - Width of ellipse ($w >= 2)
    // $h       - Height of ellipse ($h >= 2 )
    // $color   - Color of ellipse as a four component array with RGBA
    // $start   - Starting angle of the arc, no limited range!
    // $stop    - Stop     angle of the arc, no limited range!
    // $start _can_ be greater than $stop!
    // If any value is not in the given range, results are undefined!

    // This script does not use any special algorithms, everything is completely
    // written from scratch; see http://de.wikipedia.org/wiki/Ellipse for formulas.

    while ($start < 0) {
        $start += 2 * M_PI;
    }
    while ($stop < 0) {
        $stop += 2 * M_PI;
    }

    while ($start > 2 * M_PI) {
        $start -= 2 * M_PI;
    }

    while ($stop > 2 * M_PI) {
        $stop -= 2 * M_PI;
    }


    if ($start > $stop) {
        imageSmoothArc($img, $cx, $cy, $w, $h, $color, $start, 2 * M_PI);
        imageSmoothArc($img, $cx, $cy, $w, $h, $color, 0, $stop);
        return;
    }

    $a = 1.0 * round($w / 2);
    $b = 1.0 * round($h / 2);
    $cx = 1.0 * round($cx);
    $cy = 1.0 * round($cy);

    $aaAngle = atan(($b * $b) / ($a * $a) * tan(0.25 * M_PI));
    $aaAngleX = $a * cos($aaAngle);
    $aaAngleY = $b * sin($aaAngle);

    $a -= 0.5; // looks better...
    $b -= 0.5;

    for ($i = 0; $i < 4; $i++) {
        if ($start < ($i + 1) * M_PI / 2) {
            if ($start > $i * M_PI / 2) {
                if ($stop > ($i + 1) * M_PI / 2) {
                    imageSmoothArcDrawSegment($img, $cx, $cy, $a, $b, $aaAngleX, $aaAngleY, $color, $start, ($i + 1) * M_PI / 2, $i);
                } else {
                    imageSmoothArcDrawSegment($img, $cx, $cy, $a, $b, $aaAngleX, $aaAngleY, $color, $start, $stop, $i);
                    break;
                }
            } else {
                if ($stop > ($i + 1) * M_PI / 2) {
                    imageSmoothArcDrawSegment($img, $cx, $cy, $a, $b, $aaAngleX, $aaAngleY, $color, $i * M_PI / 2, ($i + 1) * M_PI / 2, $i);
                } else {
                    imageSmoothArcDrawSegment($img, $cx, $cy, $a, $b, $aaAngleX, $aaAngleY, $color, $i * M_PI / 2, $stop, $i);
                    break;
                }
            }
        }
    }
}


// jpgraph

/**
 * @param $aMinVersion
 * @return bool
 */
function CheckPHPVersion($aMinVersion)
{
    list($majorC, $minorC, $editC) = preg_split('/[\/.-]/', PHP_VERSION);
    list($majorR, $minorR, $editR) = preg_split('/[\/.-]/', $aMinVersion);

    if ($majorC < $majorR) return false;

    if ($majorC == $majorR) {
        if ($minorC < $minorR) return false;

        if ($minorC == $minorR) {
            if ($editC < $editR) return false;
        }
    }

    return true;
}

/**
 * @param $errno
 * @param $errmsg
 * @param $filename
 * @param $linenum
 * @param $vars
 * @throws JpGraphExceptionL
 */
function _phpErrorHandler($errno, $errmsg, $filename, $linenum, $vars)
{
    // Respect current error level
    if ($errno & error_reporting()) {
        JpGraphError::RaiseL(25003, basename($filename), $linenum, $errmsg);
    }
}

/**
 * @param $a
 * @return int
 */
function sign($a)
{
    return $a >= 0 ? 1 : -1;
}

/**
 * Utility function to generate an image name based on the filename we
 * are running from and assuming we use auto detection of graphic format
 * (top level), i.e it is safe to call this function
 * from a script that uses JpGraph
 *
 *
 * @return string
 * @throws JpGraphExceptionL
 */
function GenImgName()
{
    // Determine what format we should use when we save the images
    $supported = imagetypes();
    if ($supported & IMG_PNG) $img_format = "png";
    elseif ($supported & IMG_GIF) $img_format = "gif";
    elseif ($supported & IMG_JPG) $img_format = "jpeg";
    elseif ($supported & IMG_WBMP) $img_format = "wbmp";
    elseif ($supported & IMG_XPM) $img_format = "xpm";


    if (!isset($_SERVER['PHP_SELF'])) {
        JpGraphError::RaiseL(25005);
        //(" Can't access PHP_SELF, PHP global variable. You can't run PHP from command line if you want to use the 'auto' naming of cache or image files.");
    }
    $fname = basename($_SERVER['PHP_SELF']);
    if (!empty($_SERVER['QUERY_STRING'])) {
        $q = @$_SERVER['QUERY_STRING'];
        $fname .= '_' . preg_replace("/\W/", "_", $q) . '.' . $img_format;
    } else {
        $fname = substr($fname, 0, strlen($fname) - 4) . '.' . $img_format;
    }
    return $fname;
}

// gant
if (!function_exists('array_fill')) {
    function array_fill($iStart, $iLen, $vValue)
    {
        $aResult = array();
        for ($iCount = $iStart; $iCount < $iLen + $iStart; $iCount++) {
            $aResult[$iCount] = $vValue;
        }
        return $aResult;
    }
}

// mesh interpolate
function doMeshInterpolate(&$aData, $aFactor)
{
    $m = new MeshInterpolate();
    $aData = $m->Linear($aData, $aFactor);
}

