{include file='partials/header.tpl'}

	<br>

	<a href="{$ROOT_PATH}post/list" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Retour</a>
	<hr>

	<div class="row">
		<div class="col-xs-6 col-md-3">
			{if !empty($post->picture)}
			<a href="{IMG_HTTP}/post/{$post->picture}" class="thumbnail" target="_blank">
				<img src="{IMG_HTTP}/post/{$post->picture}" alt="{$post->title}">
			</a>
			{/if}
		</div>
		<div class="col-xs-6 col-md-9">
			<h1>{$post->title}</h1>

			<h3><em>{$post->date|date_format:'d-m-Y H:i:s'}</em></h3>

			<blockquote>
				<p class="well">
					{$post->content|nl2br}
				</p>
			</blockquote>
		</div>
	</div>

{include file='partials/footer.tpl'}