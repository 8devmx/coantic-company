tinymce.PluginManager.add("emoticons",function(a,b){function c(){var a;return a='<table role="list" class="mce-grid">',tinymce.each(d,function(c){a+="<tr>",tinymce.each(c,function(c){var d=b+"/img/smiley-"+c+".gif";a+='<td><a href="#" data-mce-url="'+d+'" data-mce-alt="'+c+'" tabindex="-1" role="option" aria-label="'+c+'"><img src="'+d+'" style="width: 18px; height: 18px" role="presentation" /></a></td>'}),a+="</tr>"}),a+="</table>"}var d=[["cool","cry","embarassed","foot-in-mouth"],["frown","innocent","kiss","laughing"],["money-mouth","sealed","smile","surprised"],["tongue-out","undecided","wink","yell"]];a.addButton("emoticons",{type:"panelbutton",panel:{role:"application",autohide:!0,html:c,onclick:function(b){var c=a.dom.getParent(b.target,"a");c&&(a.insertContent('<img src="'+c.getAttribute("data-mce-url")+'" alt="'+c.getAttribute("data-mce-alt")+'" />'),this.hide())}},tooltip:"Emoticons"})});

