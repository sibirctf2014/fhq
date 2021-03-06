
function createQuestFilters() {
	return '\n\n<div class="fhq_task_filters"> <div>Filter by status quests: \n'
	+ '<input id="filter_open" class="fhq_task_checkbox" type="checkbox" onclick="reloadQuests();" checked />\n'
	+ '<label class="fhq_task_label lite_green_check" for="filter_open">open (<font id="filter_open_count">0</font>) </label> \n'
	+ '<input id="filter_current" class="fhq_task_checkbox" type="checkbox" onclick="reloadQuests();" checked/> \n'
	+ '<label class="fhq_task_label lite_green_check" for="filter_current">in progress (<font id="filter_current_count">0</font>) </label> \n'
	+ '<input id="filter_completed" class="fhq_task_checkbox" type="checkbox" onclick="reloadQuests();" />\n'
	+ '<label class="fhq_task_label lite_green_check" for="filter_completed">completed (<font id="filter_completed_count">0</font>) </label> \n'
	+ '</div>\n'
	+ '<div id="filter_by_subject"></div> \n'
	+ '</div> \n'
	+ '<div id="quests"></div> \n';
}


function createQuestInfo(quest) {

	var questid = quest.questid;
	var name = quest.name
	var score = quest.score;
	// var short_text = quest.short_text;
	var subject = quest.subject;
	var status = quest.status;
	var solved = quest.count_user_solved;
	solved = solved == null ? "?" : solved;

	var content = '\n\n<div class="fhq_quest_info" onclick="showQuest(' + questid + ');"><div class="fhq_quest_info_row">\n';
	content += '<div class="fhq_quest_info_cell_img">';
	content += '<img  width="100px" src="templates/base/images/quest_icons/' + subject + '.png">';
	content += '</div>';
	
	content += '<div class="fhq_quest_info_cell_content">';
	content += '<div class="fhq_quest_caption">' + questid + ' ' + name + '</div>';
	content += '<div class="fhq_quest_score">' + subject + ' +' + score + '</div>';
	content += '<div class="fhq_quest_caption">solved: ' + solved + '</div>';
	
	/*if (status == 'open')
		content += '<div class="fhq_quest_score">take quest</div>';*/
					
	// content += '<font class="fhq_task" size="1">Status: ' + status + '</font>\n';
	content += '</div>';
	content += '</div></div>\n';
	return content;
}

function reloadQuests()
{
	var quests = document.getElementById("quests");
	quests.innerHTML = "Please wait...";
	
	var params = {};
	params.filter_open = document.getElementById("filter_open").checked;
	params.filter_current = document.getElementById("filter_current").checked;
	params.filter_completed = document.getElementById("filter_completed").checked;

	// filter
	var arr = []
	var elems = document.getElementsByName("filter_subjects");
	for (var i = 0; i < elems.length; i++) {
		if (elems[i].checked)
			arr.push(elems[i].getAttribute("subject"));
	}
	params.filter_subjects = arr.join(",");
	
	// alert(createUrlFromObj(params));
	send_request_post(
		'api/quests/list.php',
		createUrlFromObj(params),
		function (obj) {
			if (obj.result == 'fail')
			{
				quests.innerHTML = obj.error.message;
				return;
			}
			
			// var current_game = obj.current_game;
			document.getElementById("filter_open_count").innerHTML = obj.status.open;
			document.getElementById("filter_current_count").innerHTML = obj.status.current;
			document.getElementById("filter_completed_count").innerHTML = obj.status.completed;
			var filter_by_subject = document.getElementById('filter_by_subject');
			if (filter_by_subject.innerHTML == "")
			{
				filter_by_subject.innerHTML = 'Filter by subject: \n';
				for (var k in obj.subjects) {
					filter_by_subject.innerHTML += '<input name="filter_subjects" subject="' + k + '" id="filter_subject_' + k + '" type="checkbox" class="fhq_task_checkbox" onclick="reloadQuests();" checked/>'
					+ '<label class="fhq_task_label lite_green_check" for="filter_subject_' + k + '">' + k + ' (' + obj.subjects[k] + ') </label> \n'
				}
			}

			quests.innerHTML = '';
			var perms = obj['permissions'];
			if (perms['insert'] == true)
				quests.innerHTML += '<div class="fhq_game_info"><div class="button3 ad" onclick="formCreateQuest();">Create Quest</div></div><br>';

			if (params.filter_current && obj.status.current > 0)
				quests.innerHTML += '<hr>In progress:<br><div id="current_quests"></div>';

			if (params.filter_open && obj.status.open > 0)
				quests.innerHTML += '<hr>Open Quests:<br><div id="open_quests"></div>'

			if (params.filter_completed && obj.status.completed > 0)
				quests.innerHTML += '<hr>Completed Quests:<br><div id="completed_quests"></div>';

			var open_quests = document.getElementById("open_quests");
			var current_quests = document.getElementById("current_quests");
			var completed_quests = document.getElementById("completed_quests");
			
			for (var k in obj.data) {
				// var questid = obj.data[k]['questid'];
				// var name = obj.data[k]['name'];
				// var score = obj.data[k]['score'];
				// var short_text = obj.data[k]['short_text'];
				// var subject = obj.data[k]['subject'];
				var status = obj.data[k]['status'];

				var content = createQuestInfo(obj.data[k]);
				/*'\n\n<div class="fhq_task_info" onclick="showQuest(' + questid + ');">\n';
				content += '<font class="fhq_task" size="2">' + questid + ' ' + name + '</font>\n';
				content += '<font class="fhq_task" size="5">' + subject + ' +' + score + '</font>\n';
				// content += '<font class="fhq_task" size="1">Status: ' + status + '</font>\n';
				content += '</div>\n';*/
				
				if (status == 'current')
					current_quests.innerHTML += content;

				if (status == 'open')
					open_quests.innerHTML += content;

				if (status == 'completed')
					completed_quests.innerHTML += content;
				
				// quests.innerHTML += content;
			}
		}
	);	
}

