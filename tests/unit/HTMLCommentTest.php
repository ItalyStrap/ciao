<?php

class HTMLCommentTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
    	$tag = new \ItalyStrap\HTML\Tag( new \ItalyStrap\HTML\Attributes() );

//    	$tag->open('','', [''] );


//		<!-- wp:paragraph -->
//			<p><a href="https://coblocks.com/?utm_medium=wp.org&amp;utm_source=wordpressorg&amp;utm_campaign=readme&amp;utm_content=coblocks">CoBlocks</a> is a collection of page builder Gutenberg blocks for content marketers, built by <a href="https://richtabor.com">Rich Tabor</a> from <a href="https://themebeans.com/?utm_medium=wp.org&amp;utm_source=wordpressorg&amp;utm_campaign=readme&amp;utm_content=coblocks">ThemeBeans</a>. If you are a fan, consider <a href="https://wordpress.org/plugins/coblocks/#reviews">leaving a review</a> on WordPress.org. 🙏</p>
//			<!-- /wp:paragraph -->

    }

	private function openComment() {
		return \sprintf(
			'<!-- wp:paragraph -->'
		);
    }

	private function closeComment() {
		return \sprintf(
			'<!-- /wp:paragraph -->'
		);
    }
}