# org.heigl.DateRange

This small library tries to ease printing of date-ranges.

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
    use Org_Heigl\DateRangeFormatter

    $dateRange = new DateRangeFormatter();
    $dateRange->setFormat('d.m.Y');
    $dateRange->setSeparator(' - ');
    echo $dateRange->getDateRange(new \DateTime('12.3.2015'), new \DateTime('13.4.2015'));
    // Will print: 12.3. - 13.4.2014
    ``

More complex example:

    ```php
    <?php
    use Org_Heigl\DateRangeFormatter
    $dateRange = new DateRangeFormatter();
    $dateRange->setFormat('m/d/Y');
    $dateRange->setSeparator(' - ');
    echo $dateRange->getDateRange(new \DateTime('12.3.2015'), new \DateTime('13.3.2015'));
    // Will print: 3/12/ - 3/13/2014
    ```
