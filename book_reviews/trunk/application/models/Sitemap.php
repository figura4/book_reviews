<?php

class Application_Model_Sitemap {
	private $_sitemap;
	
	public function __construct() {
		$authors = Zend_Registry::get('authorMapper')->fetchAll();
		$books = Zend_Registry::get('contentMapper')->fetchAll(array('type' => 'book', 'published' => '1', 'pubDate' => Zend_Date::now()));
		$movies = Zend_Registry::get('contentMapper')->fetchAll(array('type' => 'movie', 'published' => '1', 'pubDate' => Zend_Date::now()));
		$tvs = Zend_Registry::get('contentMapper')->fetchAll(array('type' => 'tv', 'published' => '1', 'pubDate' => Zend_Date::now()));
		$contents = Zend_Registry::get('contentMapper')->fetchAll(array('type' => 'content', 'published' => '1', 'pubDate' => Zend_Date::now()));
		$currentDate = new Zend_Date();
		
		$container = new Zend_Navigation();
		
		// index
		$homepage = Zend_Navigation_Page::factory(array(
				'label'      => 'Figura4',
				'route'      => 'default',
				'action'     => 'index',
				'controller' => 'index'
		));
		$homepage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
		$homepage->changefreq = 'daily';
		$homepage->priority = 1;
		$container->addPage($homepage);
		
		// Book reviews
		$bookReviewsPage = Zend_Navigation_Page::factory(array(
				'label'      => 'Recensioni libri',
				'route'      => 'bookReviewsList'
		));
		$bookReviewsPage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
		$bookReviewsPage->changefreq = 'daily';
		$bookReviewsPage->priority = 0.9;
		foreach ($books as $book) {
			$bookReviewPage = Zend_Navigation_Page::factory(array(
					'label'      => $book->getTitle(),
					'route'      => 'bookReviews',
					'params'	 => array(
							'id'    => $book->id,
							'title' => $book->urlify('title')
					)
			));
			$bookReviewPage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
			$bookReviewPage->changefreq = 'daily';
			$bookReviewPage->priority = 0.8;
			$bookReviewsPage->addPage($bookReviewPage);
		}
		$container->addPage($bookReviewsPage);

		// Movie reviews
		$movieReviewsPage = Zend_Navigation_Page::factory(array(
				'label'      => 'Recensioni film',
				'route'      => 'movieReviewsList'
		));
		$movieReviewsPage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
		$movieReviewsPage->changefreq = 'daily';
		$movieReviewsPage->priority = 0.9;
		foreach ($movies as $movie) {
			$movieReviewPage = Zend_Navigation_Page::factory(array(
					'label'      => $movie->getTitle(),
					'route'      => 'movieReviews',
					'params'	 => array(
							'id'    => $book->id,
							'title' => $book->urlify()
					)
			));
			$movieReviewPage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
			$movieReviewPage->changefreq = 'daily';
			$movieReviewPage->priority = 0.8;
			$movieReviewsPage->addPage($bookReviewPage);
		}
		$container->addPage($movieReviewsPage);

		// Tv reviews
		$tvReviewsPage = Zend_Navigation_Page::factory(array(
				'label'      => 'Recensioni serie tv',
				'route'      => 'tvReviewsList'
		));
		$tvReviewsPage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
		$tvReviewsPage->changefreq = 'daily';
		$tvReviewsPage->priority = 0.9;
		foreach ($tvs as $tv) {
			$tvReviewPage = Zend_Navigation_Page::factory(array(
					'label'      => $tv->getTitle(),
					'route'      => 'tvReviews',
					'params'	 => array(
							'id'    => $tv->id,
							'title' => $tv->urlify()
					)
			));
			$tvReviewPage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
			$tvReviewPage->changefreq = 'daily';
			$tvReviewPage->priority = 0.8;
			$tvReviewsPage->addPage($bookReviewPage);
		}
		$container->addPage($tvReviewsPage);
		
		// Contents
		$contentsPage = Zend_Navigation_Page::factory(array(
				'label'      => 'Recensioni serie tv',
				'route'      => 'blogHome'
		));
		$contentsPage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
		$contentsPage->changefreq = 'daily';
		$contentsPage->priority = 0.9;
		foreach ($contents as $content) {
			$contentPage = Zend_Navigation_Page::factory(array(
					'label'      => $tv->getTitle(),
					'route'      => 'blog',
					'params'	 => array(
							'id'    => $content->id,
							'title' => $content->urlify()
					)
			));
			$contentPage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
			$contentPage->changefreq = 'daily';
			$contentPage->priority = 0.8;
			$contentsPage->addPage($contentPage);
		}
		$container->addPage($contentsPage);
		
		// Authors
		$authorsPage = Zend_Navigation_Page::factory(array(
				'label'      => 'Authors',
				'route'      => 'authorsList'
		));
		$authorsPage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
		$authorsPage->changefreq = 'daily';
		$authorsPage->priority = 0.9;
		foreach ($authors as $author) {
			$authorPage = Zend_Navigation_Page::factory(array(
					'label'      => $author->getFullName(),
					'route'      => 'authors',
					'params'	 => array(
										'id'    => $author->id,
										'title' => $author->urlify()
									)
			));
			$authorPage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
			$authorPage->changefreq = 'daily';
			$authorPage->priority = 0.8;
			$authorsPage->addPage($authorPage);
		}
		$container->addPage($authorsPage);
		
		$aboutPage = Zend_Navigation_Page::factory(array(
				'label'      => 'About',
				'route'      => 'about',
				'action'     => 'about',
				'controller' => 'index'
		));
		$aboutPage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
		$aboutPage->changefreq = 'daily';
		$aboutPage->priority = 0.8;
		$container->addPage($aboutPage);
		
		$linksPage = Zend_Navigation_Page::factory(array(
				'label'      => 'Links',
				'route'      => 'links',
				'action'     => 'links',
				'controller' => 'index'
		));
		$linksPage->lastmod = $currentDate->get('YYYY-MM-dd HH:mm:ss');
        $linksPage->changefreq = 'weekly';
        $linksPage->priority = 0.9;
		$container->addPage($linksPage);
		
		$this->_sitemap = $container;
	}
	
	public function getSitemap() {
		return $this->_sitemap;
	}
}