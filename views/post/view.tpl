{include file='partials/header.tpl'}

	<br>

	<a href="{$ROOT_PATH}post/list" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Retour</a>
	<hr>

	<h1>{$post->title}</h1>

	<h3><em>{$post->date|date_format:'d-m-Y H:i:s'}</em></h3>

	<blockquote>
		<p class="well">
			{$post->content|nl2br}
		</p>
	</blockquote>

{include file='partials/footer.tpl'}