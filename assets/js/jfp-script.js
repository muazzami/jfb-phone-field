// get the country data from the plugin
const countryData = window.intlTelInputGlobals.getCountryData();
const input = document.querySelector(".intl-phone-field");
const addressDropdown = document.querySelector(".intl-country-sync");

// init plugin
const iti = window.intlTelInput(input, {
  utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js" // just for formatting/placeholders etc
});

if (addressDropdown) {
	// populate the country dropdown
	for (let i = 0; i < countryData.length; i++) {
		const country = countryData[i];
		const optionNode = document.createElement("option");
		optionNode.value = country.iso2;
		const textNode = document.createTextNode(country.name);
		optionNode.appendChild(textNode);
		addressDropdown.appendChild(optionNode);
	}
	// set it's initial value
	addressDropdown.value = iti.getSelectedCountryData().iso2;
	
	// listen to the telephone input for changes
	input.addEventListener('countrychange', () => {
		addressDropdown.value = iti.getSelectedCountryData().iso2;
	});


	// listen to the address dropdown for changes
	addressDropdown.addEventListener('change', (e) => {
		console.log(e.target.value);
		iti.setCountry(e.target.value);
	});
}

