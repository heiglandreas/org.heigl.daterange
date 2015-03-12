# org.heigl.DateRange

This small library tries to ease printing of date-ranges.

[![Build Status](https://travis-ci.org/heiglandreas/org.heigl.daterange.svg?branch=master)](https://travis-ci.org/heiglandreas/org.heigl.daterange)
[![Code Climate](https://codeclimate.com/github/heiglandreas/org.heigl.daterange/badges/gpa.svg)](https://codeclimate.com/github/heiglandreas/org.heigl.daterange)
[![Test Coverage](https://codeclimate.com/github/heiglandreas/org.heigl.daterange/badges/coverage.svg)](https://codeclimate.com/github/heiglandreas/org.heigl.daterange)
[![Coverage Status](https://coveralls.io/repos/heiglandreas/org.heigl.daterange/badge.svg?branch=master)](https://coveralls.io/r/heiglandreas/org.heigl.daterange?branch=master)

## Installation

Installation is easy via composer. Simply type this in your terminal to add the
DateRange-Library to your ```composer.conf```-file:

    composer require org_heigl/daterange


## Usage

You can then use the DateRange library by creating a DateRange-instance,
setting a format and a separator and then simply calling ```getDateRange()```
with the start-date and the end date as parameters.

Simple example:

```php
<?php
use Org_Heigl\DateRange\DateRangeFormatter

$dateRange = new DateRangeFormatter();
$dateRange->setFormat('d.m.Y');
$dateRange->setSeparator(' - ');
echo $dateRange->getDateRange(new \DateTime('12.3.2015'), new \DateTime('13.4.2015'));
// Will print: 12.03. - 13.04.2014
echo $dateRange->getDateRange(new \DateTime('12.3.2015'), new \DateTime('13.3.2015'));
// Will print: 12. - 13.03.2014
```

More complex example:

```php
<?php
use Org_Heigl\DateRange\DateRangeFormatter

$dateRange = new DateRangeFormatter();
$dateRange->setFormat('m/d/Y');
$dateRange->setSeparator(' - ');
echo $dateRange->getDateRange(new \DateTime('12.3.2015'), new \DateTime('13.3.2015'));
// Will print: 3/12/ - 3/13/2014
```

You want to change parts of the date-formatting string? Try the Filters.

If you want to display something like **12 - 13.03.2013** (node the missing dot after the 12)
you can use the formatting-string ```d.m.Y``` and add a ```RemoveEverythingAfterLastDateStringFilter```
lik this:

```php
<?php
use Org_Heigl\DateRange\DateRangeFormatter;
use Org_Heigl\DateRange\Filter\RemoveEverythingAfterLastDateStringFilter;

$dateRange = new DateRangeFormatter();
$dateRange->setFormat('d.m.Y');
$dateRange->setSeparator(' - ');
$dateRange->addFilter(new RemoveEverythingAfterLastDateStringFilter(), DateRangeFormatter::FILTER_FIRST_DIFF);
echo $dateRange->getDateRange(new \DateTime('12.3.2015'), new \DateTime('13.3.2015'));
// Will print: 12 - 13.03.2014
```

Currently the following Filters are available:

* **RemoveEverythingAfterLastDateStringFilter** - This filter will remove everything
  after the last dateformatting-character in the given date-part. So when the
  dateformatting-string reads ```d.m.``` it will remove everything behind the
  ```m``` which is the last dateformatting-character.
* **TrimFilter** - This filter will remove excess whitespace. It just passes the
  dateformatting-string through the ```trim``-function.

You can implement your own filter by simply implementing the ```Org_Heigl\DateRange\DateRangeFilterInterface```
That way evertything is possible!

You can add a filter to four different filterchains that filter different parts
of the formatting string.

* **DateRangeFormatter::FILTER_COMPLETE** will be applied to a formatting string
  when first and second day are the same. So the input will be the formatting-string
  you provided via the ```DateRangeFormatter::setFormat()```.
* **DateRangeFormatter::FILTER_FIRST_DIFF** will be applied to the first part of
  the splitted formatting string that is used for the start-date. So when your
  formatting string is ```d.m.Y``` and the dates differ in the month the filter
  will be applied to ```d.m.``` for the starting date
* **DateRangeFormatter::FILTER_SECOND_DIFF** will be applied to the first part of
  the splitted formatting string that is used for the end-date. So when your
  formatting-string is ```d.m.Y``` and the dates differ in the month the filter
  will be applied to ```d.m.``` for the end-date
* **DateRangeFormatter::FILTER_SAME** will be applied to the second part of the
  splitted formatting string that is used for the part that is equal on start-
  and end-date. So when your formatting-string is ```d.m.Y``` and the dates
  differ in the day the filter will be applied to ```m.Y```.
