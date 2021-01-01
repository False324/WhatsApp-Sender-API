<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>API TESTER</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://www.cssscript.com/demo/minimal-json-data-formatter-jsonviewer/json-viewer.js"></script>
	<link rel="stylesheet" href="https://www.cssscript.com/demo/minimal-json-data-formatter-jsonviewer/json-viewer.css">
	<style>
		.dn {
			display: none;
		}
		.pre {
			background: white;
    		border-radius: 6px;
    		padding: 10px;
		}
	</style>
</head>
<body class="bg-light">
	<div class="">
	  <div class="row mb-3">
		  <div class="col-3">
		    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" data-action="createSender" onclick="">Создать рассылку</a>
		      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" data-action="accountAdd" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Добавить аккаунт</a>
		      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" data-action="accountDelete" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Удалить аккаунт</a>
		      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" data-action="accountList" role="tab" aria-controls="v-pills-settings" aria-selected="false">Список аккаунтов</a>
		    </div>
		  </div>
		  <div class="col-9">
		    <div class="tab-content" id="v-pills-tabContent">
		      <div class="tab-pane fade show active" id="v-pills-home" data-action="createSender" role="tabpanel" aria-labelledby="v-pills-home-tab">
		      	<div class="h4 title">
		      		Создание рассылки
		      	</div>
		      	<form data-action="createSender">
	    		  <div class="input-group mb-3">
					  <input type="text" class="form-control" disabled="" id="createSenderUrl" value="<?=$_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME']?>/api/v1/whatsapp/send">
					  <div class="input-group-append">
					    <button class="btn btn-success" type="button" id="createSenderButton">Отправить</button>
					  </div>
					</div>
				  <div class="form-group">
				    <label for="exampleFormControlTextarea1">Тело запроса</label>
				    <textarea class="form-control" id="createSenderParams" rows="9">
				    	
				    </textarea>
				  </div>
				</form>
		      </div>
		      <div class="tab-pane fade" id="v-pills-profile" data-action="accountAdd" role="tabpanel" aria-labelledby="v-pills-profile-tab">
		      	<div class="h4 title">
		      		Добавить аккаунт
		      	</div>
		      	<form data-action="createSender">
	    		  <div class="input-group mb-3">
					  <input type="text" class="form-control" disabled="" id="accountAddUrl" value="<?=$_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME']?>/api/v1/whatsapp/add">
					  <div class="input-group-append">
					    <button class="btn btn-success" type="button" id="accountAddButton">Отправить</button>
					  </div>
					</div>
				  <div class="form-group">
				    <label for="exampleFormControlTextarea1">Тело запроса</label>
				    <textarea class="form-control" id="accountAddParams" rows="9">
				    	
				    </textarea>
				  </div>
				</form>
		      </div>
		      <div class="tab-pane fade" id="v-pills-messages" data-action="accountDelete" role="tabpanel" aria-labelledby="v-pills-messages-tab">
		      	<div class="h4 title">
		      		Удалить аккаунт
		      	</div>
		      	<form data-action="createSender">
	    		  <div class="input-group mb-3">
					  <input type="text" class="form-control" disabled="" id="accountDeleteUrl" value="<?=$_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME']?>/api/v1/whatsapp/remove">
					  <div class="input-group-append">
					    <button class="btn btn-success" type="button" id="accountDeleteButton">Отправить</button>
					  </div>
					</div>
				  <div class="form-group">
				    <label for="exampleFormControlTextarea1">Тело запроса</label>
				    <textarea class="form-control" id="accountDeleteParams" rows="9">
				    	
				    </textarea>
				  </div>
				</form>
		      </div>
		      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" data-action="accountList" aria-labelledby="v-pills-settings-tab">
		      	<div class="h4 title">
		      		Список аккаунтов
		      	</div>
		      	<form data-action="createSender">
	    		  <div class="input-group mb-3">
					  <input type="text" class="form-control" disabled="" id="accountGetUrl" value="<?=$_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME']?>/api/v1/whatsapp/get?secretKey=your_secret_key">
					  <div class="input-group-append">
					    <button class="btn btn-success" type="button" id="accountGetButton">Отправить</button>
					  </div>
					</div>
					<span class="text-muted mb-2 mt-2"><b>Параметр: </b>secretKey - защитный ключ, дабы список пользователей смог посмотреть только то кто его знает (Администратор)</span>
				  <div class="form-group">
				    <label for="exampleFormControlTextarea1">Тело запроса</label>
				    <textarea class="form-control" id="accountGetParams" rows="2">
				    	Параметров нет
				    </textarea>
				  </div>
				</form>
		      </div>
		    </div>
		  </div>
		</div>
		<div class="form-group dn pre" id="json_formatted_request">Request</div>
	    <div class="form-group dn pre" id="json_formatted_response">Response</div>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
	const reqCreateSender = {
	    "messages": [
	        "https://false-mirror.tk/data/test/messages/one.txt",
	        "https://false-mirror.tk/data/test/messages/two.txt"
	    ],
	    "file": "https://false-mirror.tk/data/test/olx.xls",
	    "sleep_messages": 3,
	    "sleep_users": 3,
	    "user_id": "first_user",
	    "country_code": "+48"
	};

	const reqAccountAdd = {
		"user_id": "first_user",
	    "url": "https://eu196.chat-api.com/instance210275/",
	    "token": "lra0atfk7pwhua89"
	};

	const reqAccountDelete = {
	    "user_id": "user_id2"
	};

	var jsonViewerRequest = new JSONViewer();
	var jsonViewerResponse = new JSONViewer();

	document.querySelector("#json_formatted_response").appendChild(jsonViewerResponse.getContainer());
	document.querySelector("#json_formatted_request").appendChild(jsonViewerRequest.getContainer());


	window.onload = () => { $('#v-pills-home-tab').click(); }
	
	$('#v-pills-tab').on('click', e => {
		console.log(e);

		const dataAction = e.target.dataset.action;

		if(dataAction === 'createSender') {
			$('#json_formatted_request').removeClass('dn');
			$('#json_formatted_response').addClass('dn');
			document.querySelector('#createSenderParams').value = JSON.stringify(reqCreateSender, undefined, 4)
			jsonViewerRequest.showJSON(reqCreateSender);
		} else if(dataAction === 'accountAdd') {
			$('#json_formatted_request').removeClass('dn');
			$('#json_formatted_response').addClass('dn');
			document.querySelector('#accountAddParams').value = JSON.stringify(reqAccountAdd, undefined, 4)
			jsonViewerRequest.showJSON(reqAccountAdd);
		} else if(dataAction === 'accountDelete') {
			$('#json_formatted_request').removeClass('dn');
			$('#json_formatted_response').addClass('dn');
			document.querySelector('#accountDeleteParams').value = JSON.stringify(reqAccountDelete, undefined, 4)
			jsonViewerRequest.showJSON(reqAccountDelete);
		} else {
			$('#json_formatted_request').addClass('dn');
			$('#json_formatted_response').addClass('dn');
		}
	})

	// sender
	document.querySelector('#createSenderParams').addEventListener('input', (e) => {
		let data = e.target.value;
		var obj = JSON.parse(data);
	   	var pretty = JSON.stringify(obj, undefined, 4);
	   	e.target.value = pretty;
		jsonViewerRequest.showJSON(JSON.parse(data));
		$('#json_formatted_request').removeClass('dn');
	})
	document.querySelector('#createSenderParams').value = JSON.stringify(reqCreateSender, undefined, 4)

	document.querySelector("#createSenderButton").addEventListener('click', (e) => {
		e.preventDefault();

		$.ajax({
		  url: document.querySelector('#createSenderUrl').value,
		  type: "POST",
		  data: document.querySelector('#createSenderParams').value,
		  dataType : "json",
		  contentType: "application/json; charset=utf-8",
		  success: function(data) {
		  	document.querySelector("#json_formatted_response").appendChild(jsonViewerResponse.getContainer());
		  	jsonViewerResponse.showJSON(data)
		  	$('#json_formatted_response').removeClass('dn');
		  	scrollToResponse()
	      },
	      error: function(error) {
	        console.error('errror')
	      }
		});
	})

	//add
	document.querySelector("#accountAddButton").addEventListener('click', (e) => {
		e.preventDefault();

		$.ajax({
		  url: document.querySelector('#accountAddUrl').value,
		  type: "POST",
		  data: document.querySelector('#accountAddParams').value,
		  dataType : "json",
		  contentType: "application/json; charset=utf-8",
		  success: function(data) {
		  	jsonViewerResponse.showJSON(data)
		  	$('#json_formatted_response').removeClass('dn');
		  	scrollToResponse()
	      },
	      error: function(error) {
	        console.error('errror')
	      }
		});
	})

	//remove
	document.querySelector("#accountDeleteButton").addEventListener('click', (e) => {
		e.preventDefault();

		$.ajax({
		  url: document.querySelector('#accountDeleteUrl').value,
		  type: "POST",
		  data: document.querySelector('#accountDeleteParams').value,
		  dataType : "json",
		  contentType: "application/json; charset=utf-8",
		  success: function(data) {
		  	jsonViewerResponse.showJSON(data)
		  	$('#json_formatted_response').removeClass('dn');
		  	scrollToResponse()
	      },
	      error: function(error) {
	        console.error('errror')
	      }
		});
	})

	//get
	document.querySelector("#accountGetButton").addEventListener('click', (e) => {
		e.preventDefault();

		$.ajax({
		  url: document.querySelector('#accountGetUrl').value,
		  type: "POST",
		  data: "",
		  dataType : "json",
		  contentType: "application/json; charset=utf-8",
		  success: function(data) {
		  	jsonViewerResponse.showJSON(data)
		  	$('#json_formatted_response').removeClass('dn');
		  	scrollToResponse()
	      },
	      error: function(error) {
	        console.error('errror')
	      }
		});
	})

	function scrollToResponse() {
		$([document.documentElement, document.body]).animate({
	        scrollTop: $("#json_formatted_request").offset().top
	    }, 2000);
	}

</script>
</html>