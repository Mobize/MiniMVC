{include file='partials/header.tpl'}

	<h1>Posts</h1>

	{if empty($posts)}
	Aucun post ne correpond à la recherche{if !empty($search)} &laquo; {$search} &raquo;{/if}
	{else}
	<div class="list-group">
		{foreach $posts as $post}
		<a href="{$ROOT_PATH}post/view/{$post->id}" class="list-group-item">{$post->title}</a>
		{/foreach}
	</di>
	{/if}

{include file='partials/footer.tpl'}