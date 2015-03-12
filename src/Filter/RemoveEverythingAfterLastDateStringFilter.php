<?php
/**
 * Copyright (c)2015-2015 heiglandreas
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIBILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright ©2015-2015 Andreas Heigl
 * @license   http://www.opesource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     12.03.15
 * @link      https://github.com/heiglandreas/org.heigl.daterange
 */
namespace Org_Heigl\DateRange\Filter;

use Org_Heigl\DateRange\DateRangeFilterInterface;

/**
 * This filter removes everything behind the last dateformatting letter
 *
 * @package Org_Heigl\DateRange\Filter
 */
class RemoveEverythingAfterLastDateStringFilter implements DateRangeFilterInterface
{

    /**
     * Filter the incomming string and return the filtered result
     *
     * @param string $string
     *
     * @return string
     */
    public function filter($string)
    {
        $regEx = '/(?<!\\\\)[dDjlNSwzWFmMntLoYyaABgGhHisueIOPTZcrU]/';
        if (! preg_match_all($regEx, $string, $returns, PREG_OFFSET_CAPTURE)) {
            return $string;
        }

        $last = count($returns[0]) - 1;

        return substr($string, 0, $returns[0][$last][1] + 1);
    }
}
