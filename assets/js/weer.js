fetch("/assets/php/weer.php")
  .then((response) => response.json())
  .then((data) => {
    if (data.currentConditions && data.currentConditions.temp !== undefined) {
      const tempC = (((data.currentConditions.temp - 32) * 5) / 9).toFixed(1);
      document.getElementById("weer-info").innerHTML = `${tempC}°C`;
    } else {
      document.getElementById("weer-info").innerHTML = "geen weer";
    }
  })
  .catch((err) => {
    document.getElementById("weer-info").innerHTML = "error";
  });