function loadQuests()
{
	var el = document.getElementById("content_page");
	el.innerHTML = createQuestFilters();
	reloadQuests();
}

function createQuestRow(name, value)
{
	return '<div class="quest_info_row">\n'
	+ '\t<div class="quest_info_param">' + name + '</div>\n'
	+ '\t<div class="quest_info_value">' + value + '</div>\n'
	+ '</div>\n';
}

function takeQuest(id)
{
	var params = {};
	params.questid = id;
	document.getElementById("quest_error").innerHTML = "";
	send_request_post(
		'api/quests/take.php',
		createUrlFromObj(params),
		function (obj) {
			if (obj.result == "ok") {
				closeModalDialog();
				reloadQuests();
				showQuest(id);
			} else {
				document.getElementById("quest_error").innerHTML = obj.error.message;
			}
		}
	);
}

function passQuest(id)
{
	/*var el = document.getElementById('user_answers');
	if (el.innerHTML.length != 0) {
		el.innerHTML = "";
		return;
	}*/
	
	var params = {};
	params.questid = id;
	params.answer = document.getElementById('quest_answer').value;
	document.getElementById("quest_error").innerHTML = "";
	send_request_post(
		'api/quests/pass.php',
		createUrlFromObj(params),
		function (obj) {
			if (obj.result == "ok") {
				closeModalDialog();
				reloadQuests();
				if (obj.new_user_score) {
					document.getElementById('view_score').innerHTML = obj.new_user_score;
				}
				showQuest(id);
			} else {
				if (isShowMyAnswers())
					updateMyAnswers(id);
				document.getElementById("quest_error").innerHTML = obj.error.message;
			}
		}
	);
}

function deleteQuest(id)
{
	if (!confirm("Are you sure that wand remove this quest?"))
		return;

	document.getElementById("quest_error").innerHTML = "";
	var params = {};
	params.questid = id;
	send_request_post(
		'api/quests/delete.php',
		createUrlFromObj(params),
		function (obj) {
			if (obj.result == "ok") {
				closeModalDialog();
				loadQuests();
			} else {
				document.getElementById("quest_error").innerHTML = obj.error.message;
			}
		}
	);
}

function updateQuest(id)
{
	var params = {};
	params["questid"] = id;
	params["name"] = document.getElementById("editquest_name").value;
	params["short_text"] = document.getElementById("editquest_short_text").value;
	params["text"] = document.getElementById("editquest_text").value;
	params["score"] = document.getElementById("editquest_score").value;
	params["min_score"] = document.getElementById("editquest_min_score").value;
	params["subject"] = document.getElementById("editquest_subject").value;
	params["idauthor"] = document.getElementById("editquest_authorid").value;
	params["author"] = document.getElementById("editquest_author").value;
	params["answer"] = document.getElementById("editquest_answer").value;
	params["state"] = document.getElementById("editquest_state").value;
	params["description_state"] = document.getElementById("editquest_description_state").value;

	// alert(createUrlFromObj(params));

	send_request_post(
		'api/quests/update.php',
		createUrlFromObj(params),
		function (obj) {
			if (obj.result == "ok") {
				closeModalDialog();
				reloadQuests();
				showQuest(id);
			} else {
				alert(obj.error.message);
			}
		}
	);
}

