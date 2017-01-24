$(document).ready(function(){
	$('#dp5').datepicker();
	 $('#summernote').summernote({
		  height: 300,                 // set editor height
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		  focus: true                  // set focus to editable area after initializing summernote
		});

	 //Exam related scripts
		$('div.alert-success').delay(3000).slideUp(400);
		$(function(){
		$('a#btn-delete').on('click', function(e){
		    e.preventDefault();
		    e.stopPropagation();
		    var $a = this;
		    swal({
		                title: "Are you sure?",
		                text: "You will not be able to recover this!",
		                type: "warning",
		                showCancelButton: true,
		                confirmButtonColor: '#DD6B55',
		                confirmButtonText: 'Yes, delete it!',
		                closeOnConfirm: false
		            },
		            function(){
		                //console.log($($a).attr('href'));
		                document.location.href=$($a).attr('href');
		            });
		});
		});
		$('#add-new-question').hide();
		$('#btn-add-new-question').on('click', function(){
		    $('#add-new-question').slideDown();
		});
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': "{{ csrf_token() }}"
		    }
		});
});



/*
var video_out = document.getElementById("vid-box");
function login(form) {
	var phone = window.phone = PHONE({
	    number        : form.username.value || "Anonymous", // listen on username line else Anonymous
	    publish_key   : 'pub-c-7318b9fd-f7d8-44c5-8940-de559b642a07',
	    subscribe_key : 'sub-c-2b265702-adc9-11e6-b697-0619f8945a4f',
	});	
	phone.ready(function(){ form.username.style.background="#55ff5b"; });
	phone.receive(function(session){
	    session.connected(function(session) { video_out.appendChild(session.video); });
	    session.ended(function(session) { video_out.innerHTML=''; });
	});
	return false; 	// So the form does not submit.
}

function makeCall(form){
	if (!window.phone) alert("Login First!");
	else phone.dial(form.number.value);
	return false;
}






*/


var video_out = document.getElementById("vid-box");
var vid_thumb = document.getElementById("vid-thumb");
var vidCount  = 0;
    
function login(form) {
	var phone = window.phone = PHONE({
	    number        : form.username.value || "Anonymous", // listen on username line else Anonymous
	    publish_key   : 'pub-c-561a7378-fa06-4c50-a331-5c0056d0163c', // Your Pub Key
	    subscribe_key : 'sub-c-17b7db8a-3915-11e4-9868-02ee2ddab7fe', // Your Sub Key
	});
	var ctrl = window.ctrl = CONTROLLER(phone);
	ctrl.ready(function(){
		form.username.style.background="#55ff5b"; 
		form.login_submit.hidden="true"; 
		ctrl.addLocalStream(vid_thumb);
		addLog("Logged in as " + form.username.value); 
	});
	ctrl.receive(function(session){
	    session.connected(function(session){ video_out.appendChild(session.video); addLog(session.number + " has joined."); vidCount++; });
	    session.ended(function(session) { ctrl.getVideoElement(session.number).remove(); addLog(session.number + " has left.");    vidCount--;});
	});
	ctrl.videoToggled(function(session, isEnabled){
		ctrl.getVideoElement(session.number).toggle(isEnabled);
		addLog(session.number+": video enabled - " + isEnabled);
	});
	ctrl.audioToggled(function(session, isEnabled){
		ctrl.getVideoElement(session.number).css("opacity",isEnabled ? 1 : 0.75);
		addLog(session.number+": audio enabled - " + isEnabled);
	});
	return false;
}
function makeCall(form){
	if (!window.phone) alert("Login First!");
	var num = form.number.value;
	if (phone.number()==num) return false; // No calling yourself!
	ctrl.isOnline(num, function(isOn){
		if (isOn) ctrl.dial(num);
		else alert("User is Offline");
	});
	return false;
}
function mute(){
	var audio = ctrl.toggleAudio();
	if (!audio) $("#mute").html("Unmute");
	else $("#mute").html("Mute");
}
function end(){
	ctrl.hangup();
}
function pause(){
	var video = ctrl.toggleVideo();
	if (!video) $('#pause').html('Unpause'); 
	else $('#pause').html('Pause'); 
}
function getVideo(number){
	return $('*[data-number="'+number+'"]');
}
function addLog(log){
	$('#logs').append("<p>"+log+"</p>");
}
function errWrap(fxn, form){
	try {
		return fxn(form);
	} catch(err) {
		alert("WebRTC is currently only supported by Chrome, Opera, and Firefox");
		return false;
	}
}









