You are given the following task to demonstrate practical code refactoring skills. The `tests` directory contains the tests (surprise) that run in their initial form and they pass correctly. These tests will be the basic tool to control the refactored code. Your task is to refactor the source code - i.e. to make changes that will improve its quality without changing its operation logic. What changes you will introduce, what patterns or good practices you will use - it's up to you. Any improvement in code quality is better than none at all! Remember, however, that at the time of sending back the assignment, all tests must still run correctly.

The task should run in PHP 8.1. The unit tests were written using the phpunit version 9.5 framework and should be run on that. A job description that explains the business logic contained in the class GildedRose.php is below.

## Requirements
- composer
- php 8.1
- phpunit 9.5

## Instalation
To install dependencies run ```composer install```. To run test use ```./vendor/bin/phpunit```.

## Introduction

Hi and welcome to team Gilded Rose. As you know, we are a small inn with a
prime location in a prominent city ran by a friendly innkeeper named Allison.
We also buy and sell only the finest goods. Unfortunately, our goods are
constantly degrading in quality as they approach their sell by date. We have a
system in place that updates our inventory for us. It was developed by a
no-nonsense type named Leeroy, who has moved on to new adventures. Your task is
to add the new feature to our system so that we can begin selling a new
category of items. First an introduction to our system:

- All items have a **SellIn** value which denotes the number of days we have to
sell the item
- All items have a **Quality** value which denotes how valuable the
item is 
- At the end of each day our system lowers both values for every item

Pretty simple, right? Well this is where it gets interesting:

- Once the sell by date has passed, Quality degrades twice as fast 
- The Quality of an item is never negative 
- "**Aged Brie**" actually increases in Quality the older it gets
- The Quality of an item is never more than 50
- "**Sulfuras**", being a legendary item, never has to be sold or decreases in
Quality
- "**Backstage passes**", like aged brie, increases in Quality as it's
SellIn value approaches; Quality increases by 2 when there are 10 days or less
and by 3 when there are 5 days or less but Quality drops to 0 after the concert

Just for clarification, an item can never have its Quality increase above 50, however "Sulfuras" is a legendary 
item and as such its Quality is 80 and it never alters.
