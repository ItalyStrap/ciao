<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use FunctionalTester;

class HomeCest
{
    public function _before(FunctionalTester $I)
    {
    	$I->havePageInDatabase([
    		'post_name'	=> 'Home',
    		'post_content'	=> 'Home page of the site',
		]);

    	$I->amOnPage( '/home' );
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
		$I->amOnPage('/');
		$I->see('Moduli – Un nuovo sito targato WordPress');

//		$I->seeElement('/html/body/div[2]/div[2]/main/ul/li[1]/article');

    }

    // tests
    public function tryToTest2(FunctionalTester $I)
    {
//		$I->seeInThemeFile('ciao/block-templates/index.html', 'wp:template-part');
    }
}
