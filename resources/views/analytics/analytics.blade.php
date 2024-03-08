(function(window) {
var unknown = 'Unknown';

// Retrieve the web track ID from the script tag's data attribute
var webTrackId = document.currentScript.getAttribute('data-web-track-id');

// Function to track an event
function trackEvent(eventName, eventData) {
// Send a request to your backend to store the event data
// Replace 'your-backend-endpoint' with the actual endpoint URL in your Laravel application
fetch('{{url('api/track')}}', {
method: 'POST',
headers: {
'Content-Type': 'application/json'
},
body: JSON.stringify({
trackId: webTrackId,
event: eventName,
data: eventData
})
})
.then(response => {
if (!response.ok) {
console.error('Failed to track event:', response.statusText);
}
})
.catch(error => {
console.error('Error tracking event:', error);
});
}

// Example of tracking a page view event
window.addEventListener('load', function() {
// Get browser information
var screenSize = '';
if (screen.width) {
width = (screen.width) ? screen.width : '';
height = (screen.height) ? screen.height : '';
screenSize += '' + width + " x " + height;
}

var nVer = navigator.appVersion;
var nAgt = navigator.userAgent;
var browser = navigator.appName;
var version = '' + parseFloat(navigator.appVersion);
var majorVersion = parseInt(navigator.appVersion, 10);
var nameOffset, verOffset, ix;

// Browser detection logic
// (This part is the same as the provided script)

// mobile version
var mobile = /Mobile|mini|Fennec|Android|iP(ad|od|hone)/.test(nVer);

// cookie
var cookieEnabled = (navigator.cookieEnabled) ? true : false;

if (typeof navigator.cookieEnabled == 'undefined' && !cookieEnabled) {
document.cookie = 'testcookie';
cookieEnabled = (document.cookie.indexOf('testcookie') != -1) ? true : false;
}

// system
var os = unknown;
var clientStrings = [
// Operating system detection logic
// (This part is the same as the provided script)
];
for (var id in clientStrings) {
var cs = clientStrings[id];
if (cs.r.test(nAgt)) {
os = cs.s;
break;
}
}

var osVersion = unknown;

if (/Windows/.test(os)) {
osVersion = /Windows (.*)/.exec(os)[1];
os = 'Windows';
}

switch (os) {
case 'Mac OS X':
osVersion = /Mac OS X (10[\.\_\d]+)/.exec(nAgt)[1];
break;

case 'Android':
osVersion = /Android ([\.\_\d]+)/.exec(nAgt)[1];
break;

case 'iOS':
osVersion = /OS (\d+)_(\d+)_?(\d+)?/.exec(nVer);
osVersion = osVersion[1] + '.' + osVersion[2] + '.' + (osVersion[3] | 0);
break;

}

// Track page view event along with browser info
trackEvent('page-view', {
url: window.location.href,
timestamp: new Date().toISOString(),
browserInfo: {
screen: screenSize,
browser: browser,
browserVersion: version,
mobile: mobile,
os: os,
osVersion: osVersion,
cookies: cookieEnabled
}
});
});

}(this));