function formEditQuest(id)
{
	closeModalDialog();
	var params = {};
	params.questid = id;
	send_request_post(
		'api/quests/get_all.php',
		createUrlFromObj(params),
		function (obj) {
			if (obj.result == "fail") {
				showModalDialog(obj.error.message);
				return;
			}
			
			var content = '\n';

			/*content += createQuestRow('Quest UUID:', '<input type="text" id="newquest_quest_uuid" value="' + guid() + '"/>');
			// 
			
			content += createQuestRow('', '<div class="button3 ad" onclick="createQuest();">Create</div>');*/
			
			if (!obj.quest) {
				showModalDialog("error");
				return;
			}
			content += '<div class="quest_info_table">\n';
			
			content += createQuestRow('Quest ID: ', obj.quest);
			content += createQuestRow('Game: ', obj.data.game_title);
			content += createQuestRow('Name:', '<input type="text" id="editquest_name" value="' + obj.data.name + '"/>');
			content += createQuestRow('Short Text:', '<input type="text" id="editquest_short_text" value="' + obj.data.short_text + '"/>');
			content += createQuestRow('Text:', '<textarea id="editquest_text">' + obj.data.text + '</textarea>');
			content += createQuestRow('Score(+):', '<input type="text" id="editquest_score" value="' + obj.data.score + '"/>');
			content += createQuestRow('Min Score(>):', '<input type="text" id="editquest_min_score" value="' + obj.data.min_score + '"/>');
			content += createQuestRow('Subject:', '<input type="text" id="editquest_subject" value="' + obj.data.subject + '"/>');
			content += createQuestRow('Author Id:', '<input type="text" id="editquest_authorid" value="' + obj.data.authorid + '"/>');
			content += createQuestRow('Author:', '<input type="text" id="editquest_author" value="' + obj.data.author + '"/>');
			content += createQuestRow('Answer:', '<input type="text" id="editquest_answer" value="' + obj.data.answer + '"/>');
			content += createQuestRow('State:', '<input type="text" id="editquest_state" value="' + obj.data.state + '"/>');
			content += createQuestRow('Description State:', '<textarea id="editquest_description_state">' + obj.data.description_state + '</textarea>');
			content += createQuestRow('', '<div class="button3 ad" onclick="updateQuest(' + obj.quest + ');">Update</div>'
				+ '<div class="button3 ad" onclick="showQuest(' + obj.quest + ');">Cancel</div>'
			);

			content += '</div>';
			content += '<div id="quest_error"><div>';
			content += '\n';
			showModalDialog(content);
		}
	);
}

function showQuest(id)
{
	var params = {};
	params.taskid = id;
	send_request_post(
		'api/quests/get.php',
		createUrlFromObj(params),
		function (obj) {
			var content = '\n';

			if (!obj.quest) {
				showModalDialog("error");
				return;
			}
			content += '<div class="quest_info_table">\n';
			
			content += createQuestRow('Quest ID: ', obj.quest);
			if (obj.data.game_title)
				content += createQuestRow('Game: ', obj.data.game_title);
	
			if (obj.data.name)
				content += createQuestRow('Name: ', obj.data.name);
				
			if (obj.data.subject)
				content += createQuestRow('Subject: ', obj.data.subject);

			if (obj.data.score)
				content += createQuestRow('Score: ', '+' + obj.data.score + ' (>' + obj.data.min_score + ')');
				
			if (obj.data.short_text)
				content += createQuestRow('Short Text: ', obj.data.short_text);
			
			if (obj.data.author)
				content += createQuestRow('Author: ', obj.data.author);

			if (obj.data.date_start == null && obj.data.date_stop == null) {
				content += createQuestRow('', '<div class="button3 ad" onclick="takeQuest(' + obj.quest + ');">Take quest</div>');
			} else if (obj.data.date_stop == null || obj.data.date_stop == '0000-00-00 00:00:00') {
				if (obj.data.text)
					content += createQuestRow('Text: ', '<pre>' + obj.data.text + '</pre>');
				if (obj.data.date_start)
					content += createQuestRow('Date Start: ', obj.data.date_start);
				content += createQuestRow('', '<input id="quest_answer" type="text" onkeydown="if (event.keyCode == 13) passQuest(' + obj.quest + ');"/>'
					+ '<div class="button3 ad" onclick="passQuest(' + obj.quest + ');">Pass quest</div>'
					);
				content += createQuestRow('', '<div class="button3 ad" onclick="showMyAnswers(' + obj.quest + ');">Show/Hide my answers</div><br>'
					+ '<div id="user_answers"></div>'
					);					
			} else {
				if (obj.data.text)
					content += createQuestRow('Text: ', '<pre>' + obj.data.text + '</pre>');
				if (obj.data.date_start)
					content += createQuestRow('Date Start: ', obj.data.date_start);
				if (obj.data.date_stop)
					content += createQuestRow('Date Stop: ', obj.data.date_stop);
			}
			
			if (obj.permissions.edit == true && obj.permissions['delete'] == true) {
				content += createQuestRow('',
					'<div class="button3 ad" onclick="formEditQuest(' + obj.quest + ');">Edit</div>'
					+ '<div class="button3 ad" onclick="deleteQuest(' + obj.quest + ');">Delete</div>'
				);
			}
			content += '</div>';
			content += '<div id="quest_error"><div>';
			content += '\n';
			showModalDialog(content);
		}
	);
}

