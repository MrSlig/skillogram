<?php
/**
 * Class Model_Main
 */
class Model_Main extends Model  {
	/* Place, where all posts data proceeds */
	/* case 1: posts sorted by date (default) */
	public function get_data()  {   // overrides method in class core/Model
		$posts  =   CallPostsByDate();	// asking post data by timestamp
		$data   =   postsBlock($posts);
		return  $data;
	}

	/* case 2(default): posts sorted by relevant rating (likes) */
	public function get_dataRate()  {
		$posts  =   CallPostsByRate();	// asking post data by rating
		$data   =   postsBlock($posts);
		return  $data;
	}

	/*case 3: posts sorted by search request relevance */
	// 2do: i want to hightlight searched tags, when they are showed on page; mb add class to html code?
	public function get_dataSearch()    {
		$searchedPosts  =   steppedSearch($_GET['search_tags']); // initiate search
        if ($searchedPosts) {
			$data   =   postsBlock($searchedPosts);
			return  $data;
		}
		// also, notice, that user don't know, which tags we don't have in our sql if one or more tags found
	}
	// also, notice, that we never check work of function postsBlock()!
}