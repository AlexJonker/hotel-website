fetch("/assets/php/weer.php")
.then(function(response) {
  return response.json();
})
.then(function(data) {
  var el = document.getElementById("weer-info");
  if (!el) {
    return;
  }

  if (!data || !data.currentConditions) {
    el.innerHTML = "geen weer";
    return;
  }

  var cc = data.currentConditions;
  var days = data.days || [];
  var today = days[0];

  // temperatuur
  var tempF;
  if (cc.temp) {
    tempF = cc.temp;
  } else if (cc.temperature) {
    tempF = cc.temperature;
  } else if (today && today.temp) {
    tempF = today.temp;
  }

  var tempC;
  if (tempF) {
    tempC = ((tempF - 32) * 5 / 9).toFixed(1);
  }

  // condities
  var condText = "";
  if (cc.conditions) {
    condText = cc.conditions.toLowerCase();
  } else if (today && today.conditions) {
    condText = today.conditions.toLowerCase();
  }

  var iconField = "";
  if (cc.icon) {
    iconField = cc.icon.toLowerCase();
  } else if (today && today.icon) {
    iconField = today.icon.toLowerCase();
  }

  // regen
  var nowIsRain = false;
  if (condText.indexOf("rain") > -1 || condText.indexOf("shower") > -1 || iconField.indexOf("rain") > -1) {
    nowIsRain = true;
  }

  // dag/nacht
  var isNight = false;
  if (cc.isday === 0) {
    isNight = true;
  }

  // icoon
  var icon = "☀️";
  if (nowIsRain) {
    icon = "🌧️";
  } else if (isNight) {
    icon = "🌙";
  }

  if (tempC) {
    el.innerHTML = icon + " " + tempC + "°C";
  } else {
    el.innerHTML = icon + " Weer laden...";
  }
})
.catch(function(error) {
  var el = document.getElementById("weer-info");
  if (el) {
    el.innerHTML = "error";
  }
});
