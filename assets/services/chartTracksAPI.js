import axios from 'axios';


function findAllCountries() {
    return axios
    .get("http://localhost/api/countries")
    .then(response => response.data['hydra:member']);
}

function findAllTrackSpotify(dateSelected = getPreviousDate() ,country = "fr") {
    return axios
    .get("http://localhost:80/api/chart_tracks?date="+ dateSelected+"&id_platform=4&id_country="+country)
    .then(response => response.data);
}

function findAllTrackDeezer(dateSelected = getPreviousDate() ,country = "fr") {
    return axios
    .get("http://localhost:80/api/chart_tracks?date="+ dateSelected+"&id_platform=7&id_country="+country)
    .then(response => response.data);
}


function getAllDates() {
    return axios
    .get("http://localhost/api/date_charts")
    .then(response => response.data);
}

function getPreviousDate() {
    let desiredIndex = 4;
    let currentDate = new Date;
    let daysDifference = (currentDate.getDay() - desiredIndex + 6) % 7 + 1;
    let dataSelect = new Date(currentDate.getTime() - 86400000 * daysDifference);
    let date_string = dataSelect.getFullYear() + '-' + ((dataSelect.getMonth() > 8) ? (dataSelect.getMonth() + 1) : ('0' + (dataSelect.getMonth() + 1))) + '-' + ((dataSelect.getDate() > 9) ? dataSelect.getDate() : ('0' + dataSelect.getDate()));
    return date_string;
}



export default {
    findAllCountries,
    findAllTrackSpotify,
    getAllDates,
    getPreviousDate,
    findAllTrackDeezer
};