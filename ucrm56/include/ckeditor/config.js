/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.font_names='宋体/宋体;黑体/黑体;仿宋/仿宋_GB2312;楷体/楷体_GB2312;隶书/隶书;幼圆/幼圆;微软雅黑/微软雅黑;'+ config.font_names;

	CKEDITOR.config.toolbar_Vtiger =
	[
		['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
		['NumberedList','BulletedList','-','Outdent','Indent'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['Link','Unlink','Anchor'],
		['Source','-','NewPage','Preview','Templates'],
		'/',
		['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker'],
		['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
		['Image','Table','HorizontalRule','SpecialChar','PageBreak','TextColor','BGColor'], //,'Smiley','UniversalKey'],
		'/',
		['Styles','Format','Font','FontSize']
	];
	CKEDITOR.config.toolbar = 'Vtiger';
	CKEDITOR.config.height = '320';
};
