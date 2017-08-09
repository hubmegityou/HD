
var NotifcationsTest = {

				VerifyBrowserSupport: function() {
					return ("Notification" in window);
				},
				ShowNotification: function(){

					var notification = new Notification('dupadupa');
				},
				RequestForPermissionAndShow: function(){
					
					if (Notification.permission === "granted") {
						NotifcationsTest.ShowNotification();
					}
					
					else if (Notification.permission !== "denied") {
						Notification.requestPermission(function (permission) {
							
							if(!("permission" in Notification)) {
								Notification.permission = permission;
							}
							if (permission === "granted") {
								NotifcationsTest.ShowNotification();
							}
						});
					}
				}
			}

                                window.onload = function(){
					if(!NotifcationsTest.VerifyBrowserSupport()){
						alert("Brak wsparcia dla Notifications API");				
					}
					NotifcationsTest.RequestForPermissionAndShow();	
			};
		