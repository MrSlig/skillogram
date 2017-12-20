<?php

class Model_Main extends Model
{
	/* Place, where all posts data proseeds */
	
	/* case 1: posts sorted by date (deafoult) */
	public function get_data()
	{
		$posts  =   CallPostsByDate();	// asking post data by timestamp
		$data   =   postsBlock($posts);

		return  $data;
	}

	/* case 2: posts sorted by rating relevanse (likes) */
	public function get_dataRate()	// case: default
	{
		$posts  =   CallPostsByRate();	// asking post data by rating
		$data   =   postsBlock($posts);

		return  $data;
	}

	/*case 3: posts sorted by search request relevance */
	// 2do: i want to hightlight searched tags, when they are showed on page; mb add class to html code?
	public function get_dataSearch()
    {
		$searchedPosts  =   steppedSearch($_GET['search_tags']); // initiate search

        if ($searchedPosts) {

			$data   =   postsBlock($searchedPosts);
			return  $data;
		}
		// also, notice, that user dont know, which tags we don't have in our sql if one or more tags found
	}
	// also, notice, that we never chek work of function postsBlock()!
}