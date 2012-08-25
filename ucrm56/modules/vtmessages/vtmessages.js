/*+*******************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ******************************************************************************/
var vtmessages = {
	progressbar : function(flag) {
		var statusdiv = $('status');
		if(statusdiv) {
			if(flag) statusdiv.show();
			else statusdiv.hide();
		}
	},
	screenblock : function(flag) {
		
		if(flag) {
			VtigerJS_DialogBox.block();
			vtmessages.progressbar(true);
		}
		else {
			VtigerJS_DialogBox.unblock();
			vtmessages.progressbar(false);
		}
	},
	scrapnew : function(node, tousername, tousers) {
		$('vtmessages_new_area').show();
		posLay(node, 'vtmessages_new_area');
		$('vtmessages_new_toname').innerHTML = tousername;

		var activeform = document.forms['vtmessages_new_form'];
		activeform['subject'].value = '';
		activeform['message'].value = '';
		activeform['_tousers'].value = tousers;
		activeform.message.focus();
	},
	scrapnew_hide : function() {
		$('vtmessages_new_area').hide();
	},
	scrapnew_toselected : function(node, form, totitle, LBL_ATLEAST_SELECTONE_USER) {
		var userids = form.userid;
		var tousers = '';
		// Single user selection
		if(typeof(userids.value) != 'undefined') tousers = userids.value;
		else { 
			// Multi user selection
			for(var idx=0; idx < userids.length; ++idx) {
				if(userids[idx].checked) {
					tousers += userids[idx].value;
					if(idx != userids.length-1) tousers += ',';
				}
			}
		}
		if(tousers == '') { alert(LBL_ATLEAST_SELECTONE_USER); return false; }
		vtmessages.scrapnew(node, totitle, tousers);
	},
	scrapnow : function(node, form) {
		var subject = form.subject.value;
		var content = form.message.value;

		if(content == '') { form.message.focus(); return false; }

		var url = 'module=vtmessages&action=vtmessagesAjax&ajax=true&messagemode=New&file=MessageSave';
		url += '&subject=' + encodeURIComponent(subject);
		url += '&message=' + encodeURIComponent(content);
		url += '&vtmsgstatus=' + encodeURIComponent('Unread');
		url += '&topicstart=' + 1;
		url += '&_tousers=' + form['_tousers'].value;

		vtmessages.screenblock(true);
		new Ajax.Request(
        	'index.php',
            {queue: {position: 'end', scope: 'command'},
            	method: 'post',
                postBody:url,
                onComplete: function(response) {
                	var str = response.responseText;
					vtmessages.scrapnew_hide();					
					vtmessages.reloadnow();
				}
			}
		);
	},
	scrapreply : function(node, useprefix, title, messageid) {
		$('vtmessages_reply_area').show();
		posLay(node, 'vtmessages_reply_area');
		if(title != '') {
			$('vtmessages_replyto_title').innerHTML = useprefix + '&nbsp;' + title;
		}

		var activeform = document.forms['vtmessages_reply_form'];
		activeform['message'].value = '';
		activeform['messageid'].value = messageid;
		activeform.message.focus();
	},
	scrapreply_hide : function() {
		$('vtmessages_reply_area').hide();
	},
	replynow : function(node, form) {
		var content = form.message.value;
		if(content == '') return false;

		var url = 'module=vtmessages&action=vtmessagesAjax&ajax=true&messagemode=Reply&file=MessageSave';
		url += '&message=' + encodeURIComponent(content);
		url += '&vtmsgstatus=' + encodeURIComponent('Unread');
		url += '&record=' + form['messageid'].value;

		vtmessages.screenblock(true);
		new Ajax.Request(
        	'index.php',
            {queue: {position: 'end', scope: 'command'},
            	method: 'post',
                postBody:url,
                onComplete: function(response) {
                	var str = response.responseText;
					vtmessages.scrapreply_hide();
					vtmessages.reloadnow();
				}
			}
		);
	},
	reloadnow : function() {
		vtmessages.screenblock(true);

		// Are we in listview? reload the selected filter
		if($('viewname')) {
			$('viewname').onchange();
			vtmessages.screenblock(false);
		} else {
			// We are in Detailview, do ajax fetch
			vtmessages.reloadtopic();
		}
	},
	reloadtopic : function() {
		var loc = location.href;
		var cur_module = loc.match(/module=([^&]+)/)[1];
		var cur_action = loc.match(/action=([^&]+)/)[1];
		var cur_record = loc.match(/record=([^&]+)/)[1];

		var url = 'module='+cur_module + '&action=vtmessagesAjax&ajax=true&file='+cur_action+'&record='+cur_record;
		
		new Ajax.Request(
       	'index.php',
           {queue: {position: 'end', scope: 'command'},
           	method: 'post',
               postBody:url,
               onComplete: function(response) {
               	var str = response.responseText;
				if($('ListViewContents')) {
					$('ListViewContents').parentNode.innerHTML = str;
					vtmessages.screenblock(false);
				}
			}
		});
	},
	markas : function(record, scrapstatus) {
		var url = 'module=vtmessages&action=vtmessagesAjax&ajax=true&messagemode=Mark&file=MessageSave';
		url += '&record=' + encodeURIComponent(record);
		url += '&vtmsgstatus=' + encodeURIComponent(scrapstatus);

		vtmessages.screenblock(true);
		new Ajax.Request(
        	'index.php',
            {queue: {position: 'end', scope: 'command'},
            	method: 'post',
                postBody:url,
                onComplete: function(response) {
                	vtmessages.reloadnow();
				}
			}
		);
	}
		
}
