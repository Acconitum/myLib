<?php
class DomainNameFilter
{

	public $filterName = "niceDomain";


	public function filterDomainName($url)
	{
		$urlParts = parse_url($url);
		return preg_replace('/^www\./', '', $urlParts['host']);
	}
}


public function extendTwig($twig)
{

	$domainNameFilter = new DomainNameFilter();
	$twig->addFilter(new \Twig_SimpleFilter($domainNameFilter->filterName, [$domainNameFilter, 'filterDomainName']));

	return $twig;
}

add_filter('timber/twig', [$this, 'extendTwig']);
