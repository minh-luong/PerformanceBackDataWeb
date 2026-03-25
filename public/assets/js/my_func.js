//******************************************************************************
//******************************************************************************
function getRequest(link, func) {
	var http = new XMLHttpRequest();
	http.open('GET', link);
	http.onreadystatechange = function () {
		if (http.readyState == 4 && http.status == 200) {
			func(http.responseText);
		}
	}
	http.send(null);
}

function postRequest(link, data, func = null, func2 = null) {
	var http = new XMLHttpRequest();
	http.open('POST', link, true);
	http.onreadystatechange = function () {
		if (http.readyState == 4 && http.status == 200) {
			func(http.responseText);
		}
	}
	if(func2 != null){
		http.upload.onprogress = function(){
			func2(event);
		}
	}
	http.send(data);
}
//******************************************************************************
//******************************************************************************
function stringLimitLength(str, limit) {
	if (str.length <= limit)
		return str;
	return str.substring(0, limit) + "...";
}

function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
		vars[key] = value;
	});
	return vars;
}

function getById(id) {
	return document.getElementById(id);
}

function getByName(name) {
	return document.getElementsByName(name);
}

function signup() {
	var fd = new FormData();
	fd.append('fullname', document.getElementsByName('fullname')[0].value);
	fd.append('email', document.getElementsByName('email')[0].value);
	fd.append('username', document.getElementsByName('username')[0].value);
	fd.append('password', document.getElementsByName('password')[0].value);
	fd.append('password2', document.getElementsByName('password2')[0].value);

	postRequest('?action=signup', fd, function (resp) {
		console.log(resp);
		switch (resp) {
			case "Error: username_exist":
				alert("Username is exist. Please try another!");
				break;
			case "Error: email_exist":
				alert("Email is exist. Please try another!");
				break;
			case "Error: password_short":
				alert("Password is too short. The minimum length is 8!");
				break;
			case "Error: password_mismatch":
				alert("Repeat password is not match. Please try again!");
				break;
			case "Error: fullname_empty":
				alert("Full name is empty!");
				break;
			case "Error: username_empty":
				alert("Username is empty!");
				break;
			case "SignupOK":
				location.href = "./.";
			default:
				break;
		}
	});
}

function loadInfo() {
	getRequest('?action=load_info', function (resp) {
		var data = JSON.parse(resp);
		getById("info_email").value = data['email'];
		getById("info_username").value = data['username'];
		getById("info_fullname").value = data['fullname'];
	});
}

function updateInfo(obj) {
	var fd = new FormData();
	fd.append('fullname', getById('info_fullname').value);
	fd.append('email', getById('info_email').value);
	postRequest('?action=update_info', fd, function (resp) {
		switch (resp) {
			case "UpdateInfoOK":
				alert("Cập nhật thành công!");
				obj.previousElementSibling.click();
				window.location.reload(true);
				break;
			case "EmptyFullname":
				alert("Họ tên không được để trống!");
				break;
			case "ExistEmail":
				alert("Email đã có người sử dụng!");
				break;
		}
	});
}

function updatePassword(obj) {
	var data = new FormData();
	data.append('oldpass', getById('old_pass').value);
	data.append('newpass', getById('new_pass').value);
	data.append('newpass2', getById('new_pass2').value);
	postRequest('?action=change_pass', data, function (resp) {
		switch (resp) {
			case "ChangePassOK":
				alert("Đổi mật khẩu thành công!");
				getById('old_pass').value = '';
				getById('new_pass').value = '';
				getById('new_pass2').value = '';
				obj.previousElementSibling.click();
				break;
			case "OldPassWrong":
				alert("Mật khẩu cũ không đúng!");
				break;
			case "ShortPassword":
				alert("Độ dài mật khẩu tối thiểu 8 ký tự");
				break;
			case "PasswordMismatch":
				alert("Mật khẩu mới nhập không khớp!");
				break;
		}
	});
}

