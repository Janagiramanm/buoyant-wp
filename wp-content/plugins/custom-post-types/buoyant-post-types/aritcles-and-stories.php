<?php

function setup_article_stories_post_type() {
	register_post_type("articles-stories", [
		"label" => "Articles Stories Overview",
		"labels" => [
			"name" => "Articles Overview",
			"singular_name" => "Article",
			"add_new_item" => "Add new Article overview",
			"edit_item" => "Edit Article overview",
			"view_item" => "View Article overview",
			"view_items" => "View Article overview",
			"search_items" => "Search Article overview",
			"not_found" => "No Article overview found",
			"all_items" => "All Article overview",
			"archives" => "Article overview archives"
		],
		"description" => "Articles and Stories overview provided by Netiapps",
		"public" => true,
		'has_archive' => true,
		"show_in_rest" => true,
		"menu_icon" => "dashicons-portfolio",
		"rewrite" => [
			"slug" => "articles-stories"
		],
		"supports" => [
			"title", "editor", "revisions", "author", "excerpt", "page_attributes","thumbnail"
		],
	]);
}

add_action("init", "setup_article_stories_post_type");