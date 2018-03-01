{include file='partials/header.tpl'}

	<h1>Posts</h1>

	{if empty($posts)}
	Aucun post ne correpond à la recherche{if !empty($search)} &laquo; {$search} &raquo;{/if}
	{else}
	<div class="list-group">
		{foreach $posts as $post}
		<a href="{$ROOT_PATH}post/view/{$post->id}" class="list-group-item">
			<h4 class="list-group-item-heading">
				{if !empty($post->picture)}
				<img src="{IMG_HTTP}/post/{$post->picture}" alt="{$post->title}" style="max-height: 32px;">
				{/if}
				{$post->title}
			</h4>
		</a>
		{/foreach}
	</div>
	{/if}

{include file='partials/footer.tpl'}