<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use FunctionalTester;

class HomeCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
		$I->amOnPage('/');
		$I->see('Moduli – Un nuovo sito targato WordPress');
    }
}
