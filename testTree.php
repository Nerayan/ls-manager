<!doctype html>
<html style='font-size:16px;'>
<head>
	<style>
	.treeview ul, .treeview li {
		padding: 0;
		margin: 0;
		list-style: none;
	}
	.treeview input {
		position: absolute;
		opacity: 0;
	}
	.treeview {
		font: normal 11px "Segoe UI", Arial, Sans-serif;
		/*-moz-user-select: none;
		//-webkit-user-select: none;*/
		user-select: none;
	}
		.treeview a {
			color: #00f;
			text-decoration: none;
		}
	.treeview a:hover		{ text-decoration: underline;	}
	.treeview input + label + ul	{ margin: 0 0 0 22px; }
	.treeview input ~ ul		{ display: none; }
	.treeview label,
	.treeview label::before	{ cursor: pointer; }
	.treeview input:disabled + label {
		cursor: default;
		opacity: .6;
	}
	.treeview input:checked:not(:disabled) ~ ul {
		display: block;
	}
	.treeview label,
	.treeview label::before {
		background: url("tree-icons.png") no-repeat;
	}
	.treeview label,
	.treeview a,
	.treeview label::before {
		display: inline-block;
		height: 16px;
		line-height: 16px;
		vertical-align: middle;
	}
	.treeview label	{
		background-position: 18px 0;
	}
	.treeview label::before {
		content: "";
		width: 16px;
		margin: 0 22px 0 0;
		vertical-align: middle;
		background-position: 0 -32px;
	}
	.treeview input:checked + label::before {
		background-position: 0 -16px;
	}

	</style>


</head>
<body>
<a href="http://experiments.wemakesites.net/css3-treeview.html"> test from</a>
<a href="https://myrusakov.ru/php-menu-tree.html">PHP-Forming</a>
<div class='treeview'>
<ul>
    <li><input type="checkbox" id="item-D-1"/> <label for="item-D-1"> DESKTOP (li-input is Folder)</label>
	<ul>
	    <li><input type="checkbox" id="item-f-1"/> <label for="item-f-1"> li-input is Folder (Closed by Def)</label>
		<ul>
		    <li><a>1-1</a></li>
		    <li><a>1-2</a></li>
		</ul>
	    </li>
	
	    <li><input type='checkbox' id='item-f-2' checked='checked'/> <label for="item-f-2"> ul-input is Folder (Open by Def)</label>
		<ul>
		    <li>2-1</li>
		    <li>2-2</li>
		</ul>
	    </li>
	</ul>
    </li>
</ul>
</div>
</body>
<?php
?>