function createQuest() 
{
	var params = {};
	params["quest_uuid"] = document.getElementById("newquest_quest_uuid").value;
	params["name"] = document.getElementById("newquest_name").value;
	params["short_text"] = document.getElementById("newquest_short_text").value;
	params["text"] = document.getElementById("newquest_text").value;
	params["score"] = document.getElementById("newquest_score").value;
	params["min_score"] = document.getElementById("newquest_min_score").value;
	params["subject"] = document.getElementById("newquest_subject").value;
	params["idauthor"] = document.getElementById("newquest_author_id").value;
	params["author"] = document.getElementById("newquest_author").value;
	params["answer"] = document.getElementById("newquest_answer").value;
	params["state"] = document.getElementById("newquest_state").value;
	params["description_state"] = document.getElementById("newquest_description_state").value;

	// alert(createUrlFromObj(params));
	send_request_post(
		'api/quests/insert.php',
		createUrlFromObj(params),
		function (obj) {
			if (obj.result == "ok") {
				closeModalDialog();
				loadQuests();
			} else {
				alert(obj.error.message);
			}
		}
	);
};

function formCreateQuest() 
{
	var content = '';
	content += '<div class="quest_info_table">\n';
	content += createQuestRow('Quest UUID:', '<input type="text" id="newquest_quest_uuid" value="' + guid() + '"/>');
	content += createQuestRow('Name:', '<input type="text" id="newquest_name" value=""/>');
	content += createQuestRow('Short Text:', '<input type="text" id="newquest_short_text"/>');
	content += createQuestRow('Text:', '<textarea id="newquest_text"></textarea>');
	content += createQuestRow('Score(+):', '<input type="text" id="newquest_score" value="100"/>');
	content += createQuestRow('Min Score(>):', '<input type="text" id="newquest_min_score" value="0"/>');
	content += createQuestRow('Subject:', '<input type="text" id="newquest_subject" value="enjoy"/>');
	content += createQuestRow('Author Id:', '<input type="text" id="newquest_author_id" value=""/>');
	content += createQuestRow('Author:', '<input type="text" id="newquest_author" value=""/>');
	content += createQuestRow('Answer:', '<input type="text" id="newquest_answer" value=""/>');
	content += createQuestRow('State:', '<input type="text" id="newquest_state" value="open"/>');
	content += createQuestRow('Description State:', '<textarea id="newquest_description_state"></textarea>');
	content += createQuestRow('', '<div class="button3 ad" onclick="createQuest();">Create</div>');
	content += '</div>'; // quest_info_table
	showModalDialog(content);
}

function isShowMyAnswers() {
	var el = document.getElementById('user_answers');
	return (el.innerHTML.length != 0);
}

function updateMyAnswers(id)
{
	var params = {};
	params["questid"] = id;

	// alert(createUrlFromObj(params));
	send_request_post(
		'api/quests/user_answers.php',
		createUrlFromObj(params),
		function (obj) {
			if (obj.result == "ok") {
				var el = document.getElementById('user_answers');
				el.innerHTML = " Answers: <br>";
				for (var i = 0; i < obj.data.length; ++i) {
					el.innerHTML += '<div class="fhq_task_tryanswer">[' + obj.data[i].datetime_try + '] ' + obj.data[i].answer_try + '</div>';
				}
			} else {
				
			}
		}
	);
}

function hideMyAnswers()
{
	var el = document.getElementById('user_answers');
	el.innerHTML = "";
}

function showMyAnswers(id)
{
	if (isShowMyAnswers()) {
		hideMyAnswers();
		return;
	}

	updateMyAnswers(id);
}
