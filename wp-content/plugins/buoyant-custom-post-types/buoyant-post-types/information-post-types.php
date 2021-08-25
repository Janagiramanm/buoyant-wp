<?php

function setup_info_post_type() {
	register_post_type("information_pages", [
		"label" => "Information Overview",
		"labels" => [
			"name" => "Information Overview",
			"singular_name" => "Information",
			"add_new_item" => "Add new Information overview",
			"edit_item" => "Edit Information overview",
			"view_item" => "View Information overview",
			"view_items" => "View Information overview",
			"search_items" => "Search Information overview",
			"not_found" => "No Information overview found",
			"all_items" => "All Information overview",
			"archives" => "Information overview archives"
		],
		"description" => "Information overview provided by Netiapps",
		"public" => true,
		'has_archive' => true,
		"show_in_rest" => true,
		"menu_icon" => "dashicons-editor-kitchensink",
		"rewrite" => [
			"slug" => "information_pages"
		],
		"supports" => [
			"title", "editor", "revisions", "author", "excerpt", "page_attributes","thumbnail"
		],
	]);
}

add_action("init", "setup_info_post_type");