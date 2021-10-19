<?php

function setup_faq_post_type() {
	register_post_type("faq_pages", [
		"label" => "FAQ",
		"labels" => [
			"name" => "FAQ Overview",
			"singular_name" => "faq",
			"add_new_item" => "Add new FAQ",
			"edit_item" => "Edit FAQ",
			"view_item" => "View FAQ",
			"view_items" => "View FAQ",
			"search_items" => "Search FAQ",
			"not_found" => "No FAQ found",
			"all_items" => "All FAQ",
			"archives" => "FAQ archives"
		],
		"description" => "FAQ provided by Netiapps",
		"public" => true,
		'has_archive' => true,
		"show_in_rest" => true,
		"menu_icon" => "dashicons-tickets",
		"rewrite" => [
			"slug" => "faq_pages"
		],
		"supports" => [
			"title", "editor", "revisions", "author", "excerpt", "page_attributes","thumbnail"
		],
	]);
}

add_action("init", "setup_faq_post_type");