// function chooseImg(obj, input_name) {
// 	var x = obj.previousElementSibling;
// 	x.click();
// 	x.onchange = function (e) {
// 		var reader = new FileReader();
// 		reader.readAsDataURL(e.srcElement.files[0]);
// 		reader.onload = function (e) {
// 			obj.src = e.target.result;
// 		}
// 		obj.previousElementSibling.previousElementSibling.style.display = 'block';
// 		var check = document.getElementsByName(input_name);
// 		if (check[check.length - 1].value != "") {
// 			createImgChooser(obj.parentElement.parentElement.parentElement, input_name);
// 		}
// 	}
// }
// function createImgChooser(obj, input_name) {
// 	var item = document.createElement('div');
// 	item.className = 'col-md-3';
// 	item.innerHTML = "<div style='width: 100%; height: 100%;'>\n" +
// 		"<button class='close' type='button' style='position: relative; top: 3px; left: -28px; display: none; z-index: 100;' onclick='delImgChooser(this)'>×</button>\n" +
// 		"<input type='file' name='" + input_name + "' style='display: none;'>\n" +
// 		"<img src='assets/img/plus.png' class='imgChooserBg' onclick=\"chooseImg(this, '" + input_name + "')\">\n" +
// 		"</div>";
// 	obj.appendChild(item);
// }
// function delImgChooser(obj) {
// 	obj.parentElement.parentElement.parentElement.removeChild(obj.parentElement.parentElement);
// }

function createFolder(){
	var fd = new FormData();
	fd.append("parent_id", getById("parent-id-create").value);
	fd.append("name", getById("folder-name-create").value);
	postRequest("?action=create_folder", fd, function(resp){
		switch(resp){
			case "CreateFolderOK":
				location.reload(true); break;
			case "ExistFolder":
				alert("Thư mục đã tồn tại!"); break;
			case "NotAllow":
				alert("Bạn không có quyền để thay đổi thư mục này!"); break;
		}
	});
}

function uploadFolder(files){
	var fd = new FormData();
	fd.append('parent_id', getUrlVars()['itemid']);
	var paths = "";
	for(var i in files){
		paths += files[i].webkitRelativePath + "##";
		fd.append(i, files[i]);
	}
	fd.append("paths", paths);
	postRequest("?action=upload_folder", fd, function(resp){
		console.log(resp);
		if(resp == "NotAllowUploadFolder") alert("Bạn không đủ quyền để thay đổi mục này!");
		else if(resp == "UploadFolderOK") window.location.reload(true);
	},
	function(e){
		getById("uploadFolderProgress").style.width = Math.ceil(e.loaded / e.total * 100) + "%";
	});
}

function uploadFile(files){
	var fd = new FormData();
	fd.append('parent_id', getUrlVars()['itemid']);

	for(var i in files){
		fd.append(i, files[i]);
	}
	postRequest("?action=upload_file", fd, 
	function(resp){
		if(resp == "NotAllowUploadFile") alert("Bạn không đủ quyền để thay đổi mục này!");
		else if(resp == "UploadFileOK") window.location.reload(true);
	},
	function(e){
		document.getElementById('uploadFileProgress').style.width = Math.ceil(e.loaded / e.total * 100) + "%";
	});
}

function setDeleteItemId(obj){
	document.getElementById('deleteItemId').innerHTML = obj.parentElement.id.split("__")[1];
}
function deleteItem(id){
	var fd = new FormData();
	fd.append('item_id', id);
	postRequest('?action=delete_item', fd, function(resp){
		// console.log(resp);
		if(resp == "NotAllowDeleteItem") alert("Bạn không đủ quyền để thay đổi mục này!");
		else if(resp == "DeleteItemOK") window.location.reload(true);
	})
}

function setRenameItem(obj){
	document.getElementById('renameItemId').innerHTML = obj.parentElement.id.split("__")[1];
	document.getElementById('renameItemName').value = obj.parentElement.parentElement.parentElement.previousElementSibling.children[0].innerHTML.trim();
}
function renameItem(id, newName){
	var fd = new FormData();
	fd.append('item_id', id);
	fd.append('new_name', newName.trim());
	postRequest('?action=rename_item', fd, function(resp){
		// console.log(resp);
		if(resp == "NotAllowRenameItem") alert("Bạn không đủ quyền để thay đổi mục này!");
		else if(resp == "RenameItemOK") window.location.reload(true);
	});
}

