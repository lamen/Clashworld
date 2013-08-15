{strip}
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>clashsworld le jeu</title>

<script type="text/javascript" src="/fo/static/LAB.min.js"></script>

{foreach from=$cssfile item=foocss}
{if $foocss|truncate:7:""=='http://'} <link rel="stylesheet" type="text/css" href="{$foocss}">
{else}<link rel="stylesheet" type="text/css" href="/fo/static/{$foocss}">
{/if}
{/foreach}

</head>
<body>

<div id="topban">
<div id="divheader">
<h1>CW</h1>
{if $IsConNeeded eq 0}<p id="logout">deco</p>
{else}<p id="register"><a href="{$urlregister}">{$registertxt}</a></p>
{/if}
</div>
</div>

<br />
{/strip}