function downloadItem(obj){
	var item_id = obj.parentElement.id.split("__")[1];
	var tag = document.createElement('a');
	tag.href = "./?action=download&id=" + item_id;
	tag.target = '_blank';
	// tag.setAttribute('download', resp.split('/').reverse()[0]);
	tag.click();
}
function updateShareMode(){
	var fd = new FormData();
	var mode = getByName("share_mode");
	if(mode[0].checked) fd.append("mode", "mode_public");
	else if(mode[1].checked) fd.append("mode", "mode_normal");
	else if(mode[2].checked) fd.append("mode", "mode_private");
	fd.append("item_id", getById('shareItemId').innerHTML);
	postRequest("?action=update_share_mode", fd, function(resp){
		if(resp == "NotAllowUpdateShareMode") alert("Bạn không có quyền để thay đổi mục này!");
		else if(resp == "UpdateShareModeOK") { 
			getShareList();
		}
	});
}
function getShareList(){
	var item_id = document.getElementById('shareItemId').innerHTML;
	var fd = new FormData();
	fd.append('item_id', item_id);
	postRequest("?action=get_share_list", fd, function(resp){
		// console.log(resp);
		if(resp == "NotAllowShare"){
			alert("Bạn không đủ quyền để thực hiện chức năng này!");
		}
		else{
			var data = JSON.parse(resp);
			var mode = getByName("share_mode");
			var display = "block";
			if(data['mode'] == "mode_public"){
				mode[0].checked = true;
			}
			else if(data['mode'] == "mode_normal"){
				mode[1].checked = true;
			}
			else if(data['mode'] == "mode_private"){
				display = "none";
				mode[2].checked = true;
			}
			getById("share_list_area").style.display = display;
			getById('shareListPanel').innerHTML = "";
			if(data['list'] == "null") return;
			for(var i = 0; i < data['list'].length; i++){
				var container = document.createElement("div");
				container.className = "share_item";
				var privilege = "";
				if(data['list'][i]['own'] == "readonly") privilege = "Read";
				else if(data['list'][i]['own'] == "writeable") privilege = "Read/Write";
				container.innerHTML = data['list'][i]['fullname'] + " - <span>" + data['list'][i]['email'] + "</span> (" + privilege 
				+ ") <button style=\"background: transparent; color: #fff; border: none; float: right;\" onclick=\"removePrivilege(this)\"><span aria-hidden=\"true\" style=\"color: #fff;\">×</span></button>";
				getById('shareListPanel').appendChild(container);
			}
		}
	});
}
function setShareItem(obj){
	var item_id = obj.parentElement.id.split("__")[1];
	document.getElementById('shareItemId').innerHTML = item_id;
	getShareList();
}
function addPrivilege(){
	var fd = new FormData();
	fd.append('item_id', document.getElementById('shareItemId').innerHTML);
	fd.append('email', document.getElementById('share_email').value.trim());
	fd.append('privilege', document.getElementById('share_privilege').value);
	postRequest('?action=add_privilege', fd, function(resp){
		switch(resp){
			case "NotAllowAddPrivilege":
				alert("Bạn không đủ quyền để chia sẻ mục này!");
				break;
			case "EmailNotFound":
				alert("Không tìm thấy tài khoản có email này!");
				break;
			case "AlreadyPrivilegeParent":
				alert("Người dùng đã được chia sẻ mục này!");
				break;
			case "AddPrivilegeOK":
				document.getElementById('share_email').value = "";
				getShareList();
				break;
		}
	});
}
function removePrivilege(obj){
	var fd = new FormData();
	fd.append('item_id', document.getElementById('shareItemId').innerHTML);
	fd.append('email', obj.previousElementSibling.innerHTML.trim());
	console.log(obj.previousElementSibling.innerHTML.trim());
	postRequest('?action=remove_privilege', fd, function(resp){
		getShareList();
		console.log(resp);
	});
}

function fileView(file_id, type){
	var fd = new FormData();
	fd.append('file_id', file_id);
	fd.append('type', type);
	getById('fileViewBody').innerHTML = "";
	postRequest('?action=get_file_data', fd, function(resp){
		// console.log(resp);
		var data = JSON.parse(resp);
		getById('fileViewTitle').innerHTML = data['title'];
		getById('fileViewBody').innerHTML = data['content'];
	});
}